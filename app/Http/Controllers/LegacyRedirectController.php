<?php

namespace App\Http\Controllers;

use App\Models\Redirect as LegacyRedirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LegacyRedirectController extends Controller
{
    public function __invoke(Request $request)
    {
        if (! Schema::hasTable('redirects')) {
            throw new NotFoundHttpException;
        }

        $sourcePath = '/' . trim($request->path(), '/') . '/';
        $destination = $sourcePath;
        $visited = [];
        $maxHops = LegacyRedirect::query()->active()->count() + 1;

        for ($hop = 0; $hop < $maxHops; $hop++) {
            if (isset($visited[$destination])) {
                Log::warning('Legacy redirect loop detected.', ['source_path' => $sourcePath]);

                throw new NotFoundHttpException;
            }

            $visited[$destination] = true;
            $redirect = LegacyRedirect::query()
                ->active()
                ->where('source_path', $destination)
                ->first();

            if (! $redirect) {
                if ($destination === $sourcePath) {
                    throw new NotFoundHttpException;
                }

                $route = Route::getRoutes()->match(Request::create($destination, 'GET'));
                if ($route->getName() === 'legacy.redirect') {
                    throw new NotFoundHttpException;
                }

                return redirect()->to(config('site.canonical_url') . $destination, 301);
            }

            if ($redirect->status_code !== 301 || ! $this->isSafeLocalPath($redirect->destination_url)) {
                Log::warning('Invalid legacy redirect configuration.', [
                    'source_path' => $sourcePath,
                    'redirect_id' => $redirect->id,
                ]);

                throw new NotFoundHttpException;
            }

            $destination = $redirect->destination_url;
        }

        Log::warning('Legacy redirect exceeded the configured redirect chain limit.', [
            'source_path' => $sourcePath,
        ]);

        throw new NotFoundHttpException;
    }

    private function isSafeLocalPath(string $destination): bool
    {
        if (! str_starts_with($destination, '/') || str_starts_with($destination, '//')
            || preg_match('/[\x00-\x1F\x7F\\\\]/', $destination)) {
            return false;
        }

        $parts = parse_url($destination);
        if ($parts === false || isset($parts['scheme']) || isset($parts['host'])
            || isset($parts['user']) || isset($parts['pass'])
            || isset($parts['query']) || isset($parts['fragment'])) {
            return false;
        }

        foreach (explode('/', rawurldecode($parts['path'] ?? '')) as $segment) {
            if ($segment === '.' || $segment === '..') {
                return false;
            }
        }

        return true;
    }
}
