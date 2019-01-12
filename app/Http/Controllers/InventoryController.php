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

        $prod_inv = Inventory::with('product')->find($request->idProd);

		if ($prod_inv->product['medida'] == 'Unidades') { $prod_inv->quantity = $request->quantity; }
        else { $prod_inv->Kg_L = $request->Kg_L; }

        $prod_inv->stock_min = $request->stock_min;

        $prod_inv->save();

        return response()->json(['allInventory'=>Inventory::with('product')->orderBy('id','ASC')->get()]);
    }

    public function AddToProd(Request $request){
        $prod_inv = Inventory::where('product_id',$request->inventory[0]['id'])->first();
        if ($request->inventory[0]['medida'] == 'Unidades') { $prod_inv->quantity = $prod_inv->quantity + $request->inventory[0]['quantity']; }
        else { $prod_inv->Kg_L = $prod_inv->Kg_L + $request->inventory[0]['Kg_L']; }
        $prod_inv->save();

        for ($i=1; $i < count($request->inventory); $i++) { 
            $prod_inv = Inventory::where('product_id',$request->inventory[$i]['id'])->first();
            if ($request->inventory[$i]['medida'] == 'Unidades') { $prod_inv->quantity = $prod_inv->quantity - $request->inventory[$i]['quantity']; }
            else { $prod_inv->Kg_L = $prod_inv->Kg_L - $request->inventory[$i]['Kg_L']; }
            $prod_inv->save();
        }

        return response()->json(['inventory'=>Inventory::with('product.mix.product')->orderBy('id','ASC')->get(),
                                 'categories'=>Category::all()]);
    }

    public function get_all_products(){
        return response()->json(['products' => Inventory::with('product')->orderBy('id','ASC')->get()]);
    }
}
