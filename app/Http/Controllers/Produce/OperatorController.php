<?php

namespace App\Http\Controllers\Produce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produce\Operator;


class OperatorController extends BaseController
{
    public function index(Request $request, Operator $operator)
    {
        $where = function ($query) use ($request) {
            if ($request->has('userphone') and $request->userphone != '') {
                $query->where('userphone', $request->userphone);
            }
        };
        $operatorslist = $operator::where($where)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return $this->success_msg('Success', $operatorslist);
    }

}
