<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('ProductList/layout');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function show(Request $request)
    {

        return Product::with('image')
            ->with('user')
            ->where('user_id' , $request->id)
            ->paginate(5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return EditProductRequest
     */
    public function edit(EditProductRequest $request)
    {
        Product::find($request->id)
            ->update([
                "name" => $request->name,
                "price" => $request->price,
                "description" => $request->description,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
    }
}
