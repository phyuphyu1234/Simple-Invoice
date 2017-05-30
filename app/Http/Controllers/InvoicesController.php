<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\itemlst;

class InvoicesController extends Controller
{
     public function index()
    {
    	$invoice =Invoice::all();

   		return view('index',compact('invoice'));
    }
    public function search()
    {

      
       $invoice=Invoice::where('invoice', 'like', '%' . request('findin') . '%')
                  ->get();
       if($invoice){
      return view('index',compact('invoice'));
    }

    return back();
    }
     public function create()
    {
    	
   		return view('new');
    }
    public function store(Request $request)
    {
    	//Form Validation
    	$this->validate(request(),[
    		'iname' => 'required',
    		'itname.*' => 'required',
    		'qty.*' => 'required',
    		'price.*' => 'required',
    		'subtotal' => 'required',
    		'tax' => 'required',
    		'total' => 'required',
    		
    		]);


    	Invoice::create([
    		'invoice' => request('iname'),
    		'items' => request('qtytotal'),
            'subtotal' => request('subtotal'),
            'tax' => request('tax'),
    		'alltotal' => request('alltotal')
    		]);

      $invoice=Invoice::where('invoice', '=', request('iname'))->latest()->first();
      $leg=$request->get('itname');
    
      for($i=0;$i<count($leg);$i++){
          
        $item[$i]['invoice_id']= $invoice->id;
        $item[$i]['iname']= request('iname');
        $item[$i]['itname']= $request->get('itname')[$i];
        $item[$i]['qty']= $request->get('qty')[$i];
        $item[$i]['price']= $request->get('price')[$i];
        $item[$i]['total']= $request->get('total')[$i];
       
    }
             itemlst::insert($item);

    	return redirect('/');
    }
    public function update($id)
    {
    
        $invoice = Invoice::find($id);
       $itemlsts = Invoice::find($id)->itemlsts;
 
        return view('update1', compact('invoice','itemlsts'));
        
    
    }
    public function restore(Request $request, $id)
    {
         $invoice = Invoice::find($id);
       $itemlsts = Invoice::find($id)->itemlsts;
    

        $invoice->invoice= request('iname');
        $invoice->items= request('qtytotal');
        $invoice->subtotal= request('subtotal');
        $invoice->tax= request('tax');
        $invoice->alltotal= request('alltotal');
        $invoice->save();
        // dd(count($itemlsts));
          $leg=$request->get('itname');
          if($itemlsts!="[]"){
          for($j=0;$j<count($itemlsts);$j++){
            $ITid[]=$itemlsts[$j]->id;
          }
          
           $ITids = json_encode($ITid);
         itemlst::destroy ($ITid);
     }
          
       for($i=0;$i<count($leg);$i++){
          
        $item[$i]['invoice_id']= $id;
        $item[$i]['iname']= request('iname');
        $item[$i]['itname']= $request->get('itname')[$i];
        $item[$i]['qty']= $request->get('qty')[$i];
        $item[$i]['price']= $request->get('price')[$i];
        $item[$i]['total']= $request->get('total')[$i];
       
    }
             itemlst::insert($item);

        return redirect('/');
    }
      public function remove($id)
      {
        Invoice::where('id',$id)->delete();
         itemlst::where('invoice_id',$id)->delete();

        // $itemlsts = Invoice::find($id)->itemlsts;
        // Invoice::destroy($id);
        // if($itemlsts!="[]"){
        //   for($j=0;$j<count($itemlsts);$j++){
        //     $ITid[]=$itemlsts[$j]->id;
        //   }
          
        //    $ITids = json_encode($ITid);
        //  itemlst::destroy ($ITid);
     
        return redirect('/');
      }
      public function pdfexp($id){

         $invoice = Invoice::find($id);
        $itemlsts = Invoice::find($id)->itemlsts;

        view()->share('invoice',$invoice);
        $pdf=\PDF::loadview('pdfex');
        return $pdf->download('pdfexp.pdf');
        
      }

}
