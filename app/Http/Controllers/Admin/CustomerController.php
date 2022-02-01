<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;

class CustomerController extends Controller
{

    public function index($language)
    {
        $records = Customer::orderBy('created_at')->get();
        return view('Admin.Customer.index',compact('language','records'));
    }

    public function create($language)
    {
        $recordtoecreate = 0;
        return view('Admin.Customer.create',compact('language','recordtoecreate'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new Customer();
        $recordtostore->username=$request->username;
        $recordtostore->first_name=$request->first_name;
        $recordtostore->last_name=$request->last_name;
        $recordtostore->phone=$request->phone;
        $recordtostore->email=$request->email;
        if(isset($request->avatar)){
            $recordtostore->avatar=$request->avatar;
        }
        if($recordtostore->password!=$request->password){
            $recordtostore->password=bcrypt($request->password);
        }
        $recordtostore->save();
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.customer.index',[$language]);
    }

    public function show($language,$id)
    {
        $record=Customer::findOrFail($id);
        return view('Admin.Customer.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $recordtoedit = Customer::where('id',$id)->first();
        return view('Admin.Customer.edit',compact('language','recordtoedit'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=Customer::where('id',$id)->first();
        $recordtoupdate->username=$request->username;
        $recordtoupdate->first_name=$request->first_name;
        $recordtoupdate->last_name=$request->last_name;
        $recordtoupdate->phone=$request->phone;
        $recordtoupdate->email=$request->email;
        if(isset($request->avatar)){
            $recordtoupdate->avatar=$recordtoupdate->setImageAttribute($request->avatar);
        }
        if(isset($request->password)){
            if($recordtoupdate->password!=$request->password){
            $recordtoupdate->password=bcrypt($request->password);
        }
        }
        $recordtoupdate->save();
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.customer.index',[$language]);
    }

    public function destroy($language,$id)
    {
        Customer::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.customer.index',[$language]);

    }
}
