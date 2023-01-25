<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Redirect;
use Response;

class AjaxController extends Controller
{
    public function getsubcat($id) {
        $data = SubCategory::where('category_id', $id)
                ->with('category')
                ->get();
               // dd($data);
        return Response::json(['data' => $data]);

    }
}
