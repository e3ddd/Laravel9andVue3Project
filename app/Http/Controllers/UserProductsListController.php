<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use App\Models\Products;
use App\Models\Views;
use Illuminate\Http\Request;

class   UserProductsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('UsersProducts.layout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, Products $products, ProductImages $images, Views $views)
    {
        if(!isset($request->get)){
            $currentMin = date('i');
            if($views->where('product_id', $request->prodId)->doesntExist()) {
                $views::create([
                    'product_id' => $request->prodId,
                    'views' => 1,
                    'date' => date('Y-m-d'),
                    'hour' => date('G'),
                    'minute' => date('i'),
                ]);
            }else{
                $viewProductDate = $views::where('product_id', $request->prodId)->where('minute', $currentMin)->get('minute');
                if(!empty($viewProductDate->toArray())){
                    if($currentMin == $viewProductDate->toArray()[0]['minute']){
                        $viewCount = $views::where('product_id', $request->prodId)->where('minute', $currentMin)->get('views');
                        $count = $viewCount->toArray()[0]['views'];
                        $count++;
                        $views::where('product_id', $request->prodId)->where('minute', $currentMin)->update([
                            'views' => $count
                        ]);
                    }
                }else{
                    $views::create([
                        'product_id' => $request->prodId,
                        'views' => 1,
                        'date' => date('Y-m-d'),
                        'hour' => date('G'),
                        'minute' => date('i'),
                    ]);
                }
            }
        }

        return $views->where('product_id', $request->prodId)->where('minute', date('i'))->get('views');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
