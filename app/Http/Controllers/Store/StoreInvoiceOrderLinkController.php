<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceOrderLink;
use App\Models\Invoice;
use App\Models\Store;
use App\Models\Customer;
use Auth;

use Brian2694\Toastr\Facades\Toastr; 

class StoreInvoiceOrderLinkController extends Controller
{
    public function index($language)
    {
        $records = InvoiceOrderLink::where('store_id', Auth::guard('store')->user()->id)->orderBy('created_at')->get();
        return view('Store.InvoiceOrderLink.index',compact('language','records'));
    }

    public function create($language)
    {
        // $stores = Store::all();
        // $customers = Customer::all();  ,'stores','customers'

        $recordtoecreate = 0;
        return view('Store.InvoiceOrderLink.create',compact('language','recordtoecreate'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new InvoiceOrderLink();

        $recordtostore->customer_name=$request->customer_name;
        $recordtostore->customer_phone=$request->customer_phone;
        $recordtostore->store_id = Store::where('id', Auth::id())->first()->id;
        $recordtostore->amount=$request->amount;
       
        $recordtostore->save();
        
        
        $recordtoupdate=InvoiceOrderLink::where('id',InvoiceOrderLink::latest()->first()->id)->first();
         
        $recordtoupdate->link='https://tqdr.com.sa/'.$language.'/front/storepaylink/'.InvoiceOrderLink::latest()->first()->id;
        
        $recordtoupdate->save();
         

        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('store.invoiceorderlink.show',[$language, $recordtostore->id]);
    }

    public function show($language,$id)
    {
        $record=InvoiceOrderLink::findOrFail($id);
        return view('Store.InvoiceOrderLink.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        // $stores = Store::all();
        // $customers = Customer::all();    ,'stores','customers'

        $recordtoedit = InvoiceOrderLink::where('id',$id)->first();
        return view('Store.InvoiceOrderLink.edit',compact('language','recordtoedit'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=InvoiceOrderLink::where('id',$id)->first();

        $recordtoupdate->customer_name=$request->customer_name;
        $recordtoupdate->customer_phone=$request->customer_phone;
        $recordtoupdate->store_id = Store::where('id', Auth::id())->first()->id;
        $recordtoupdate->amount=$request->amount;
        $recordtoupdate->link='https://tqdr.com.sa/'.$language.'/front/storepaylink/'.$id;
       
        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('store.invoiceorderlink.index',[$language]);
    }

    public function destroy($language,$id)
    {
        InvoiceOrderLink::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('store.invoiceorderlink.index',[$language]);
    }
    
    public function updateStatus($language, Request $request)
    {
        $record=InvoiceOrderLink::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            return 1;
        }
        return 0;
    }
    
    public function sendLinkSms($language, Request $request)
    {
        
        // customer sms
        $infos="";
        $xml="";
        $Numbers = $request->phone;
        $Message = $request->msg;
        
        $url = "https://mobile.net.sa/sms/gw/";
        if(!$url || $url=="") {
            return "No URL";
        } else {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt ($ch, CURLOPT_HEADER, false);
            curl_setopt ($ch, CURLOPT_POST, true);
            $dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $Numbers, 'msg' => $Message, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);  
            // curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
            $FainalResult = curl_exec ($ch);
            curl_close ($ch);   
            // return $FainalResult;
        }
        // end customer sms
        // ................................
            
        \Brian2694\Toastr\Facades\Toastr::success('تم إرسال الرابط للعميل كرسالة SMS بنجاح!','',["positionClass" => "toast-top-right"]);
            
        return redirect()->back();
            
    }



}
