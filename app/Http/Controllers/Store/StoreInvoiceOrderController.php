<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceOrder;
use App\Models\Invoice;
use App\Models\Store;
use App\Models\Customer;
use Auth;

use Brian2694\Toastr\Facades\Toastr; 

class StoreInvoiceOrderController extends Controller
{
    public function index($language)
    {
        $records = InvoiceOrder::where('store_id', Auth::guard('store')->user()->id)->orderBy('created_at')->get();
        return view('Store.InvoiceOrder.index',compact('language','records'));
    }

    public function create($language)
    {
        $invoices = Invoice::all();
        $stores = Store::all();
        $customers = Customer::all();

        $recordtoecreate = 0;
        return view('Store.InvoiceOrder.create',compact('language','recordtoecreate','invoices','stores','customers'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new InvoiceOrder();

        $recordtostore->customer_phone=$request->customer_phone;
        $recordtostore->invoice_id=$request->invoice_id;
        $recordtostore->store_id=$request->store_id;
       
        $recordtostore->save();

        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('store.invoiceorder.index',[$language]);
    }

    public function show($language,$id)
    {
        $record=InvoiceOrder::findOrFail($id);
        return view('Store.InvoiceOrder.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $invoices = Invoice::all();
        $stores = Store::all();
        $customers = Customer::all();

        $recordtoedit = InvoiceOrder::where('id',$id)->first();
        return view('Store.InvoiceOrder.edit',compact('language','recordtoedit','invoices','stores','customers'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=InvoiceOrder::where('id',$id)->first();

        $recordtoupdate->customer_phone=$request->customer_phone;
        $recordtoupdate->invoice_id=$request->invoice_id;
        $recordtoupdate->store_id=$request->store_id;

        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('store.invoiceorder.index',[$language]);
    }

    public function destroy($language,$id)
    {
        InvoiceOrder::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('store.invoiceorder.index',[$language]);
    }


}
