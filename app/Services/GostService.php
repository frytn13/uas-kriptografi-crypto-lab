<?php

namespace App\Services;

use InvalidArgumentException;

class GostService
{
    private const MASK_32 = 0xFFFFFFFF;

    private const SBOX = [
        [4, 10, 9, 2, 13, 8, 0, 14, 6, 11, 1, 12, 7, 15, 5, 3],
        [14, 11, 4, 12, 6, 13, 15, 10, 2, 3, 8, 1, 0, 7, 5, 9],
        [5, 8, 1, 13, 10, 3, 4, 2, 14, 15, 12, 7, 6, 0, 9, 11],
        [7, 13, 10, 1, 0, 8, 9, 15, 14, 4, 6, 12, 11, 2, 5, 3],
        [6, 12, 7, 1, 5, 15, 13, 8, 4, 10, 9, 14, 0, 3, 11, 2],
        [4, 11, 10, 0, 7, 2, 1, 13, 3, 6, 8, 5, 9, 12, 15, 14],
        [13, 11, 4, 1, 3, 15, 5, 9, 0, 10, 14, 7, 6, 8, 2, 12],
        [1, 15, 13, 0, 5, 7, 10, 4, 9, 2, 3, 14, 6, 11, 8, 12],
    ];

    public function encryptText(string $plaintext, string $key): array
    {
        $this->assertSingleBlockPlaintext($plaintext);
        $this->assertKey($key);

        $plainBlock = str_pad($plaintext, 8, ' ');
        $roundKeys = $this->createEncryptionRoundKeys($key);
        $result = $this->processBlock($plainBlock, $roundKeys, 'encrypt');

        return [
            'mode' => 'encrypt',
            'mode_label' => 'Encrypt GOST',
            'plaintext' => $plaintext,
            'plaintext_padded' => $plainBlock,
            'plaintext_hex' => strtoupper(bin2hex($plainBlock)),
            'plaintext_binary' => $this->bytesToBinary($plainBlock),
            'key' => $key,
            'key_hex' => strtoupper(bin2hex($key)),
            'key_length' => strlen($key) . ' characters / 256 bit',
            'ciphertext_hex' => strtoupper(bin2hex($result['block'])),
            'ciphertext_binary' => $this->bytesToBinary($result['block']),
            'round_count' => 32,
            'rounds' => $result['rounds'],
            'subkeys' => $this->describeSubkeys($key),
            'note' => 'Plaintext diproses sebagai satu blok 64-bit dan key 32 karakter dipakai sebagai key 256-bit.',
        ];
    }

    public function decryptText(string $ciphertextHex, string $key): array
    {
        $ciphertextHex = strtoupper(trim($ciphertextHex));

        if (! preg_match('/^[a-fA-F0-9]{16}$/', $ciphertextHex)) {
            throw new InvalidArgumentException('Ciphertext hex wajib 16 karakter heksadesimal.');
        }

        $this->assertKey($key);

        $cipherBlock = hex2bin($ciphertextHex);

        if ($cipherBlock === false) {
            throw new InvalidArgumentException('Ciphertext hex tidak valid.');
        }

        $roundKeys = array_reverse($this->createEncryptionRoundKeys($key));
        $result = $this->processBlock($cipherBlock, $roundKeys, 'decrypt');
        $plainPadded = $result['block'];
        $plaintext = rtrim($plainPadded, ' ');

        return [
            'mode' => 'decrypt',
            'mode_label' => 'Decrypt GOST',
            'ciphertext_hex' => $ciphertextHex,
            'ciphertext_binary' => $this->bytesToBinary($cipherBlock),
            'key' => $key,
            'key_hex' => strtoupper(bin2hex($key)),
            'key_length' => strlen($key) . ' characters / 256 bit',
            'plaintext' => $plaintext,
            'plaintext_padded' => $plainPadded,
            'plaintext_hex' => strtoupper(bin2hex($plainPadded)),
            'plaintext_binary' => $this->bytesToBinary($plainPadded),
            'round_count' => 32,
            'rounds' => $result['rounds'],
            'subkeys' => $this->describeSubkeys($key),
            'note' => 'Dekripsi memakai urutan subkey yang dibalik sehingga ciphertext dapat kembali menjadi plaintext.',
        ];
    }

    public function getGameChallenges(): array
    {
        return [
            [
                'title' => 'ROUND FUNCTION ORDER',
                'hint' => 'Susun urutan operasi inti pada fungsi round GOST.',
                'answer' => [
                    'Addition modulo 2^32',
                    'S-Box substitution',
                    'Rotate left 11',
                    'XOR with left block',
                    'Feistel swap',
                ],
                'options' => [
                    'Addition modulo 2^32',
                    'S-Box substitution',
                    'Rotate left 11',
                    'XOR with left block',
                    'Feistel swap',
                ],
            ],
            [
                'title' => 'KEY SCHEDULE ORDER',
                'hint' => 'Susun alur pembentukan subkey pada GOST 28147-89.',
                'answer' => [
                    'Read 256-bit key',
                    'Split into 8 subkeys',
                    'Repeat K1 to K8 three times',
                    'Use K8 to K1 in final rounds',
                ],
                'options' => [
                    'Read 256-bit key',
                    'Split into 8 subkeys',
                    'Repeat K1 to K8 three times',
                    'Use K8 to K1 in final rounds',
                ],
            ],
            [
                'title' => 'BLOCK PROCESS ORDER',
                'hint' => 'Susun alur umum proses enkripsi GOST untuk satu blok.',
                'answer' => [
                    'Plaintext 64-bit',
                    'Split L0 and R0',
                    'Run 32 Feistel rounds',
                    'Apply final swap',
                    'Produce ciphertext hex',
                ],
                'options' => [
                    'Plaintext 64-bit',
                    'Split L0 and R0',
                    'Run 32 Feistel rounds',
                    'Apply final swap',
                    'Produce ciphertext hex',
                ],
            ],
        ];
    }

    private function assertSingleBlockPlaintext(string $plaintext): void
    {
        if ($plaintext === '') {
            throw new InvalidArgumentException('Plaintext wajib diisi.');
        }

        if (strlen($plaintext) > 8) {
            throw new InvalidArgumentException('Plaintext maksimal 8 karakter untuk satu blok GOST 64-bit.');
        }
    }

    private function assertKey(string $key): void
    {
        if (strlen($key) !== 32) {
            throw new InvalidArgumentException('Key GOST wajib tepat 32 karakter atau 256-bit ASCII.');
        }
    }

    private function createEncryptionRoundKeys(string $key): array
    {
        $subkeys = $this->splitKeyToSubkeys($key);
        $roundKeys = [];

        for ($round = 0; $round < 24; $round++) {
            $index = $round % 8;
            $roundKeys[] = [
                'round' => $round + 1,
                'label' => 'K' . ($index + 1),
                'value' => $subkeys[$index],
            ];
        }

        for ($index = 7; $index >= 0; $index--) {
            $roundKeys[] = [
                'round' => count($roundKeys) + 1,
                'label' => 'K' . ($index + 1),
                'value' => $subkeys[$index],
            ];
        }

        return $roundKeys;
    }

    private function splitKeyToSubkeys(string $key): array
    {
        $subkeys = [];

        for ($index = 0; $index < 8; $index++) {
            $chunk = substr($key, $index * 4, 4);
            $subkeys[] = unpack('N', $chunk)[1] & self::MASK_32;
        }

        return $subkeys;
    }

    private function describeSubkeys(string $key): array
    {
        return array_map(function (int $subkey, int $index): array {
            return [
                'label' => 'K' . ($index + 1),
                'hex' => $this->toHex32($subkey),
            ];
        }, $this->splitKeyToSubkeys($key), array_keys($this->splitKeyToSubkeys($key)));
    }

    private function processBlock(string $block, array $roundKeys, string $direction): array
    {
        $parts = unpack('Nleft/Nright', $block);
        $left = $parts['left'] & self::MASK_32;
        $right = $parts['right'] & self::MASK_32;
        $rounds = [];

        foreach ($roundKeys as $index => $roundKey) {
            $roundNumber = $index + 1;
            $fValue = $this->roundFunction($right, $roundKey['value']);
            $newLeft = $right;
            $newRight = ($left ^ $fValue) & self::MASK_32;

            $rounds[] = [
                'round' => $roundNumber,
                'operation' => $direction === 'encrypt' ? 'Encrypt Round' : 'Decrypt Round',
                'subkey' => $roundKey['label'],
                'subkey_hex' => $this->toHex32($roundKey['value']),
                'left_hex' => $this->toHex32($newLeft),
                'right_hex' => $this->toHex32($newRight),
                'f_hex' => $this->toHex32($fValue),
            ];

            $left = $newLeft;
            $right = $newRight;
        }

        return [
            'block' => pack('N2', $right, $left),
            'rounds' => $rounds,
        ];
    }

    private function roundFunction(int $right, int $subkey): int
    {
        $added = ($right + $subkey) & self::MASK_32;
        $substituted = $this->substitute($added);

        return $this->rotateLeft32($substituted, 11);
    }

    private function substitute(int $value): int
    {
        $output = 0;

        for ($index = 0; $index < 8; $index++) {
            $nibble = ($value >> ($index * 4)) & 0xF;
            $output |= self::SBOX[$index][$nibble] << ($index * 4);
        }

        return $output & self::MASK_32;
    }

    private function rotateLeft32(int $value, int $shift): int
    {
        $value &= self::MASK_32;

        return (($value << $shift) | ($value >> (32 - $shift))) & self::MASK_32;
    }

    private function toHex32(int $value): string
    {
        return strtoupper(str_pad(dechex($value & self::MASK_32), 8, '0', STR_PAD_LEFT));
    }

    private function bytesToBinary(string $bytes): string
    {
        $binary = '';

        for ($index = 0; $index < strlen($bytes); $index++) {
            $binary .= str_pad(decbin(ord($bytes[$index])), 8, '0', STR_PAD_LEFT);
        }

        return $binary;
    }
}
