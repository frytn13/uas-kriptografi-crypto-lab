<?php

namespace App\Services;

use InvalidArgumentException;

class RsaService
{
    public function generateKeys(int $p, int $q, int $e): array
    {
        $this->validatePrimeInputs($p, $q);

        $n = $p * $q;
        $phi = ($p - 1) * ($q - 1);

        if ($e <= 1 || $e >= $phi) {
            throw new InvalidArgumentException('Nilai e harus lebih besar dari 1 dan lebih kecil dari φ(n).');
        }

        if ($this->gcd($e, $phi) !== 1) {
            throw new InvalidArgumentException('Nilai e harus relatif prima terhadap φ(n). Pilih e lain.');
        }

        $d = $this->modInverse($e, $phi);

        if ($d === null) {
            throw new InvalidArgumentException('Nilai d tidak dapat dihitung karena e tidak memiliki invers modular.');
        }

        return [
            'mode' => 'keygen',
            'p' => $p,
            'q' => $q,
            'e' => $e,
            'n' => $n,
            'phi' => $phi,
            'd' => $d,
            'public_key' => "({$e}, {$n})",
            'private_key' => "({$d}, {$n})",
            'gcd' => $this->gcd($e, $phi),
            'mod_inverse_check' => ($e * $d) % $phi,
            'steps' => [
                "n = p × q = {$p} × {$q} = {$n}",
                "φ(n) = (p - 1) × (q - 1) = " . ($p - 1) . ' × ' . ($q - 1) . " = {$phi}",
                "gcd(e, φ(n)) = gcd({$e}, {$phi}) = 1",
                "d × e ≡ 1 mod φ(n) → {$d} × {$e} mod {$phi} = 1",
                "Public Key = (e, n) = ({$e}, {$n})",
                "Private Key = (d, n) = ({$d}, {$n})",
            ],
            'note' => 'Kunci RSA berhasil dibentuk. Bilangan kecil digunakan hanya untuk pembelajaran, bukan keamanan produksi.',
        ];
    }

    public function encryptText(string $plainText, int $e, int $n): array
    {
        if (trim($plainText) === '') {
            throw new InvalidArgumentException('Plaintext wajib diisi.');
        }

        if ($e <= 1 || $n <= 1) {
            throw new InvalidArgumentException('Public key tidak valid. Nilai e dan n harus lebih besar dari 1.');
        }

        $bytes = array_values(unpack('C*', $plainText));
        $blocks = [];
        $cipherNumbers = [];

        foreach ($bytes as $index => $byte) {
            if ($byte >= $n) {
                throw new InvalidArgumentException('Nilai n harus lebih besar dari setiap nilai byte plaintext. Gunakan p dan q yang lebih besar.');
            }

            $cipher = $this->modPow($byte, $e, $n);
            $cipherNumbers[] = $cipher;
            $blocks[] = [
                'index' => $index + 1,
                'character' => $this->displayCharacter($byte),
                'ascii' => $byte,
                'cipher' => $cipher,
                'formula' => "C = {$byte}^{$e} mod {$n} = {$cipher}",
            ];
        }

        return [
            'mode' => 'encrypt',
            'plaintext' => $plainText,
            'e' => $e,
            'n' => $n,
            'public_key' => "({$e}, {$n})",
            'ciphertext' => implode(' ', $cipherNumbers),
            'cipher_numbers' => $cipherNumbers,
            'blocks' => $blocks,
            'input_characters' => mb_strlen($plainText),
            'input_bytes' => strlen($plainText),
            'note' => 'Setiap byte plaintext dienkripsi menjadi angka ciphertext dengan rumus C = M^e mod n.',
        ];
    }

    public function decryptText(string $cipherText, int $d, int $n): array
    {
        $cipherText = trim($cipherText);

        if ($cipherText === '') {
            throw new InvalidArgumentException('Ciphertext wajib diisi.');
        }

        if ($d <= 1 || $n <= 1) {
            throw new InvalidArgumentException('Private key tidak valid. Nilai d dan n harus lebih besar dari 1.');
        }

        $cipherNumbers = $this->parseCipherNumbers($cipherText);
        $plainBytes = [];
        $blocks = [];

        foreach ($cipherNumbers as $index => $cipherNumber) {
            if ($cipherNumber < 0 || $cipherNumber >= $n) {
                throw new InvalidArgumentException('Setiap angka ciphertext harus berada pada rentang 0 sampai n - 1.');
            }

            $message = $this->modPow($cipherNumber, $d, $n);

            if ($message < 0 || $message > 255) {
                throw new InvalidArgumentException('Hasil dekripsi menghasilkan byte di luar rentang 0 sampai 255. Periksa private key atau ciphertext.');
            }

            $plainBytes[] = $message;
            $blocks[] = [
                'index' => $index + 1,
                'cipher' => $cipherNumber,
                'ascii' => $message,
                'character' => $this->displayCharacter($message),
                'formula' => "M = {$cipherNumber}^{$d} mod {$n} = {$message}",
            ];
        }

        $plaintext = $plainBytes ? pack('C*', ...$plainBytes) : '';

        return [
            'mode' => 'decrypt',
            'ciphertext' => implode(' ', $cipherNumbers),
            'd' => $d,
            'n' => $n,
            'private_key' => "({$d}, {$n})",
            'plaintext' => $plaintext,
            'plain_bytes' => $plainBytes,
            'blocks' => $blocks,
            'note' => 'Setiap angka ciphertext didekripsi dengan rumus M = C^d mod n lalu dikembalikan menjadi karakter.',
        ];
    }

    public function getGameChallenges(): array
    {
        $rawChallenges = [
            ['p' => 11, 'q' => 13, 'e' => 7, 'label' => 'Small Prime Pair'],
            ['p' => 17, 'q' => 11, 'e' => 7, 'label' => 'Totient Builder'],
            ['p' => 19, 'q' => 23, 'e' => 5, 'label' => 'Public Exponent'],
            ['p' => 13, 'q' => 17, 'e' => 5, 'label' => 'Private Key Hunt'],
            ['p' => 23, 'q' => 29, 'e' => 17, 'label' => 'Modular Inverse'],
            ['p' => 29, 'q' => 31, 'e' => 11, 'label' => 'Key Pair Check'],
            ['p' => 31, 'q' => 37, 'e' => 17, 'label' => 'Prime Factor Case'],
            ['p' => 37, 'q' => 41, 'e' => 13, 'label' => 'RSA Builder'],
        ];

        return array_map(function (array $challenge, int $index): array {
            $key = $this->generateKeys($challenge['p'], $challenge['q'], $challenge['e']);

            return [
                'id' => $index + 1,
                'title' => $challenge['label'],
                'p' => $challenge['p'],
                'q' => $challenge['q'],
                'e' => $challenge['e'],
                'n' => $key['n'],
                'phi' => $key['phi'],
                'd' => $key['d'],
                'n_options' => $this->buildOptions($key['n'], [
                    $key['n'] + $challenge['p'],
                    $key['n'] + $challenge['q'],
                    ($challenge['p'] + $challenge['q']) * 2,
                ]),
                'phi_options' => $this->buildOptions($key['phi'], [
                    $key['n'],
                    $key['phi'] + 2,
                    ($challenge['p'] * ($challenge['q'] - 1)),
                ]),
                'd_options' => $this->buildOptions($key['d'], [
                    $challenge['e'],
                    $key['d'] + $challenge['e'],
                    max(2, $key['d'] - $challenge['e']),
                ]),
                'hint' => 'Hitung n, φ(n), lalu cari d sebagai invers modular dari e terhadap φ(n).',
            ];
        }, $rawChallenges, array_keys($rawChallenges));
    }

    public function isPrime(int $number): bool
    {
        if ($number < 2) {
            return false;
        }

        if ($number === 2) {
            return true;
        }

        if ($number % 2 === 0) {
            return false;
        }

        $limit = (int) floor(sqrt($number));

        for ($divisor = 3; $divisor <= $limit; $divisor += 2) {
            if ($number % $divisor === 0) {
                return false;
            }
        }

        return true;
    }

    private function validatePrimeInputs(int $p, int $q): void
    {
        if (! $this->isPrime($p)) {
            throw new InvalidArgumentException('Nilai p harus bilangan prima.');
        }

        if (! $this->isPrime($q)) {
            throw new InvalidArgumentException('Nilai q harus bilangan prima.');
        }

        if ($p === $q) {
            throw new InvalidArgumentException('Nilai p dan q tidak boleh sama.');
        }
    }

    private function parseCipherNumbers(string $cipherText): array
    {
        $parts = preg_split('/[\s,]+/', trim($cipherText), -1, PREG_SPLIT_NO_EMPTY);

        if (! $parts) {
            throw new InvalidArgumentException('Ciphertext harus berisi angka yang dipisahkan spasi atau koma.');
        }

        return array_map(function (string $part): int {
            if (! preg_match('/^\d+$/', $part)) {
                throw new InvalidArgumentException('Ciphertext hanya boleh berisi angka, spasi, atau koma.');
            }

            return (int) $part;
        }, $parts);
    }

    private function modPow(int $base, int $exponent, int $modulus): int
    {
        if ($modulus === 1) {
            return 0;
        }

        $result = 1;
        $base %= $modulus;

        while ($exponent > 0) {
            if ($exponent % 2 === 1) {
                $result = ($result * $base) % $modulus;
            }

            $exponent = intdiv($exponent, 2);
            $base = ($base * $base) % $modulus;
        }

        return $result;
    }

    private function gcd(int $a, int $b): int
    {
        $a = abs($a);
        $b = abs($b);

        while ($b !== 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }

        return $a;
    }

    private function modInverse(int $a, int $m): ?int
    {
        $m0 = $m;
        $x0 = 0;
        $x1 = 1;

        if ($m === 1) {
            return null;
        }

        while ($a > 1) {
            if ($m === 0) {
                return null;
            }

            $quotient = intdiv($a, $m);
            [$a, $m] = [$m, $a % $m];
            [$x0, $x1] = [$x1 - $quotient * $x0, $x0];
        }

        if ($x1 < 0) {
            $x1 += $m0;
        }

        return $x1;
    }

    private function displayCharacter(int $byte): string
    {
        return match ($byte) {
            10 => '\\n',
            13 => '\\r',
            9 => '\\t',
            32 => 'space',
            default => chr($byte),
        };
    }

    private function buildOptions(int $answer, array $distractors): array
    {
        $options = array_values(array_unique(array_filter([
            $answer,
            ...$distractors,
        ], fn ($value) => is_int($value) && $value > 0)));

        while (count($options) < 4) {
            $options[] = $answer + count($options) + 3;
            $options = array_values(array_unique($options));
        }

        return array_slice($options, 0, 4);
    }
}
