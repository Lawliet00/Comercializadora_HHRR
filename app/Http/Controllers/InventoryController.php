<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Inventory;

class InventoryController extends Controller
{
    public function index(){
        $inventory = Inventory::with('product.mix.product')->orderBy('id','ASC')->get();
        $categories = Category::all();
        return view('app.products.inventory')
                ->with('inventory',$inventory)
                ->with('categories',$categories);
    }

    public function update(Request $request){

        $pro_inv = Inventory::with('product')->find($request->idProd);

		if ($pro_inv->product['medida'] == 'Unidades') { $pro_inv->quantity = $request->quantity; }
        else { $pro_inv->Kg_L = $request->Kg_L; }

        $pro_inv->stock_min = $request->stock_min;

        $pro_inv->save();

        return response()->json(['allInventory'=>Inventory::with('product')->orderBy('id','ASC')->get()]);
    }

    public function get_all_products(){
        return response()->json(['products' => Inventory::with('product')->orderBy('id','ASC')->get()]);
    }
}
