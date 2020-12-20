<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductUpdate;

use App\Http\Requests\ProductStore;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(request('search')){
        //     Product::where('name','like','%' . request('search').'%' )
        //     ->orderBy('id','desc')->paginate(5);

        // }else{
        //     return Product::orderBy('id','desc')->paginate(5);
        // }

        // $product=Product::query();
        // if(request('search')){
        //     $product->where('name','like','%' . request('search').'%' )
        //     ->orderBy('id','desc')->paginate(5);

        // }else{
        //     return $product->orderBy('id','desc')->paginate(5);
        // }

        return Product::when(request('search'), function($query){
            $query->where('name','like','%' . request('search').'%' );
        })
        ->orderBy('id','desc')->paginate(5);
       
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request)
    {
        $product=Product::create($request->only('name','price'));
        return $product;
        // return['success'];
        
        
    }

  


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prodcut=Product::find($id);
        return  $prodcut;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request,Product $product)
    {
           
            $product->update($request->only('name','price'));
            return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $product;
    }
}
