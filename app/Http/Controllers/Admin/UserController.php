<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * @return Response
     */
    public function index()
    {
        $users = User::query()->paginate(15);

        return Inertia::render('Admin/Users/Index', [
            'users' => UserResource::collection($users),
            'can' => [
                'create' => Auth::user()->can('create', User::class),
            ],
        ]);
    }

    /**
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return Inertia::render('Admin/Users/User', [
            'user' => UserResource::make($user),
        ]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Admin/Users/Create', [
            'roleOptions' => UserRole::getOptions(),
            'user' => [
                'data' => (object)[
                    'role' => UserRole::Admin,
                ],
                'meta' => [
                    'can' => [
                        'changeRole' => Auth::user()->can('changeRole', User::class),
                    ],
                ],
            ]
        ]);
    }

    /**
     * @param UserStoreRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(UserStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['password'] = bcrypt($attributes['password']);

        $model = User::make($attributes);
        $model->save();

        return redirect(route('admin.users.show', ['user' => $model->id]));
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();
        $attributes = Arr::except($validated, ['password']);
        if ($validated['password']) {
            $attributes['password'] = bcrypt($validated['password']);
        }

        $user->fill($attributes)->save();

        return Redirect::route('admin.users.show', ['user' => $user->id]);
    }

    /**
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', [
            'user' => UserResource::make($user),
            'roleOptions' => UserRole::getOptions(),
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::back();
    }
}
