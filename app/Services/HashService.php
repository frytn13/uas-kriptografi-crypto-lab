<?php

namespace App\Services;

use InvalidArgumentException;

class HashService
{
    private array $algorithms = [
        'md5' => [
            'label' => 'MD5',
            'bits' => 128,
            'hex_length' => 32,
            'block_size' => '512-bit',
            'note' => 'Digunakan untuk pembelajaran dasar dan perbandingan. Tidak disarankan untuk keamanan modern.',
        ],
        'sha1' => [
            'label' => 'SHA-1',
            'bits' => 160,
            'hex_length' => 40,
            'block_size' => '512-bit',
            'note' => 'Lebih panjang dari MD5, tetapi sudah tidak disarankan untuk keamanan modern.',
        ],
        'sha256' => [
            'label' => 'SHA-256',
            'bits' => 256,
            'hex_length' => 64,
            'block_size' => '512-bit',
            'note' => 'Menjadi pilihan utama pada halaman ini karena umum digunakan untuk pembelajaran hash modern.',
        ],
        'sha512' => [
            'label' => 'SHA-512',
            'bits' => 512,
            'hex_length' => 128,
            'block_size' => '1024-bit',
            'note' => 'Menghasilkan output lebih panjang dan cocok untuk membandingkan karakteristik digest.',
        ],
    ];

    public function getAlgorithms(): array
    {
        return $this->algorithms;
    }

    public function generate(string $plainText, string $algorithm): array
    {
        $algorithm = strtolower($algorithm);

        if (! array_key_exists($algorithm, $this->algorithms)) {
            throw new InvalidArgumentException('Algoritma hash tidak tersedia.');
        }

        $hash = hash($algorithm, $plainText);
        $meta = $this->algorithms[$algorithm];

        return [
            'algorithm' => $algorithm,
            'algorithm_label' => $meta['label'],
            'bits' => $meta['bits'],
            'block_size' => $meta['block_size'],
            'expected_hex_length' => $meta['hex_length'],
            'note' => $meta['note'],
            'plaintext' => $plainText,
            'hash' => $hash,
            'input_characters' => mb_strlen($plainText),
            'input_bytes' => strlen($plainText),
            'input_bits' => strlen($plainText) * 8,
            'output_characters' => strlen($hash),
        ];
    }

    public function verify(string $plainText, string $algorithm, string $expectedHash): array
    {
        $generated = $this->generate($plainText, $algorithm);
        $normalizedExpectedHash = strtolower(trim($expectedHash));

        return [
            ...$generated,
            'expected_hash' => $normalizedExpectedHash,
            'expected_hash_length' => strlen($normalizedExpectedHash),
            'expected_length_is_valid' => strlen($normalizedExpectedHash) === $generated['expected_hex_length'],
            'matches' => hash_equals($generated['hash'], $normalizedExpectedHash),
        ];
    }

    public function getGameChallenges(): array
    {
        $rawChallenges = [
            [
                'title' => 'CASE SENSITIVE',
                'algorithm' => 'sha256',
                'answer' => 'HASH-2026',
                'hint' => 'Huruf besar, huruf kecil, dan tanda hubung menghasilkan digest yang berbeda.',
                'candidates' => [
                    'HASH-2026',
                    'Hash-2026',
                    'HASH 2026',
                    'HASH-2027',
                ],
            ],
            [
                'title' => 'SPACE MATTERS',
                'algorithm' => 'sha256',
                'answer' => 'CRYPTO LAB',
                'hint' => 'Spasi ikut dihitung sebagai karakter input.',
                'candidates' => [
                    'CRYPTO LAB',
                    'CRYPTOLAB',
                    'CRYPTO-LAB',
                    'crypto lab',
                ],
            ],
            [
                'title' => 'TINY CHANGE',
                'algorithm' => 'sha1',
                'answer' => 'DATA-01',
                'hint' => 'Perubahan angka kecil di akhir teks dapat mengubah digest.',
                'candidates' => [
                    'DATA-01',
                    'DATA-1',
                    'DATA-02',
                    'data-01',
                ],
            ],
            [
                'title' => 'SYMBOL CHECK',
                'algorithm' => 'md5',
                'answer' => 'KEY#2026',
                'hint' => 'Simbol seperti # ikut memengaruhi hasil hash.',
                'candidates' => [
                    'KEY#2026',
                    'KEY-2026',
                    'KEY 2026',
                    'key#2026',
                ],
            ],
            [
                'title' => 'LONGER DIGEST',
                'algorithm' => 'sha512',
                'answer' => 'GOST MODULE',
                'hint' => 'SHA-512 menghasilkan output lebih panjang dibanding SHA-256.',
                'candidates' => [
                    'GOST MODULE',
                    'GOST-MODULE',
                    'GOSTMODULE',
                    'Gost Module',
                ],
            ],
            [
                'title' => 'AVALANCHE EFFECT',
                'algorithm' => 'sha256',
                'answer' => 'RSA_PUBLIC',
                'hint' => 'Underscore dan huruf kapital ikut membedakan hasil hash.',
                'candidates' => [
                    'RSA_PUBLIC',
                    'RSA PUBLIC',
                    'RSA-PUBLIC',
                    'rsa_public',
                ],
            ],
            [
                'title' => 'NUMBER DETAIL',
                'algorithm' => 'sha1',
                'answer' => 'DES64',
                'hint' => 'Perhatikan angka yang menempel pada teks.',
                'candidates' => [
                    'DES64',
                    'DES-64',
                    'DES 64',
                    'des64',
                ],
            ],
            [
                'title' => 'DASH OR SPACE',
                'algorithm' => 'md5',
                'answer' => 'BLOCK-CIPHER',
                'hint' => 'Tanda hubung dan spasi bukan karakter yang sama.',
                'candidates' => [
                    'BLOCK-CIPHER',
                    'BLOCK CIPHER',
                    'BLOCKCIPHER',
                    'Block-Cipher',
                ],
            ],
            [
                'title' => 'LOWERCASE TRAP',
                'algorithm' => 'sha256',
                'answer' => 'plaintext',
                'hint' => 'Huruf kecil penuh berbeda dari huruf besar.',
                'candidates' => [
                    'plaintext',
                    'PLAINTEXT',
                    'Plaintext',
                    'plain text',
                ],
            ],
            [
                'title' => 'TRAILING NUMBER',
                'algorithm' => 'sha512',
                'answer' => 'MODULE04',
                'hint' => 'Dua digit terakhir harus tepat.',
                'candidates' => [
                    'MODULE04',
                    'MODULE4',
                    'MODULE-04',
                    'module04',
                ],
            ],
            [
                'title' => 'DIGEST TARGET',
                'algorithm' => 'sha256',
                'answer' => 'INTEGRITY',
                'hint' => 'Cari kandidat yang digest-nya sama persis dengan target.',
                'candidates' => [
                    'INTEGRITY',
                    'INTEGERITY',
                    'integrity',
                    'INTEGRITY!',
                ],
            ],
            [
                'title' => 'FORENSIC CHECK',
                'algorithm' => 'sha1',
                'answer' => 'EVIDENCE-01',
                'hint' => 'Dalam forensik digital, satu karakter berbeda berarti hash berbeda.',
                'candidates' => [
                    'EVIDENCE-01',
                    'EVIDENCE-1',
                    'EVIDENCE 01',
                    'evidence-01',
                ],
            ],
        ];

        return array_map(function (array $challenge, int $index): array {
            $result = $this->generate($challenge['answer'], $challenge['algorithm']);

            return [
                'id' => $index + 1,
                'title' => $challenge['title'],
                'algorithm' => $challenge['algorithm'],
                'algorithm_label' => $result['algorithm_label'],
                'answer_plaintext' => $challenge['answer'],
                'target_hash' => $result['hash'],
                'target_short_hash' => substr($result['hash'], 0, 18) . '...' . substr($result['hash'], -18),
                'hint' => $challenge['hint'],
                'candidates' => $challenge['candidates'],
            ];
        }, $rawChallenges, array_keys($rawChallenges));
    }
}
