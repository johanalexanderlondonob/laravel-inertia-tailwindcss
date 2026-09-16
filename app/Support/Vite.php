<?php

namespace App\Support;

/**
 * Minimal @vite Blade directive for Laravel 8 / PHP 7.4, which predate
 * the official Illuminate\Foundation\Vite helper (added in Laravel 9.19).
 * Mirrors laravel-vite-plugin's public/hot file convention for dev mode.
 */
class Vite
{
    public static function render(array $entrypoints): string
    {
        $hotFile = public_path('hot');

        if (file_exists($hotFile)) {
            $url = rtrim(file_get_contents($hotFile));

            $tags = sprintf('<script type="module" src="%s/@vite/client"></script>', $url);

            foreach ($entrypoints as $entry) {
                $tags .= sprintf('<script type="module" src="%s/%s"></script>', $url, $entry);
            }

            return $tags;
        }

        $manifestPath = public_path('build/manifest.json');
        $manifest = json_decode(file_get_contents($manifestPath), true);

        $tags = '';

        foreach ($entrypoints as $entry) {
            $chunk = $manifest[$entry] ?? null;

            if (! $chunk) {
                continue;
            }

            foreach ($chunk['css'] ?? [] as $cssFile) {
                $tags .= sprintf('<link rel="stylesheet" href="%s">', asset('build/' . $cssFile));
            }

            $tags .= sprintf('<script type="module" src="%s"></script>', asset('build/' . $chunk['file']));
        }

        return $tags;
    }
}
