<?php

namespace App\Http\Controllers;

use App\Services\DesService;
use App\Services\GostService;
use App\Services\HashService;
use App\Services\RsaService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvalidArgumentException;

class CryptoPageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function hash(HashService $hashService): View
    {
        return view('pages.hash', [
            'algorithms' => $hashService->getAlgorithms(),
            'hashResult' => null,
            'verifyResult' => null,
            'gameChallenges' => $hashService->getGameChallenges(),
        ]);
    }

    public function processHash(Request $request, HashService $hashService)
    {
        $validated = $request->validate([
            'mode' => ['required', 'string', 'in:generate,verify'],
            'plain_text' => ['required', 'string', 'max:5000'],
            'algorithm' => ['required', 'string', 'in:md5,sha1,sha256,sha512'],
            'expected_hash' => ['nullable', 'required_if:mode,verify', 'string', 'max:256', 'regex:/^[a-fA-F0-9]+$/'],
        ], [
            'mode.required' => 'Mode proses wajib dipilih.',
            'mode.in' => 'Mode proses tidak tersedia.',
            'plain_text.required' => 'Plaintext wajib diisi terlebih dahulu.',
            'plain_text.max' => 'Plaintext maksimal 5000 karakter.',
            'algorithm.required' => 'Algoritma hash wajib dipilih.',
            'algorithm.in' => 'Algoritma hash yang dipilih tidak tersedia.',
            'expected_hash.required_if' => 'Hash pembanding wajib diisi untuk proses verifikasi.',
            'expected_hash.regex' => 'Hash pembanding hanya boleh berisi karakter heksadesimal 0-9 dan a-f.',
            'expected_hash.max' => 'Hash pembanding terlalu panjang.',
        ]);

        $hashResult = null;
        $verifyResult = null;

        if ($validated['mode'] === 'generate') {
            $hashResult = $hashService->generate(
                $validated['plain_text'],
                $validated['algorithm']
            );
        }

        if ($validated['mode'] === 'verify') {
            $verifyResult = $hashService->verify(
                $validated['plain_text'],
                $validated['algorithm'],
                $validated['expected_hash']
            );
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'mode' => $validated['mode'],
                'hashResult' => $hashResult,
                'verifyResult' => $verifyResult,
            ]);
        }

        return view('pages.hash', [
            'algorithms' => $hashService->getAlgorithms(),
            'hashResult' => $hashResult,
            'verifyResult' => $verifyResult,
            'gameChallenges' => $hashService->getGameChallenges(),
        ]);
    }

    public function rsa(RsaService $rsaService): View
    {
        return view('pages.rsa', [
            'rsaResult' => null,
            'gameChallenges' => $rsaService->getGameChallenges(),
        ]);
    }

    public function processRsa(Request $request, RsaService $rsaService)
    {
        $validated = $request->validate([
            'mode' => ['required', 'string', 'in:keygen,encrypt,decrypt'],
        ], [
            'mode.required' => 'Mode RSA wajib dipilih.',
            'mode.in' => 'Mode RSA tidak tersedia.',
        ]);

        try {
            $rsaResult = match ($validated['mode']) {
                'keygen' => $this->processRsaKeygen($request, $rsaService),
                'encrypt' => $this->processRsaEncrypt($request, $rsaService),
                'decrypt' => $this->processRsaDecrypt($request, $rsaService),
            };
        } catch (InvalidArgumentException $exception) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),
                    'errors' => [
                        'rsa' => [$exception->getMessage()],
                    ],
                ], 422);
            }

            return back()->withErrors(['rsa' => $exception->getMessage()])->withInput();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'mode' => $validated['mode'],
                'rsaResult' => $rsaResult,
            ]);
        }

        return view('pages.rsa', [
            'rsaResult' => $rsaResult,
            'gameChallenges' => $rsaService->getGameChallenges(),
        ]);
    }

    public function des(DesService $desService): View
    {
        return view('pages.des', [
            'desResult' => null,
            'gameChallenges' => $desService->getGameChallenges(),
        ]);
    }

    public function processDes(Request $request, DesService $desService)
    {
        $validated = $request->validate([
            'mode' => ['required', 'string', 'in:encrypt,decrypt'],
        ], [
            'mode.required' => 'Mode DES wajib dipilih.',
            'mode.in' => 'Mode DES tidak tersedia.',
        ]);

        try {
            $desResult = match ($validated['mode']) {
                'encrypt' => $this->processDesEncrypt($request, $desService),
                'decrypt' => $this->processDesDecrypt($request, $desService),
            };
        } catch (InvalidArgumentException $exception) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),
                    'errors' => [
                        'des' => [$exception->getMessage()],
                    ],
                ], 422);
            }

            return back()->withErrors(['des' => $exception->getMessage()])->withInput();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'mode' => $validated['mode'],
                'desResult' => $desResult,
            ]);
        }

        return view('pages.des', [
            'desResult' => $desResult,
            'gameChallenges' => $desService->getGameChallenges(),
        ]);
    }

    public function gost(GostService $gostService): View
    {
        return view('pages.gost', [
            'gostResult' => null,
            'gameChallenges' => $gostService->getGameChallenges(),
        ]);
    }

    public function processGost(Request $request, GostService $gostService)
    {
        $validated = $request->validate([
            'mode' => ['required', 'string', 'in:encrypt,decrypt'],
        ], [
            'mode.required' => 'Mode GOST wajib dipilih.',
            'mode.in' => 'Mode GOST tidak tersedia.',
        ]);

        try {
            $gostResult = match ($validated['mode']) {
                'encrypt' => $this->processGostEncrypt($request, $gostService),
                'decrypt' => $this->processGostDecrypt($request, $gostService),
            };
        } catch (InvalidArgumentException $exception) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),
                    'errors' => [
                        'gost' => [$exception->getMessage()],
                    ],
                ], 422);
            }

            return back()->withErrors(['gost' => $exception->getMessage()])->withInput();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'mode' => $validated['mode'],
                'gostResult' => $gostResult,
            ]);
        }

        return view('pages.gost', [
            'gostResult' => $gostResult,
            'gameChallenges' => $gostService->getGameChallenges(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    private function processDesEncrypt(Request $request, DesService $desService): array
    {
        $validated = $request->validate([
            'plaintext' => ['required', 'string', 'max:8'],
            'key' => ['required', 'string', 'size:8'],
        ], [
            'plaintext.required' => 'Plaintext wajib diisi.',
            'plaintext.max' => 'Plaintext maksimal 8 karakter untuk satu blok DES 64-bit.',
            'key.required' => 'Key DES wajib diisi.',
            'key.size' => 'Key DES wajib tepat 8 karakter agar menjadi 64-bit.',
        ]);

        return $desService->encryptText($validated['plaintext'], $validated['key']);
    }


    private function processDesDecrypt(Request $request, DesService $desService): array
    {
        $validated = $request->validate([
            'ciphertext_binary' => ['required', 'string', 'size:64', 'regex:/^[01]+$/'],
            'key' => ['required', 'string', 'size:8'],
        ], [
            'ciphertext_binary.required' => 'Ciphertext biner wajib diisi.',
            'ciphertext_binary.size' => 'Ciphertext DES wajib tepat 64 bit.',
            'ciphertext_binary.regex' => 'Ciphertext biner hanya boleh berisi angka 0 dan 1.',
            'key.required' => 'Key DES wajib diisi.',
            'key.size' => 'Key DES wajib tepat 8 karakter agar menjadi 64-bit.',
        ]);

        return $desService->decryptText($validated['ciphertext_binary'], $validated['key']);
    }

    private function processGostEncrypt(Request $request, GostService $gostService): array
    {
        $validated = $request->validate([
            'plaintext' => ['required', 'string', 'max:8'],
            'key' => ['required', 'string', 'size:32'],
        ], [
            'plaintext.required' => 'Plaintext wajib diisi.',
            'plaintext.max' => 'Plaintext maksimal 8 karakter untuk satu blok GOST.',
            'key.required' => 'Key GOST wajib diisi.',
            'key.size' => 'Key GOST wajib tepat 32 karakter.',
        ]);

        return $gostService->encryptText(
            $validated['plaintext'],
            $validated['key']
        );
    }

    private function processGostDecrypt(Request $request, GostService $gostService): array
    {
        $validated = $request->validate([
            'ciphertext_hex' => ['required', 'string', 'regex:/^[a-fA-F0-9]{16}$/'],
            'key' => ['required', 'string', 'size:32'],
        ], [
            'ciphertext_hex.required' => 'Ciphertext hex wajib diisi.',
            'ciphertext_hex.regex' => 'Ciphertext hex wajib 16 karakter heksadesimal.',
            'key.required' => 'Key GOST wajib diisi.',
            'key.size' => 'Key GOST wajib tepat 32 karakter.',
        ]);

        return $gostService->decryptText(
            $validated['ciphertext_hex'],
            $validated['key']
        );
    }

    private function processRsaKeygen(Request $request, RsaService $rsaService): array
    {
        $validated = $request->validate([
            'p' => ['required', 'integer', 'min:3', 'max:9973'],
            'q' => ['required', 'integer', 'min:3', 'max:9973'],
            'e' => ['required', 'integer', 'min:2', 'max:1000000'],
        ], [
            'p.required' => 'Nilai p wajib diisi.',
            'p.integer' => 'Nilai p harus berupa bilangan bulat.',
            'p.min' => 'Nilai p minimal 3.',
            'p.max' => 'Nilai p terlalu besar untuk simulasi pembelajaran.',
            'q.required' => 'Nilai q wajib diisi.',
            'q.integer' => 'Nilai q harus berupa bilangan bulat.',
            'q.min' => 'Nilai q minimal 3.',
            'q.max' => 'Nilai q terlalu besar untuk simulasi pembelajaran.',
            'e.required' => 'Nilai e wajib diisi.',
            'e.integer' => 'Nilai e harus berupa bilangan bulat.',
            'e.min' => 'Nilai e minimal 2.',
            'e.max' => 'Nilai e terlalu besar untuk simulasi pembelajaran.',
        ]);

        return $rsaService->generateKeys(
            (int) $validated['p'],
            (int) $validated['q'],
            (int) $validated['e']
        );
    }

    private function processRsaEncrypt(Request $request, RsaService $rsaService): array
    {
        $validated = $request->validate([
            'plaintext' => ['required', 'string', 'max:120'],
            'public_e' => ['required', 'integer', 'min:2', 'max:1000000'],
            'public_n' => ['required', 'integer', 'min:2', 'max:100000000'],
        ], [
            'plaintext.required' => 'Plaintext wajib diisi.',
            'plaintext.max' => 'Plaintext maksimal 120 karakter untuk simulasi.',
            'public_e.required' => 'Nilai public exponent e wajib diisi.',
            'public_e.integer' => 'Nilai e harus berupa bilangan bulat.',
            'public_n.required' => 'Nilai n wajib diisi.',
            'public_n.integer' => 'Nilai n harus berupa bilangan bulat.',
        ]);

        return $rsaService->encryptText(
            $validated['plaintext'],
            (int) $validated['public_e'],
            (int) $validated['public_n']
        );
    }

    private function processRsaDecrypt(Request $request, RsaService $rsaService): array
    {
        $validated = $request->validate([
            'ciphertext' => ['required', 'string', 'max:2000', 'regex:/^[0-9,\s]+$/'],
            'private_d' => ['required', 'integer', 'min:2', 'max:100000000'],
            'private_n' => ['required', 'integer', 'min:2', 'max:100000000'],
        ], [
            'ciphertext.required' => 'Ciphertext wajib diisi.',
            'ciphertext.regex' => 'Ciphertext hanya boleh berisi angka, spasi, atau koma.',
            'ciphertext.max' => 'Ciphertext terlalu panjang untuk simulasi.',
            'private_d.required' => 'Nilai private exponent d wajib diisi.',
            'private_d.integer' => 'Nilai d harus berupa bilangan bulat.',
            'private_n.required' => 'Nilai n wajib diisi.',
            'private_n.integer' => 'Nilai n harus berupa bilangan bulat.',
        ]);

        return $rsaService->decryptText(
            $validated['ciphertext'],
            (int) $validated['private_d'],
            (int) $validated['private_n']
        );
    }
}
