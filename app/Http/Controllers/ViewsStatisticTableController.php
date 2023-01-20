<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewsStatisticTableController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->get)){
            $viewsAmount = View::where('product_id', $request->user)->select(DB::raw('SUM(views) as sum'), 'hour', 'date')->groupByRaw('hour')->groupByRaw('date')->get('sum')->toArray();
            $data = [];
            foreach ($viewsAmount as $item) {
                if (!isset($data[$item['date']])) {
                    $data[$item['date']] = array_fill(1, 24, 0);
                }
                $data[$item['date']][$item['hour']] = $item['sum'];
            }
            return $data;
        }else{
            return view('UsersProductStatisticList.productStatisticLayout');
        }
    }
}
