<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; 
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductPdf;
use Illuminate\Support\Facades\Crypt;
use Image;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('is_active',1)->get();
        $subcategories = SubCategory::where('is_active',1)->get();
        $products =Product::get();
        return view('pages.product',compact('categories','subcategories','products'));
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
           
            'category_id' => 'required', 
            'subcategory_id' => 'required',
            'name' => 'required|min:4|unique:products',
            'image.*' => 'required|mimes:png,jpg,jpeg,gif,webp|max:2305',
            
        ]);
        //dd($request->all());
       $product = Product::where('name',$request->name)->where('id','!=',$request->id)->count();
       if($product>0){
           return Redirect::back()->withInput(['error' => 'Name should be unique !!!']);
       }
        $updating = 0;
        $status = "Product Added Successfully !!!";
        if(isset($request->id) && $request->id != null) {
            $data = Product::find($request->id);
            if(!$data) {
                $data = new Product;
                $data->is_active = isset($request->is_active) ?  : '0';
            } else {
                $updating = 1;
                $data->is_active =isset($request->is_active) ?  : '0';
  
                $status = "Product Updated Successfully !!!";
            }
        } else {
            $data = new Product;
            $data->is_active = isset($request->is_active) ?  : '0';
        } 
        try{
            $data->name = $request->name;
            $data->category_id = $request->category_id;
            $subcategory = collect($request->subcategory_id)->implode(',');
            $data->sub_category_id = $subcategory;
            $data->name = $request->name;
            $name = rand(11111,99999).time().'.webp';
                $image = Image::make($request['image'])->resize(560, 390, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploads/'.$name);
                $data->image = $name;
            $data->short_description = $request->short_description;
            $data->content = $request->content;
            
            $data->save();
            // foreach ($request->moreFields as $key => $value) {
            //     $pd = new ProductDescription;
            //     $pd->product_id=$data->id;
            //     $pd->title = $value->title;
            //     $pd->heading = $value->heading;
            //     $pd->description = $value->description;
            //     $pd->save();
            // }
            // foreach ($request->moreInput as $key => $value) {
            //     $pdf = new ProductPdf;
            //     $pdf->product_id=$data->id;
            //     $pdf->heading = $value->heading;
            //     $name = $request->file('file')->getClientOriginalName();
            //     $path = $request->file('file')->store('public/uploads');
            //     $pdf->file = $name;
            //     $pdf->save();
            // }
            return redirect()->route('admin.product.index')->withInput(['success' => $status]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
