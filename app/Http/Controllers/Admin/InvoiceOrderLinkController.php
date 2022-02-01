<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceOrderLink;
use App\Models\Invoice;
use App\Models\Store;
use App\Models\Customer;
use Auth;

use Brian2694\Toastr\Facades\Toastr; 

class InvoiceOrderLinkController extends Controller
{
    public function index($language)
    {
        $records = InvoiceOrderLink::orderBy('created_at')->get();
        return view('Admin.InvoiceOrderLink.index',compact('language','records'));
    }

    public function create($language)
    {
        $stores = Store::all();
        // $customers = Customer::all();  ,'stores','customers'

        $recordtoecreate = 0;
        return view('Admin.InvoiceOrderLink.create',compact('language','recordtoecreate','stores'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new InvoiceOrderLink();

        $recordtostore->customer_name=$request->customer_name;
        $recordtostore->customer_phone=$request->customer_phone;
        $recordtostore->store_id = $request->store_id;
        $recordtostore->amount=$request->amount;
       
        $recordtostore->save();
        
        $recordtoupdate=InvoiceOrderLink::where('id',InvoiceOrderLink::latest()->first()->id)->first();
         
        $recordtoupdate->link='https://tqdr.com.sa/'.$language.'/front/storepaylink/'.InvoiceOrderLink::latest()->first()->id;
        
        $recordtoupdate->save();
         

        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.invoiceorderlink.index',[$language]);
    }

    public function show($language,$id)
    {
        $record=InvoiceOrderLink::findOrFail($id);
        return view('Admin.InvoiceOrderLink.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $stores = Store::all();
        // $customers = Customer::all();    ,'stores','customers'

        $recordtoedit = InvoiceOrderLink::where('id',$id)->first();
        return view('Admin.InvoiceOrderLink.edit',compact('language','recordtoedit','stores'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=InvoiceOrderLink::where('id',$id)->first();

        $recordtoupdate->customer_name=$request->customer_name;
        $recordtoupdate->customer_phone=$request->customer_phone;
        $recordtoupdate->store_id = $request->store_id;
        $recordtoupdate->amount=$request->amount;
        $recordtoupdate->link='https://tqdr.com.sa/'.$language.'/front/storepaylink/'.$id;
       
        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.invoiceorderlink.index',[$language]);
    }

    public function destroy($language,$id)
    {
        InvoiceOrderLink::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.invoiceorderlink.index',[$language]);
    }
    
    public function updateStatus($language,Request $request)
    {
        $record=InvoiceOrderLink::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            return 1;
        }
        return 0;
    }


}
