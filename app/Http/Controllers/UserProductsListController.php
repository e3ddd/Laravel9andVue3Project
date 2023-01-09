<?php

namespace App\Http\Controllers;

use App\Models\View;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, View $views)
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
}
