<?php

namespace App\Services;

use InvalidArgumentException;

class DesService
{
    private const IP = [
        58,
        50,
        42,
        34,
        26,
        18,
        10,
        2,
        60,
        52,
        44,
        36,
        28,
        20,
        12,
        4,
        62,
        54,
        46,
        38,
        30,
        22,
        14,
        6,
        64,
        56,
        48,
        40,
        32,
        24,
        16,
        8,
        57,
        49,
        41,
        33,
        25,
        17,
        9,
        1,
        59,
        51,
        43,
        35,
        27,
        19,
        11,
        3,
        61,
        53,
        45,
        37,
        29,
        21,
        13,
        5,
        63,
        55,
        47,
        39,
        31,
        23,
        15,
        7,
    ];

    private const FP = [
        40,
        8,
        48,
        16,
        56,
        24,
        64,
        32,
        39,
        7,
        47,
        15,
        55,
        23,
        63,
        31,
        38,
        6,
        46,
        14,
        54,
        22,
        62,
        30,
        37,
        5,
        45,
        13,
        53,
        21,
        61,
        29,
        36,
        4,
        44,
        12,
        52,
        20,
        60,
        28,
        35,
        3,
        43,
        11,
        51,
        19,
        59,
        27,
        34,
        2,
        42,
        10,
        50,
        18,
        58,
        26,
        33,
        1,
        41,
        9,
        49,
        17,
        57,
        25,
    ];

    private const E = [
        32,
        1,
        2,
        3,
        4,
        5,
        4,
        5,
        6,
        7,
        8,
        9,
        8,
        9,
        10,
        11,
        12,
        13,
        12,
        13,
        14,
        15,
        16,
        17,
        16,
        17,
        18,
        19,
        20,
        21,
        20,
        21,
        22,
        23,
        24,
        25,
        24,
        25,
        26,
        27,
        28,
        29,
        28,
        29,
        30,
        31,
        32,
        1,
    ];

    private const P = [
        16,
        7,
        20,
        21,
        29,
        12,
        28,
        17,
        1,
        15,
        23,
        26,
        5,
        18,
        31,
        10,
        2,
        8,
        24,
        14,
        32,
        27,
        3,
        9,
        19,
        13,
        30,
        6,
        22,
        11,
        4,
        25,
    ];

    private const PC1 = [
        57,
        49,
        41,
        33,
        25,
        17,
        9,
        1,
        58,
        50,
        42,
        34,
        26,
        18,
        10,
        2,
        59,
        51,
        43,
        35,
        27,
        19,
        11,
        3,
        60,
        52,
        44,
        36,
        63,
        55,
        47,
        39,
        31,
        23,
        15,
        7,
        62,
        54,
        46,
        38,
        30,
        22,
        14,
        6,
        61,
        53,
        45,
        37,
        29,
        21,
        13,
        5,
        28,
        20,
        12,
        4,
    ];

    private const PC2 = [
        14,
        17,
        11,
        24,
        1,
        5,
        3,
        28,
        15,
        6,
        21,
        10,
        23,
        19,
        12,
        4,
        26,
        8,
        16,
        7,
        27,
        20,
        13,
        2,
        41,
        52,
        31,
        37,
        47,
        55,
        30,
        40,
        51,
        45,
        33,
        48,
        44,
        49,
        39,
        56,
        34,
        53,
        46,
        42,
        50,
        36,
        29,
        32,
    ];

    private const SHIFTS = [1, 1, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 1];

    private const S_BOXES = [
        [[14, 4, 13, 1, 2, 15, 11, 8, 3, 10, 6, 12, 5, 9, 0, 7], [0, 15, 7, 4, 14, 2, 13, 1, 10, 6, 12, 11, 9, 5, 3, 8], [4, 1, 14, 8, 13, 6, 2, 11, 15, 12, 9, 7, 3, 10, 5, 0], [15, 12, 8, 2, 4, 9, 1, 7, 5, 11, 3, 14, 10, 0, 6, 13]],
        [[15, 1, 8, 14, 6, 11, 3, 4, 9, 7, 2, 13, 12, 0, 5, 10], [3, 13, 4, 7, 15, 2, 8, 14, 12, 0, 1, 10, 6, 9, 11, 5], [0, 14, 7, 11, 10, 4, 13, 1, 5, 8, 12, 6, 9, 3, 2, 15], [13, 8, 10, 1, 3, 15, 4, 2, 11, 6, 7, 12, 0, 5, 14, 9]],
        [[10, 0, 9, 14, 6, 3, 15, 5, 1, 13, 12, 7, 11, 4, 2, 8], [13, 7, 0, 9, 3, 4, 6, 10, 2, 8, 5, 14, 12, 11, 15, 1], [13, 6, 4, 9, 8, 15, 3, 0, 11, 1, 2, 12, 5, 10, 14, 7], [1, 10, 13, 0, 6, 9, 8, 7, 4, 15, 14, 3, 11, 5, 2, 12]],
        [[7, 13, 14, 3, 0, 6, 9, 10, 1, 2, 8, 5, 11, 12, 4, 15], [13, 8, 11, 5, 6, 15, 0, 3, 4, 7, 2, 12, 1, 10, 14, 9], [10, 6, 9, 0, 12, 11, 7, 13, 15, 1, 3, 14, 5, 2, 8, 4], [3, 15, 0, 6, 10, 1, 13, 8, 9, 4, 5, 11, 12, 7, 2, 14]],
        [[2, 12, 4, 1, 7, 10, 11, 6, 8, 5, 3, 15, 13, 0, 14, 9], [14, 11, 2, 12, 4, 7, 13, 1, 5, 0, 15, 10, 3, 9, 8, 6], [4, 2, 1, 11, 10, 13, 7, 8, 15, 9, 12, 5, 6, 3, 0, 14], [11, 8, 12, 7, 1, 14, 2, 13, 6, 15, 0, 9, 10, 4, 5, 3]],
        [[12, 1, 10, 15, 9, 2, 6, 8, 0, 13, 3, 4, 14, 7, 5, 11], [10, 15, 4, 2, 7, 12, 9, 5, 6, 1, 13, 14, 0, 11, 3, 8], [9, 14, 15, 5, 2, 8, 12, 3, 7, 0, 4, 10, 1, 13, 11, 6], [4, 3, 2, 12, 9, 5, 15, 10, 11, 14, 1, 7, 6, 0, 8, 13]],
        [[4, 11, 2, 14, 15, 0, 8, 13, 3, 12, 9, 7, 5, 10, 6, 1], [13, 0, 11, 7, 4, 9, 1, 10, 14, 3, 5, 12, 2, 15, 8, 6], [1, 4, 11, 13, 12, 3, 7, 14, 10, 15, 6, 8, 0, 5, 9, 2], [6, 11, 13, 8, 1, 4, 10, 7, 9, 5, 0, 15, 14, 2, 3, 12]],
        [[13, 2, 8, 4, 6, 15, 11, 1, 10, 9, 3, 14, 5, 0, 12, 7], [1, 15, 13, 8, 10, 3, 7, 4, 12, 5, 6, 11, 0, 14, 9, 2], [7, 11, 4, 1, 9, 12, 14, 2, 0, 6, 10, 13, 15, 3, 5, 8], [2, 1, 14, 7, 4, 10, 8, 13, 15, 12, 9, 0, 3, 5, 6, 11]],
    ];

    public function encryptText(string $plainText, string $key): array
    {
        $plainText = trim($plainText);
        $this->validatePlaintext($plainText);
        $this->validateKey($key);

        $paddedPlaintext = str_pad($plainText, 8, "\0");
        $plainBits = $this->stringToBits($paddedPlaintext);
        $keyBits = $this->stringToBits($key);
        $process = $this->processBlock($plainBits, $keyBits, 'encrypt');

        return [
            'mode' => 'encrypt',
            'mode_label' => 'ENCRYPT DES',
            'plaintext' => $plainText,
            'padded_plaintext' => $this->displayPaddedText($paddedPlaintext),
            'key' => $key,

            'plaintext_binary' => $plainBits,
            'key_binary' => $keyBits,
            'ciphertext_binary' => $process['output_bits'],
            'initial_permutation_binary' => $process['initial_permutation_bits'],
            'final_permutation_binary' => $process['preoutput_bits'],

            'plaintext_hex' => strtoupper(bin2hex($paddedPlaintext)),
            'key_hex' => strtoupper(bin2hex($key)),
            'ciphertext_hex' => $this->bitsToHex($process['output_bits']),
            'initial_permutation_hex' => $process['initial_permutation_hex'],
            'final_permutation_hex' => $this->bitsToHex($process['preoutput_bits']),

            'rounds' => $process['rounds'],
            'subkeys' => $process['subkeys'],
            'round_count' => 16,
            'note' => 'Plaintext diproses sebagai satu blok 64-bit. Jika input kurang dari 8 karakter, sistem menambahkan null padding untuk kebutuhan demonstrasi.',
        ];
    }

    public function decryptText(string $cipherBinary, string $key): array
    {
        $cipherBits = trim($cipherBinary);

        $this->validateCipherBinary($cipherBits);
        $this->validateKey($key);

        $keyBits = $this->stringToBits($key);
        $process = $this->processBlock($cipherBits, $keyBits, 'decrypt');

        $plainBytes = $this->bitsToString($process['output_bits']);
        $plainText = rtrim($plainBytes, "\0");

        return [
            'mode' => 'decrypt',
            'mode_label' => 'DECRYPT DES',

            'ciphertext_binary' => $cipherBits,
            'key' => $key,
            'key_binary' => $keyBits,
            'plaintext' => $plainText,
            'plaintext_binary' => $process['output_bits'],
            'initial_permutation_binary' => $process['initial_permutation_bits'],
            'final_permutation_binary' => $process['preoutput_bits'],

            'key_hex' => strtoupper(bin2hex($key)),
            'plaintext_hex' => strtoupper(bin2hex($plainBytes)),
            'initial_permutation_hex' => $process['initial_permutation_hex'],
            'final_permutation_hex' => $this->bitsToHex($process['preoutput_bits']),

            'rounds' => $process['rounds'],
            'subkeys' => $process['subkeys'],
            'round_count' => 16,
            'note' => 'Dekripsi memakai subkey DES dengan urutan terbalik. Null padding di akhir plaintext disembunyikan dari hasil teks.',
        ];
    }

    public function getGameChallenges(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'DES ENCRYPT FLOW',
                'prompt' => 'Susun urutan proses utama enkripsi DES.',
                'answer' => ['Initial Permutation', 'Split L0/R0', '16 Feistel Rounds', 'Final Permutation'],
                'options' => ['Final Permutation', 'Split L0/R0', 'Initial Permutation', '16 Feistel Rounds'],
                'hint' => 'DES memulai proses dengan permutasi awal sebelum data dibagi menjadi sisi kiri dan kanan.',
            ],
            [
                'id' => 2,
                'title' => 'KEY SCHEDULE',
                'prompt' => 'Susun urutan pembentukan subkey DES.',
                'answer' => ['PC-1', 'Split C0/D0', 'Left Shift', 'PC-2'],
                'options' => ['PC-2', 'Left Shift', 'PC-1', 'Split C0/D0'],
                'hint' => 'Key 64-bit diproses terlebih dahulu oleh PC-1 sebelum dibagi menjadi C dan D.',
            ],
            [
                'id' => 3,
                'title' => 'ROUND FUNCTION',
                'prompt' => 'Susun urutan fungsi F pada satu round DES.',
                'answer' => ['Expansion', 'XOR Subkey', 'S-Box', 'P-Box'],
                'options' => ['S-Box', 'Expansion', 'P-Box', 'XOR Subkey'],
                'hint' => 'R sisi kanan perlu diperluas dari 32-bit menjadi 48-bit sebelum di-XOR dengan subkey.',
            ],
            [
                'id' => 4,
                'title' => 'DECRYPT LOGIC',
                'prompt' => 'Susun ide dasar dekripsi DES.',
                'answer' => ['Ciphertext 64-bit', 'Reverse Subkeys', '16 Feistel Rounds', 'Plaintext 64-bit'],
                'options' => ['Plaintext 64-bit', '16 Feistel Rounds', 'Ciphertext 64-bit', 'Reverse Subkeys'],
                'hint' => 'Dekripsi DES memakai struktur yang sama, tetapi subkey dipakai dari K16 sampai K1.',
            ],
        ];
    }

    private function processBlock(string $blockBits, string $keyBits, string $mode): array
    {
        $keySchedule = $this->generateSubkeys($keyBits);
        $subkeys = $keySchedule['subkeys'];

        if ($mode === 'decrypt') {
            $subkeys = array_reverse($subkeys);
        }

        $initialPermutation = $this->permute($blockBits, self::IP);
        $left = substr($initialPermutation, 0, 32);
        $right = substr($initialPermutation, 32, 32);
        $rounds = [];

        foreach ($subkeys as $index => $subkey) {
            $functionOutput = $this->roundFunction($right, $subkey['bits']);
            $newLeft = $right;
            $newRight = $this->xorBits($left, $functionOutput);

            $left = $newLeft;
            $right = $newRight;

            $rounds[] = [
                'round' => $index + 1,

                'subkey_binary' => $subkey['bits'],
                'function_binary' => $functionOutput,
                'left_binary' => $left,
                'right_binary' => $right,

                'subkey_hex' => $subkey['hex'],
                'function_hex' => $this->bitsToHex($functionOutput),
                'left_hex' => $this->bitsToHex($left),
                'right_hex' => $this->bitsToHex($right),
            ];
        }

        $preOutput = $right . $left;
        $outputBits = $this->permute($preOutput, self::FP);

        return [
            'output_bits' => $outputBits,
            'preoutput_bits' => $preOutput,
            'initial_permutation_bits' => $initialPermutation,
            'initial_permutation_hex' => $this->bitsToHex($initialPermutation),
            'rounds' => $rounds,
            'subkeys' => $keySchedule['display'],
        ];
    }

    private function generateSubkeys(string $keyBits): array
    {
        $permutedKey = $this->permute($keyBits, self::PC1);
        $c = substr($permutedKey, 0, 28);
        $d = substr($permutedKey, 28, 28);
        $subkeys = [];
        $display = [];

        foreach (self::SHIFTS as $index => $shift) {
            $c = $this->leftShift($c, $shift);
            $d = $this->leftShift($d, $shift);
            $combined = $c . $d;
            $subkeyBits = $this->permute($combined, self::PC2);

            $subkeys[] = [
                'round' => $index + 1,
                'bits' => $subkeyBits,
                'hex' => $this->bitsToHex($subkeyBits),
            ];

            $display[] = [
                'round' => $index + 1,
                'shift' => $shift,

                'c_binary' => $c,
                'd_binary' => $d,
                'subkey_binary' => $subkeyBits,

                'c_hex' => $this->bitsToHex($c),
                'd_hex' => $this->bitsToHex($d),
                'subkey_hex' => $this->bitsToHex($subkeyBits),
            ];
        }

        return [
            'subkeys' => $subkeys,
            'display' => $display,
        ];
    }

    private function roundFunction(string $rightBits, string $subkeyBits): string
    {
        $expanded = $this->permute($rightBits, self::E);
        $xored = $this->xorBits($expanded, $subkeyBits);
        $substituted = $this->sBoxSubstitution($xored);

        return $this->permute($substituted, self::P);
    }

    private function sBoxSubstitution(string $bits): string
    {
        $output = '';

        for ($box = 0; $box < 8; $box++) {
            $chunk = substr($bits, $box * 6, 6);
            $row = bindec($chunk[0] . $chunk[5]);
            $column = bindec(substr($chunk, 1, 4));
            $value = self::S_BOXES[$box][$row][$column];
            $output .= str_pad(decbin($value), 4, '0', STR_PAD_LEFT);
        }

        return $output;
    }

    private function validatePlaintext(string $plainText): void
    {
        if ($plainText === '') {
            throw new InvalidArgumentException('Plaintext wajib diisi.');
        }

        if (strlen($plainText) > 8) {
            throw new InvalidArgumentException('Plaintext maksimal 8 karakter untuk satu blok DES 64-bit.');
        }

        $this->ensurePrintableAscii($plainText, 'Plaintext');
    }

    private function validateKey(string $key): void
    {
        if (strlen($key) !== 8) {
            throw new InvalidArgumentException('Key DES wajib tepat 8 karakter agar menjadi 64-bit.');
        }

        $this->ensurePrintableAscii($key, 'Key');
    }

    private function validateCipherBinary(string $cipherBinary): void
    {
        if (! preg_match('/^[01]{64}$/', $cipherBinary)) {
            throw new InvalidArgumentException('Ciphertext DES wajib 64 bit biner dan hanya boleh berisi angka 0 atau 1.');
        }
    }

    private function ensurePrintableAscii(string $value, string $field): void
    {
        $length = strlen($value);

        for ($index = 0; $index < $length; $index++) {
            $byte = ord($value[$index]);

            if ($byte < 32 || $byte > 126) {
                throw new InvalidArgumentException("{$field} hanya mendukung karakter ASCII yang dapat ditampilkan untuk simulasi DES.");
            }
        }
    }

    private function stringToBits(string $value): string
    {
        $bits = '';
        $length = strlen($value);

        for ($index = 0; $index < $length; $index++) {
            $bits .= str_pad(decbin(ord($value[$index])), 8, '0', STR_PAD_LEFT);
        }

        return $bits;
    }

    private function bitsToString(string $bits): string
    {
        $text = '';

        for ($index = 0; $index < strlen($bits); $index += 8) {
            $text .= chr(bindec(substr($bits, $index, 8)));
        }

        return $text;
    }

    private function hexToBits(string $hex): string
    {
        $bits = '';

        for ($index = 0; $index < strlen($hex); $index++) {
            $bits .= str_pad(decbin(hexdec($hex[$index])), 4, '0', STR_PAD_LEFT);
        }

        return $bits;
    }

    private function bitsToHex(string $bits): string
    {
        $hex = '';

        for ($index = 0; $index < strlen($bits); $index += 4) {
            $hex .= strtoupper(dechex(bindec(substr($bits, $index, 4))));
        }

        return $hex;
    }

    private function permute(string $bits, array $table): string
    {
        $output = '';

        foreach ($table as $position) {
            $output .= $bits[$position - 1];
        }

        return $output;
    }

    private function xorBits(string $first, string $second): string
    {
        $output = '';
        $length = strlen($first);

        for ($index = 0; $index < $length; $index++) {
            $output .= $first[$index] === $second[$index] ? '0' : '1';
        }

        return $output;
    }

    private function leftShift(string $bits, int $amount): string
    {
        return substr($bits, $amount) . substr($bits, 0, $amount);
    }

    private function displayPaddedText(string $text): string
    {
        return str_replace("\0", '[NULL]', $text);
    }
}
