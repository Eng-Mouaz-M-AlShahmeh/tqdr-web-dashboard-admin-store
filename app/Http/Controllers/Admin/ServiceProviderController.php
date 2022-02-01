<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceProvider;
use Brian2694\Toastr\Facades\Toastr;

class ServiceProviderController extends Controller
{
    public function index($language)
    {
        $records = ServiceProvider::orderBy('created_at')->get();
        return view('Admin.ServiceProvider.index',compact('language','records'));
    }

    public function create($language)
    {
        $recordtoecreate = 0;
        return view('Admin.ServiceProvider.create',compact('language','recordtoecreate'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new ServiceProvider();
        $recordtostore->username=$request->username;
        $recordtostore->first_name=$request->first_name;
        $recordtostore->last_name=$request->last_name;
        
        $recordtostore->storeName=$request->storeName;
        $recordtostore->nighborhood=$request->nighborhood;
        $recordtostore->locationURL=$request->locationURL;
        
        $recordtostore->phone=$request->phone;
        $recordtostore->email=$request->email;
        if(isset($request->tqdr_service_price)){
            $recordtostore->tqdr_service_price=$request->tqdr_service_price;
        } else {
            $recordtostore->tqdr_service_price=5.0;
        }
        if(isset($request->tqdr_service_vat_percentage)){
            $recordtostore->tqdr_service_vat_percentage=$request->tqdr_service_vat_percentage;
        } else {
            $recordtostore->tqdr_service_vat_percentage=15.0;
        }
        $recordtostore->profit_percentage=$request->profit_percentage;
        $recordtostore->profit_fixed_amount=$request->profit_fixed_amount;
        if(isset($request->avatar)){
            $recordtostore->avatar=$recordtostore->setImageAttribute($request->avatar);
        }
        if($recordtostore->password!=$request->password){
            $recordtostore->password=bcrypt($request->password);
        }
        $recordtostore->save();
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.serviceprovider.index',[$language]);
    }

    public function show($language,$id)
    {
        $record=ServiceProvider::findOrFail($id);
        return view('Admin.ServiceProvider.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $recordtoedit = ServiceProvider::where('id',$id)->first();
        return view('Admin.ServiceProvider.edit',compact('language','recordtoedit'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=ServiceProvider::where('id',$id)->first();
        $recordtoupdate->username=$request->username;
        $recordtoupdate->first_name=$request->first_name;
        $recordtoupdate->last_name=$request->last_name;
        
        $recordtoupdate->storeName=$request->storeName;
        $recordtoupdate->nighborhood=$request->nighborhood;
        $recordtoupdate->locationURL=$request->locationURL;
        
        $recordtoupdate->phone=$request->phone;
        $recordtoupdate->email=$request->email;
        if(isset($request->tqdr_service_price)){
            $recordtoupdate->tqdr_service_price=$request->tqdr_service_price;
        } else {
            $recordtoupdate->tqdr_service_price=5.0;
        }
        if(isset($request->tqdr_service_vat_percentage)){
            $recordtoupdate->tqdr_service_vat_percentage=$request->tqdr_service_vat_percentage;
        } else {
            $recordtoupdate->tqdr_service_vat_percentage=15.0;
        }
        $recordtoupdate->profit_percentage=$request->profit_percentage;
        $recordtoupdate->profit_fixed_amount=$request->profit_fixed_amount;
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
        return redirect()->route('admin.serviceprovider.index',[$language]);
    }

    public function destroy($language,$id)
    {
        ServiceProvider::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.serviceprovider.index',[$language]);

    }

    public function updateStatus($language,Request $request)
    {
        $record=ServiceProvider::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            return 1;
        }
        return 0;
    }
    
    public function updateActive($language,Request $request)
    {
        $record=ServiceProvider::findOrFail($request->id);
        $record->active = $request->active;
        if($record->save()){
            return 1;
        }
        return 0;
    }

}
