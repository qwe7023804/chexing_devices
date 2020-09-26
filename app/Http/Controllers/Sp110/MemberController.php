<?php

namespace App\Http\Controllers\Sp110;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sp110\Member;


class MemberController extends BaseController
{
    public function index(Request $request, Member $member)
    {
        $where = function ($query) use ($request) {
            if ($request->has('userphone') and $request->userphone != '') {
                $query->where('userphone', $request->userphone);
            }
        };
        $memberslist = $member::with('identity')
            ->where($where)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return $this->success_msg('Success', $memberslist);
    }

}
