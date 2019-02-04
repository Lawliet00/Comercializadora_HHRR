<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;
use App\Inventory;

class ProductController extends Controller
{

    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('app.products.index')
                ->with('products',$products)
                ->with('categories',$categories);
    }

    public function created_product(Request $request){
    	$product = new Product();
        $product->category_id = $request->category_id;
    	$product->name = $request->name;
    	$product->peso_unit = $request->peso_unit;
    	$product->price = $request->price;
    	$product->quantity_for_box = $request->qty_for_box;
        $product->medida = $request->medida;
    	$product->save();

        $product_inv = new Inventory();
        $product_inv->product_id = $product->id;
        $product_inv->stock_min = 100;
        // $product_inv->type_stock_min = ($product->medida != 'Unidades') ? 'Kg_L' : 'qty' ;
        $product_inv->Kg_L = 0.00;
        $product_inv->quantity = 0;

        $product_inv->save();
    }

    public function update_product(Request $request){
    	$product = Product::find($request->id);
        $product->category_id = $request->category_id;
    	$product->name = $request->name;
    	$product->peso_unit = $request->peso_unit;
    	$product->price = $request->price;
    	$product->quantity_for_box = $request->qty_for_box;


        $change = ($request->medida != 'Unidades') ? false : true;
        $product->medida = $request->medida;
    	$product->save();

        $pro_inv = Inventory::where('product_id',$product->id)->first();
        // $pro_inv->type_stock_min = ($product->medida != 'Unidades') ? 'Kg_L' : 'qty';

        if ($product->medida != 'Unidades') { $product_inv->Kg_L = 0.00; }
        else { $product_inv->quantity = 0; }

        $product_inv->save();
    }

    public function get_all_products(){
    	return response()->json(['products' => Product::all()]);
    }

    public function deleteProduct($id){
    	Product::find($id)->delete();
    }
}
