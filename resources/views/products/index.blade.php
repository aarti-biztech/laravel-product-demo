@extends('layouts.layout')
@section('content')
<div class="container">

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
               
            </div>
            <div class="pull-right">       
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                <a class="btn btn-primary" href="{{ route('productcategories.index') }}"> View All Categories</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <form action="{{ route('products.index') }}" method="POST" style="margin: 30px 0;">  
            <div class="col-lg-6">
            <input type="text" name="search" placeholder="Search.." value="{{$search}}" class="form-control">
            </div>
            <div class="col-lg-4">
            @if ($categories)
                <select name="category" class="form-control">
                    <option value="">--Select Category--</option>
                @foreach($categories as $key => $cat)
                    <option value="{{$key}}" {{ ( $category == $key ) ? 'selected' : '' }}>{{$cat}}</option>
                @endforeach
                </select>
            @endif
            </div>
            @csrf
            @method('GET')
            <button type="submit" class="btn btn-success">Search</button>
            <a class="btn btn-danger" href="{{ route('products.index') }}">Clear</a>
    </form>
   
    <table class="table table-bordered" >
        <tr>
            <th>No</th>
            <th>@sortablelink('name')</th>
            <th>@sortablelink('price')</th>
            <th>Category</th>
            <th width="280px">Action</th>
        </tr>
    @if($products->isEmpty() || blank($products))
        <tr>
            <td colspan="5"> No Product Found!</td>
        </tr>
    @else
    @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->category_name }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">  
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    @endif        
    </table>
    {!! $products->appends(request()->input())->links();!!}
</div>
@endsection