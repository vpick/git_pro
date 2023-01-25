<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; 
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Crypt;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        
        return view('pages.add-category',compact('categories'));
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
            
        ]);
       // dd($request->all());
       $category = Category::where('name',$request->name)->where('id','!=',$request->id)->count();
       if($category>0){
           return Redirect::back()->withInput(['error' => 'Name should be unique !!!']);
       }
        $updating = 0;
        $status = "Category Added Successfully !!!";
        if(isset($request->id) && $request->id != null) {
            $data = Category::find($request->id);
            if(!$data) {
                $data = new Category;
                $data->is_active = isset($request->is_active) ?  : '0';
            } else {
                $updating = 1;
                $data->is_active = isset($request->is_active) ?  : '0';
                $status = "Category Updated Successfully !!!";
            }
        } else {
            $data = new Category;   
            $data->is_active = isset($request->is_active) ?  : '0';
        }
        try{
            $data->name = $request->name;
            
           
            $data->save();
            return redirect()->route('admin.category.index')->withInput(['success' => $status]);
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
        $data = Category::find($id);
        if($data->is_active == '1'){
            $data->is_active = '0';
        }
        else {
            $data->is_active = '1';
        }
        
        try {
            $data->save();
            return Redirect::back()->withInput(['success' => 'Category status updated!!!']);
        } catch(\Exception $e) {
            return Redirect::back()->withInput(['error' => $e->getMessages]);
        } 

        return Redirect::back()->withInput(['error' => 'Category not Found!!!']);
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
        $data = Category::find($id);
        $categories = Category::get();
        if($data) {
            return view('pages.add-category', compact('data','categories'));
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
        $data = Category::find($id);
        $subcat = SubCategory::where('category_id',$id)->get();
        //dd($subcat);
        if(count($subcat)>0){
            return Redirect::back()->withInput(['error' => 'category can not deleted because it has subcategory !!']);
        }
        else{
            if($data) {
                $data->delete();
                return Redirect::back()->withInput(['success' => 'Data Deleted !!']);
            }
        return Redirect::back()->withInput(['error' => 'Data not found !!']);
        }
    }
}
