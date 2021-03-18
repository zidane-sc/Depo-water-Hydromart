<?php

namespace App\Http\Controllers;

class ProductOverviewController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('privilege:Monitoring');
    }

    public function index()
    {

        $data['page_title'] = 'Product Overview';
        return view('product-overview.index', $data);
    }
    
    public function detail($product_id)
    {

        $data['page_title'] = 'Product Overview';


        
        $product = \App\Product::findOrFail($product_id);
        
        
        $data['product'] = $product;

        
        return view('product-overview.detail', $data);
    }
}
