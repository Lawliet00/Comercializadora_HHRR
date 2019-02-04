<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Inventory;
use App\Client;

class OrderController extends Controller
{
    public function indexInvoices(){
        $products = Product::with('inventory')->where('category_id',3)->orderBy('id','ASC')->get();
        $clients = Client::all();
        return view('app.orders.index')
                ->with('products',$products)
                ->with('clients',$clients);
    }

    public function RemoveInInventory(Request $request){


    	for ($i=0; $i < count($request->info); $i++) { 
    		$inv_prod = Inventory::with('product')->find($request->info[$i]['idInventory']);
    		$inv_prod->quantity = $inv_prod->quantity - ($inv_prod->product['quantity_for_box'] * $request->info[$i]['qtyBox']) - $request->info[$i]['qtyUnit'];

    		$inv_prod->save();
    	}
    }
}

