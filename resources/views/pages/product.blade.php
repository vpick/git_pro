@extends('layout.layout')

@section('content')

<div id="wrap">
  <div class="clear" style="height:5px;"></div>
  <div id="wrap2">
    <h1>Add Product</h1>
    <br>
    <div class="" >
      @if(\Request::old('success'))
      <div class="alert alert-success" > {{\Request::old('success')}} </div>
      @elseif(\Request::old('error'))
      <div class="alert alert-danger" > {{\Request::old('error')}} </div>
      @endif
    </div>
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="form-raw">
      <div class="form-name">Select Category</div>
      <div class="form-txtfld">
        <select name="category_id" id="category_id">
          <option>Select Option</option>   
          @foreach ($categories as $key=>$category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach   
        </select>
        @error('category_id')
              <small class="text-danger">{{ $message }}</small>
            @enderror
      </div>
    </div>
      <div class="clear"></div>


        <div class="form-raw">
        <div class="form-name">Select Sub Category</div>
        <div class="form-txtfld">
          <select multiple="select" style="height: 100px;" name="subcategory_id[]" id="subcategory_id">
              <option>Select Option</option>
              
          </select>
          @error('subcategory_id')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
      </div>
      <div class="clear"></div>
    
      <div class="form-raw">
        <div class="form-name">Product Name</div>
        <div class="form-txtfld">
          <input type="text" name="name">
          @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
      </div>
      <div class="form-raw">
        <div class="form-name">Product Image1</div>
        <div class="form-txtfld">
          <input type="file" name="image">
          <div class="form-name"> Image Size ( Width=560px, Height=390px ) (Product page)</div>
        </div>
      </div>
      <div class="form-raw" style="width:100%;">
        <div class="form-name">Short Description</div>
        <div class="form-txtfld">
          <textarea name="short_description"></textarea>
          @error('short_description')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
      </div>
  
  <div class="clear"></div>
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Description</h1>
    <br> 
    <table id="dynamicAddRemove">
      <tr>  
        <td>
          <div class="form-raw">
            <div class="form-name"> &nbsp;</div> 
              <div class="form-txtfld">
                <input type="text"  placeholder="Title" name="moreFields[0][title]">
              </div>
            </div>
      
            <div class="form-raw">
              <div class="form-name"> &nbsp;</div> 
                <div class="form-txtfld txtfld50"><input type="text" placeholder="heading" name="moreFields[0][heading]"></div>
                <div class="form-txtfld txtfld50"><input type="text" placeholder="desciption" name="moreFields[0][description]"></div>
              </div>
       
            <div class="form-raw">
              <div class="form-name">&nbsp;</div>
              <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="#" id="add-btn">Add More +</a></div>
            </div>
          </td>
        </tr>
      </table>
{{--   
    <table>
      <tr>  
        <td>
          <div class="form-raw">
            <div class="form-name"> &nbsp;</div> 
              <div class="form-txtfld">
                <input type="text"  placeholder="Title" name="title">
              </div>
          </div>
        </td>
      </tr>
      <tr>
          <td>
            <div class="form-raw">
            <div class="form-name"> &nbsp;</div> 
              <div class="form-txtfld txtfld50"><input type="text" placeholder="heading" name="heading"></div>
              <div class="form-txtfld txtfld50"><input type="text" placeholder="desciption" name="description"></div>
            </div>
        </td>         
        <td><a href="#"><img src="images/delete.gif" alt=""></a></td> 
      </tr>
      <tr>
        <td>
          <div class="form-raw">
            <div class="form-name">&nbsp;</div>
            <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="#">Add More +</a></div>
          </div>
        </td>
      </tr>
    </table>
  
 
  
    <table>
      <tr>  
        <td>
          <div class="form-raw">
            <div class="form-name"> &nbsp;</div> 
              <div class="form-txtfld">
                <input type="text"  placeholder="Title" name="title">
              </div>
          </div>
        </td>
      </tr>
      <tr>
          <td>
            <div class="form-raw">
            <div class="form-name"> &nbsp;</div> 
              <div class="form-txtfld txtfld50"><input type="text" placeholder="heading" name="heading"></div>
              <div class="form-txtfld txtfld50"><input type="text" placeholder="desciption" name="description"></div>
            </div>
        </td>         
        <td><a href="#"><img src="images/delete.gif" alt=""></a></td> 
      </tr>
      <tr>
        <td>
          <div class="form-raw">
            <div class="form-name">&nbsp;</div>
            <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="#">Add More +</a></div>
          </div>
        </td>
      </tr>
    </table> --}}
  
 <!--  <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" placeholder="heading"></div>
      <div class="form-txtfld txtfld50"><input type="text" placeholder="desciption"></div>
      <a href="#"><img src="images/delete.gif" alt=""></a>      
  </div> -->
  
  
  
  
  
  
  
  <div class="clear"></div>
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Features</h1>
    <br>  
  <div class="form-raw" style="width:100%;">
    <div class="form-name">Content</div>
    <div class="form-txtfld" style="width:980px;height:220x">
      <textarea name="content" id="editor"></textarea>
      @error('content')
              <small class="text-danger">{{ $message }}</small>
            @enderror
    </div>
  </div>
  <div class="clear"></div>
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Upload PDF</h1>
    <br>  
  <table id="dynamicAddRemove1">
    <tr>
      <div class="form-raw">
          <div class="form-name">&nbsp;</div>
          <div class="form-txtfld txtfld50"><input type="text" placeholder="PDF heading" name="moreInput[0][heading]"></div>
          <div class="form-txtfld txtfld50"><input type="file" placeholder="desciption" name="moreInput[0][file]"></div>
      </div>
      <div class="form-raw">
          <div class="form-name">&nbsp;</div>
          <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="#" id="add-btn1">Add More +</a></div>
      </div>
    </tr>
  </table>
  {{-- <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" placeholder="PDF heading"></div>
      <div class="form-txtfld txtfld50"><input type="file" placeholder="desciption"></div>
  </div>
  <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="#">Add More +</a></div>
  </div> --}}

   {{-- <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" placeholder="PDF heading"></div>
      <div class="form-txtfld txtfld50"><input type="file" placeholder="desciption"></div>
      <a href="#"><img src="images/delete.gif" alt=""></a>      
  </div> --}}
  



     <!-- <div class="form-raw">
      <div class="form-name">Heading</div>
      <div class="form-txtfld">
        <input type="text">
      </div>
    </div> 
     <div class="form-raw">
      <div class="form-name">PDF</div>
      <div class="form-txtfld">
        <input type="file">
      </div>
    </div> -->
  
  
  
  <div class="clear"></div>
  <div class="form-raw">
    <div class="form-name">Active</div>
    <div class="form-txtfld">
      <input type="checkbox" name="is_active" value="1">
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
  <div class="form-raw">
    <div class="form-name">&nbsp;</div>
    <div class="form-txtfld">
      <input type="submit" class="btn" value="Submit">
    </div>
  </div>
</form>
</div>

<div class="clear">&nbsp;</div>
</div>
<div id="wrap2">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admintable">
    <tr>
      <th width="53" align="left" valign="middle">Sr.No.</th>
      <th width="153" align="left" valign="middle">Select Category</th>
      <th width="71" align="left" valign="middle"> Select Sub Category</th>
     <th width="71" align="left" valign="middle"> Product Name</th>
     
      <th width="408" align="left" valign="middle">Short Description</th>
      <th width=" " align="left" valign="middle">Full Description</th>
      <th width="49" align="left" valign="middle">Status</th>
      
      <th width="49" align="left" valign="middle">Edit</th>
      <th width="61" align="left" valign="middle">Remove</th>
    </tr>
    @foreach ($products as $key=>$product)
      <tr>
      <td align="left" valign="top">{{ $key+1 }}</td>
      <td align="left" valign="top">{{ $product->category_id }}</td>
      <td align="left" valign="top">{{ $product->sub_category_id }}</td>
      <td align="left" valign="top">{{ $product->name }}</td>
      
      <td align="left" valign="top">{{ $product->short_description }}</td>
      <td align="left" valign="top">{{ $product->content }}</td>
 

      <td align="left" valign="top"><strong>Active</strong></td>
      <td align="left" valign="top"><a href="#">Edit</a></td>
      <td align="center" valign="top"><a href="#"><img src="{{ url('assets/images/icon-bin.jpg') }}" alt="" width="25" height="25" border="0" align="absmiddle" /></a></td>
    </tr>
    @endforeach
    
  </table>  
  <div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>
@endsection

