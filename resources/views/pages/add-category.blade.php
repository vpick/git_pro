@extends('layout.layout')

@section('content')

<div id="wrap">
  <div class="clear" style="height:5px;">
    
  <form action="{{ route('admin.category.store')}}" method="POST" >
    @csrf
    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
    <div id="wrap2">
      <h1>Add Category</h1>
      <br>
      <div class="" >
        @if(\Request::old('success'))
        <div class="alert alert-success" > {{\Request::old('success')}} </div>
        @elseif(\Request::old('error'))
        <div class="alert alert-danger" > {{\Request::old('error')}} </div>
        @endif
        </div>
    </div>
      <div class="form-raw">
        <div class="form-name">Category Name</div>
        <div class="form-txtfld">
          <input type="text" name="name" required value="{{ $data->name ?? '' }}">
        </div>
        @error('name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>    
      <div class="form-raw">
        <div class="form-name">Active</div>
        <div class="form-txtfld">
          @if(Route::is('admin.category.edit'))
          <input type="checkbox" name="is_active" value="1" @if($data->is_active == 1) checked @else @endif>
         @else
         <input type="checkbox" name="is_active" value="1">
         @endif
        </div>      
        <div class="clear"></div>
      </div>
          
      <div class="form-raw">
        <div class="form-name">&nbsp;</div>
        <div class="form-txtfld" style="width:290px;">
          <input type="submit" class="btn" value="Submit">
        </div>
      </div>
    </div>
  </form>
  <div class="clear">&nbsp;</div>
</div>
<div id="wrap3">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admintable">
    <tr>
      <th width="59" align="left" valign="middle">Sr.No.</th>
      <th width="752" align="left" valign="middle">Category Name</th>
      <th width="77" align="left" valign="middle">Status</th>
      <th width="54" align="left" valign="middle">Edit</th>
      <th width="71" align="left" valign="middle">Remove</th>
    </tr>
    @foreach($categories as $key=>$category)
      <tr>
        <td align="left" valign="top">{{ $key+1 }}</td>
        <td align="left" valign="top">{{ $category->name }}</td>
        <td align="left" valign="top">
          <a href="{{ route('admin.category.show', Crypt::encrypt($category->id)) }}">
            @if($category->is_active == '1')
                <span class="badge bg-success"><strong>Active</strong></span>
            @else
                <span class="badge bg-danger"><strong>Inactive</strong></span>
            @endif
          </a>
        </td>
        <td align="left" valign="top"><a href="{{ route('admin.category.edit', Crypt::encrypt($category->id)) }}"">Edit</a></td>
        <td align="center" valign="top">
          <form method="POST"  action="{{ route('admin.category.destroy', Crypt::encrypt($category->id)) }}">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure want to delete. Once deleted will never appear again.')" >
              <img src="{{ url('assets/images/icon-bin.jpg') }}" alt="" width="25" height="25" border="0" align="absmiddle" />
            </button>
          </form>  
        </td>   
      </tr>
      @endforeach
  </table>
  <div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>
@endsection