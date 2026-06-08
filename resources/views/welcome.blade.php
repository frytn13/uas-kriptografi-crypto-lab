<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Crypto Lab') }}</title>
    <meta http-equiv="refresh" content="0; url={{ route('home') }}">
    <style>
        :root {
            color-scheme: dark;
            --background: #030303;
            --foreground: #f7f7f2;
            --muted: rgba(247, 247, 242, 0.62);
            --line: rgba(255, 255, 255, 0.16);
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            background: var(--background);
            color: var(--foreground);
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        main {
            width: min(92vw, 560px);
            border: 1px solid var(--line);
            padding: 32px;
            text-align: center;
        }

        h1 {
            margin: 0 0 16px;
            font-size: clamp(28px, 8vw, 64px);
            font-weight: 400;
            letter-spacing: 0.16em;
        }

        p {
            margin: 0 0 28px;
            color: var(--muted);
            line-height: 1.8;
            text-transform: none;
            letter-spacing: 0.02em;
        }

        a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 22px;
            border: 1px solid var(--line);
            color: var(--foreground);
            text-decoration: none;
            border-radius: 999px;
            font-size: 12px;
            letter-spacing: 0.14em;
        }
    </style>
</head>
<body>
    <main>
        <h1>Crypto Lab</h1>
        <p>Redirecting to the main dashboard.</p>
        <a href="{{ route('home') }}">Open Dashboard</a>
    </main>
</body>
</html>
