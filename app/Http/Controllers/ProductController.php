<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$products = DB::table('products')
                    ->join('product_categories', 'product_categories.id', '=', 'products.category_id')
                    ->select('products.*', 'product_categories.category_name');
        $search = '';
        if(isset($request->search)){
            $search = $request->search;
            $products = $products->orWhere('name', 'like', '%' . $search . '%');
        }
        $category = '';
        if(isset($request->category)){
            $category = $request->category;
            $products = $products->orWhere('category_id', '=', $category);
        }
        $products = $products->paginate(5);*/
        
        $categories = ProductCategory::productCategories();
        $products = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')->select(['products.*', 'product_categories.category_name']);
        $search = '';
        if(isset($request->search)){
            $search = $request->search;
            $products = $products->orWhere('name', 'like', '%' . $search . '%');
        }
        $category = '';
        if(isset($request->category)){
            $category = $request->category;
            $products = $products->orWhere('category_id', '=', $category);
        }
        $products = $products->sortable()->paginate(5);
        return view('products.index',['products' =>  $products,'categories'=>$categories,'search'=>$search,'category'=>$category])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::productCategories();
       
        return view('products.create',compact('categories'));
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
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success','Product created successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $product = DB::table('products')
        ->join('product_categories', 'product_categories.id', '=', 'products.category_id')
        ->select('products.*', 'product_categories.category_name')->where('products.id', $id)->first();

        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::productCategories();
        return view('products.edit',array('categories'=> $categories,'product'=>$product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success','Product updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('products.index')
->with('success','Product has been deleted successfully');
    }
}
