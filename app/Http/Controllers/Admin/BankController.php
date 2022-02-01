<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bank;
use Brian2694\Toastr\Facades\Toastr;

class BankController extends Controller
{
    public function index($language)
    {
        $records = Bank::orderBy('created_at')->get();
        return view('Admin.Bank.index',compact('language','records'));
    }

    public function create($language)
    {
        $recordtoecreate = 0;
        return view('Admin.Bank.create',compact('language','recordtoecreate'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new Bank();

        $recordtostore->name=$request->name;
        $recordtostore->customer_name=$request->customer_name;
        $recordtostore->address=$request->address;
        $recordtostore->customer_number=$request->customer_number;
        $recordtostore->current_account_number=$request->current_account_number;
        $recordtostore->iban=$request->iban;
       
        $recordtostore->save();

        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.bank.index',[$language]);
    }

    public function show($language,$id)
    {
        $record=Bank::findOrFail($id);
        return view('Admin.Bank.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $recordtoedit = Bank::where('id',$id)->first();
        return view('Admin.Bank.edit',compact('language','recordtoedit'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=Bank::where('id',$id)->first();

        $recordtoupdate->name=$request->name;
        $recordtoupdate->customer_name=$request->customer_name;
        $recordtoupdate->address=$request->address;
        $recordtoupdate->customer_number=$request->customer_number;
        $recordtoupdate->current_account_number=$request->current_account_number;
        $recordtoupdate->iban=$request->iban;

        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.bank.index',[$language]);
    }

    public function destroy($language,$id)
    {
        Bank::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.bank.index',[$language]);
    }
}
