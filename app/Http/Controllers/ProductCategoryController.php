<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_category = ProductCategory::latest()->orderBy('id')->paginate(5);
     
        return view('productcategories.index',compact('product_category'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productcategories.create');
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
            'category_name' => 'required',
            'category_description' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        ProductCategory::create($request->all());
        return redirect()->route('productcategories.index')->with('success','Product Category created successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $productCategory = ProductCategory::findOrFail($id);
        return view('productcategories.show',compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        return view('productcategories.edit',compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);
        
        ProductCategory::whereId($id)->update($data);
        return redirect()->route('productcategories.index')->with('success','Product updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::find($id)->delete();
        return redirect()->route('productcategories.index')
->with('success','Product category has been deleted successfully');
    }
}
