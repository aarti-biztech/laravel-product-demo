@extends('layouts.layout')
@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product Categories</h2>
               
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> View All Products</a>
                <a class="btn btn-success" href="{{ route('productcategories.create') }}"> Create New Category</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
    @if($product_category->isEmpty() || blank($product_category))
        <tr>
            <td colspan="5"> No Product Category Found!</td>
        </tr>
    @else
    @foreach ($product_category as $cat)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $cat->category_name }}</td>
            <td>{{ $cat->category_description }}</td>
            <td>
                <form action="{{ route('productcategories.destroy',$cat->id) }}" method="POST">  
                    <a class="btn btn-info" href="{{ route('productcategories.show',$cat->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('productcategories.edit',$cat->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    @endif        
    </table>
    {!! $product_category->appends(request()->input())->links(); !!}
</div>
@endsection