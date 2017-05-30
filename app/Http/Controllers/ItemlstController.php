<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\itemlst;

class ItemlstController extends Controller
{
    public function store()
    {
    	//Form Validation
    	$this->validate(request(),[
    		'iname' => 'required',
    		'itname' => 'required',
    		'qty' => 'required',
    		'price' => 'required',
    		'subtotal' => 'required',
    		'tax' => 'required',
    		'total' => 'required',
    		
    		]);


    	
    	$item =new itemlst;
    	$item->invoiceid= "1";
    	$item->iname= request('iname');
    	$item->itname= request('itname');
    	$item->qty= request('qty');
    	$item->price= request('price');
    	$item->total= request('total');

    	
    	$item->save();

    	return redirect('/');
    }
}
