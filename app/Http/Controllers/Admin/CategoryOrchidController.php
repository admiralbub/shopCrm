<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Admin\Category\UpdateSortAction;
class CategoryOrchidController extends Controller
{
    public function editSort(Request $request) {
        return (new UpdateSortAction())->execute($request->orderLists,$request->parent);
    }
}
