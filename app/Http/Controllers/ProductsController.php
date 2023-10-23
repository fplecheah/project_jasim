<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=array(
            'product_name' => 'required|unique:products',
            'sku_id' => 'required|unique:products',
            'sales_price' => 'required|numeric'
        );
        $messages=array(
            'product_name.required' => 'Please enter a product name.',
            'product_name.unique' => 'Product name should be unique.',
            'sku_id.required' => 'Please enter a sku id.',
            'sku_id.unique' => 'SKU Id should be unique.',
            'sales_price.required' => 'Please enter a sales price.',
            'sales_price.numeric' => 'Sales price must be a number'
        );
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            return response()->json(["messages"=>$messages], 500);
        }
    $products = new Products;
        $products->product_name = $request->product_name;
        $products->sku_id = $request->sku_id;
        $products->hsn_code = $request->hsn_code;
        $products->cost_price = $request->cost_price;
        $products->tax = $request->tax;
        $products->cess_extra = $request->cess_extra;
        $products->sales_price = $request->sales_price;
        $products->save();
        return response()->json(["product" => $products, "message"=>"Product has been created successfully"], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
