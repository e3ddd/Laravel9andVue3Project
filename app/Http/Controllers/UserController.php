<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('AdminPanel/layout');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return true
     */
    public function edit(EditUserRequest $request, User $user)
    {
        $user::find($request->id)
            ->update(['email' => $request->email]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function destroy(User $user, Request $request)
    {
        $user::find($request->id)->delete();
    }
}
