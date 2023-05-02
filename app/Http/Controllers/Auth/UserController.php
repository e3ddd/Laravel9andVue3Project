<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Services\UserService;
use Couchbase\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show admin panel page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('AdminPanel/layout');
    }

    /**
     * Get auth user data
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function get()
    {
        return Auth::user();
    }

    /**
     * Get auth user by id
     * @return mixed
     */
    public function getUser()
    {
        /** @var UserService $userService */
        $userService = app(UserService::class);
        return $userService->getUser(Auth::user()->id);
    }

    /**
     * Edit user
     * @param EditUserRequest $request
     * @return void
     */
    public function edit(EditUserRequest $request)
    {
        /** @var UserService $userService */
        $userService = app(UserService::class);

        $userService->update($request->id, $request->email);
    }

    /**
     * Delete user
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        /** @var UserService $userService */
        $userService = app(UserService::class);

        $userService->destroy($request->id);
    }

}
