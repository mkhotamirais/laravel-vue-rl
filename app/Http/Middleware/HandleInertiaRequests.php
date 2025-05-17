<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use App\Models\Rental;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => fn() => $request->user()
                    ? $request->user()->only('id', 'name', 'email', 'role')
                    : null,
            ],
            'searchResults' => function () use ($request) {
                $query = $request->query('q');

                if ($query) {
                    return [
                        'rentalResults' => Rental::filter(['q' => $query])
                            ->orderBy('name', 'asc')
                            ->get(['id', 'banner', 'name', 'slug']),
                        'blogResults' => Blog::filter(['q' => $query])
                            ->orderBy('title', 'asc')
                            ->get(['id', 'title', 'banner', 'slug']),
                    ];
                }

                return [
                    'rentalResulst' => [],
                    'blogResults' => [],
                ];
            },
        ];
    }
}
