<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use Illuminate\Http\Request;

class GetProductImages extends Controller
{
    public function get(Request $request, ProductImages $images)
    {
        $img = $images::where('product_id', $request->id)->get()->toArray();
        $paths = [];
        foreach ($img as $key => $item) {
            $paths[] = [
                'path' => storage_path() . public_path('images') . '/'
                    . $img[$key]['user_id'] . '_'
                    . $img[$key]['product_id'] . '_'
                    . $img[$key]['hash_id'],
                'path_small' => storage_path() . public_path('images') . '/SMALL_'
                    . $img[$key]['user_id'] . '_'
                    . $img[$key]['product_id'] . '_'
                    . $img[$key]['hash_id'],
                'hash' => $img[$key]['hash_id'],
                'name'=> $img[$key]['user_id'] . '_'
                    . $img[$key]['product_id'] . '_'
                    . $img[$key]['hash_id']
            ];
        }
        return $paths;
    }
}
