<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
class ClientController extends Controller
{
    public function index(){
    	return view('app.clients.index');
    }


	public function created_client(Request $request){
    	$client = new Client();
    	$client->code_rif = $request->code_rif;
    	$client->name_bussines = $request->name_bussines;
    	$client->name = $request->name;
    	$client->address = $request->address;
    	$client->email = $request->email;
    	$client->phone = $request->phone;
    	$client->tax = $request->tax;
    	$client->save();
    }

    public function update_client(Request $request){
    	$client = Client::find($request->id);
    	$client->code_rif = $request->code_rif;
    	$client->name_bussines = $request->name_bussines;
    	$client->name = $request->name;
    	$client->address = $request->address;
    	$client->email = $request->email;
    	$client->phone = $request->phone;
    	$client->tax = $request->tax;
    	$client->save();
    }

    public function get_all_clients(){
    	return response()->json(['clients' => Client::all()]);
    }

    public function delete_client($id){
    	Client::find($id)->delete();
    }
}
