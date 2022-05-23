@extends('layouts.layout')
@section('content')
<div class="container">    
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
               
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('productcategories.index') }}"> Back</a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $productCategory->category_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Desription:</strong>
                {{ $productCategory->category_description }}
            </div>
        </div>
       
    </div>
</div>
@endsection