<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

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

        $permissions = Permission::all();
        $can = [];
        foreach ($permissions as $permission) {
            $can[$permission->name] = Auth::user() && Auth::user()->can($permission->name);
        }
        return [
            'user' => [
                'login' => Auth::check() ? true : false,
                'authUser' => Auth::check() ? Auth::user():'',
                'can' => $can
            ],
            'flash' => [
                'status' => fn() => $request->session()->get('status'),
                'message' => fn() => $request->session()->get('message'),
            ],
            'errors' => fn() => $request->session()->get('errors')
                ? $request->session()->get('errors')->getBag('default')->getMessages()
                : (object) [],
        ];
    }
}
