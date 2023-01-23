<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;

class   UserProductsListController extends Controller
{
    public function index()
    {
        return view('UsersProducts.layout');
    }

    public function show(Request $request)
    {
        if(!isset($request->get)){
            $currentMin = date('i');
            if(View::where('product_id', $request->prodId)->doesntExist()) {
                View::create([
                    'product_id' => $request->prodId,
                    'views' => 1,
                    'date' => date('Y-m-d'),
                    'hour' => date('G'),
                    'minute' => date('i'),
                ]);
            }else{
                $viewProductDate = View::where('product_id', $request->prodId)->where('minute', $currentMin)->get('minute');
                if(!empty($viewProductDate->toArray())){
                    if($currentMin == $viewProductDate->toArray()[0]['minute']){
                        $viewCount = View::where('product_id', $request->prodId)->where('minute', $currentMin)->get('views');
                        $count = $viewCount->toArray()[0]['views'];
                        $count++;
                        View::where('product_id', $request->prodId)->where('minute', $currentMin)->update([
                            'views' => $count
                        ]);
                    }
                }else{
                    View::create([
                        'product_id' => $request->prodId,
                        'views' => 1,
                        'date' => date('Y-m-d'),
                        'hour' => date('G'),
                        'minute' => date('i'),
                    ]);
                }
            }
        }

        return View::where('product_id', $request->prodId)->where('minute', date('i'))->get('views');
    }
}
