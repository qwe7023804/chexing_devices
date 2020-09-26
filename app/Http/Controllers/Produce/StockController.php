<?php

namespace App\Http\Controllers\Produce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produce\Sp100Stock;

class StockController extends BaseController
{
    public function index(Request $request, Sp100Stock $stock)
    {
        $where = function ($query) use ($request) {
            if ($request->has('devsn') and $request->devsn != '') {
                $query->where('devsn', $request->devsn);
            }
        };
        $stockslist = $stock::with('operator:id,name')
            ->where($where)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return $this->success_msg('Success', $stockslist);
    }
}
