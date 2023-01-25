<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; 
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Crypt;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        $categories = Category::where('is_active',1)->get();
        $data =[];
        return view('pages.add-sub-category',compact('categories','subcategories','data'));
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
        $request->validate([
            'name' => 'required|min:4',
            'category_id' => 'required'    
        ]);
       // dd($request->all());
       $subcategory = SubCategory::where('name',$request->name)->where('id','!=',$request->id)->count();
       if($subcategory>0){
           return Redirect::back()->withInput(['error' => 'Name should be unique !!!']);
       }
        $updating = 0;
        $status = "SubCategory Added Successfully !!!";
        if(isset($request->id) && $request->id != null) {
            $data = SubCategory::find($request->id);
            if(!$data) {
                $data = new SubCategory;
                $data->is_active = isset($request->is_active) ?  : '0';
            } else {
                $updating = 1;
                $data->is_active =isset($request->is_active) ?  : '0';
  
                $status = "SubCategory Updated Successfully !!!";
            }
        } else {
            $data = new SubCategory;
            $data->is_active = isset($request->is_active) ?  : '0';
        } 
        try{
            $data->name = $request->name;
            $data->category_id = $request->category_id;
            $data->save();
            return redirect()->route('admin.subcategory.index')->withInput(['success' => $status]);
        }
        catch(\Exception $e) {
            return Redirect::back()->withInput(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data = SubCategory::find($id);
        if($data->is_active == '1'){
            $data->is_active = '0';
        }
        else {
            $data->is_active = '1';
        }
        
        try {
            $data->save();
            return Redirect::back()->withInput(['success' => 'SubCategory status updated!!!']);
        } catch(\Exception $e) {
            return Redirect::back()->withInput(['error' => $e->getMessages]);
        } 

        return Redirect::back()->withInput(['error' => 'SubCategory not Found!!!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data = SubCategory::find($id);
        $subcategories = SubCategory::get();
        $categories = Category::where('is_active',1)->get();
        if($data) {
            return view('pages.add-sub-category', compact('data','subcategories','categories'));
        } 
        return Redirect::back()->withInput(['error' => 'Data not found']);
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
        $id  = Crypt::decrypt($id);
        $data = SubCategory::find($id);
        if($data) {
            $data->delete();
            return Redirect::back()->withInput(['success' => 'Data Deleted !!']);
        }
        return Redirect::back()->withInput(['error' => 'Data not found !!']);
    }
}
