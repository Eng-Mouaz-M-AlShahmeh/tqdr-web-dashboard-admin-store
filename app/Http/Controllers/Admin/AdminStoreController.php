<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use App\Models\Bank;
use App\Models\SocialLinks;
use App\Models\CommercialRegister;
use App\Models\National;
use Brian2694\Toastr\Facades\Toastr;


class AdminStoreController extends Controller
{
    public function index($language)
    {
        $records = Store::orderBy('created_at')->get();
        return view('Admin.Store.index',compact('language','records'));
    }

    public function create($language)
    {
        $banks = Bank::all();
        $socialLinks = SocialLinks::all();
        $crs = CommercialRegister::all();
        $nationals = National::all();
        
        $recordtoecreate = 0;
        return view('Admin.Store.create',compact('language','recordtoecreate','banks','socialLinks','crs','nationals'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new Store();

        $recordtostore->username=$request->username;
        $recordtostore->phone=$request->phone;
        $recordtostore->email=$request->email;
        $recordtostore->store_name=$request->store_name;
        $recordtostore->web_url=$request->web_url;
        $recordtostore->description=$request->description;
        $recordtostore->bank_id=$request->bank_id;
        $recordtostore->social_links_id=$request->social_links_id;
        $recordtostore->cr_id=$request->cr_id;
        $recordtostore->national_id=$request->national_id;
        if($recordtostore->password!=$request->password){
            $recordtostore->password=bcrypt($request->password);
        }
        if(isset($request->logo)){
            $recordtostore->logo=$request->logo;
        }
        if(isset($request->cover_image)){
            $recordtostore->cover_image=$recordtostore->setCoverAttribute($request->cover_image);
        }
       
        $recordtostore->save();

        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.store.index',[$language]);
    }

    public function show($language,$id)
    {
        $record = Store::findOrFail($id);
        return view('Admin.Store.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $banks = Bank::all();
        $socialLinks = SocialLinks::all();
        $crs = CommercialRegister::all();
        $nationals = National::all();

        $recordtoedit = Store::where('id',$id)->first();
        return view('Admin.Store.edit',compact('language','recordtoedit','banks','socialLinks','crs','nationals'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate = Store::where('id',$id)->first();

        $recordtoupdate->username=$request->username;
        $recordtoupdate->phone=$request->phone;
        $recordtoupdate->email=$request->email;
        $recordtoupdate->store_name=$request->store_name;
        $recordtoupdate->web_url=$request->web_url;
        $recordtoupdate->description=$request->description;
        $recordtoupdate->bank_id=$request->bank_id;
        $recordtoupdate->social_links_id=$request->social_links_id;
        $recordtoupdate->cr_id=$request->cr_id;
        $recordtoupdate->national_id=$request->national_id;
        if(isset($request->password)){
            if($recordtoupdate->password!=$request->password){
            $recordtoupdate->password=bcrypt($request->password);
            }
        }
        if(isset($request->logo)){
            $recordtoupdate->logo=$request->logo;
        }
        if(isset($request->cover_image)){
            $recordtoupdate->cover_image=$recordtoupdate->setCoverAttribute($request->cover_image);
        }

        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.store.index',[$language]);
    }

    public function destroy($language,$id)
    {
        Store::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.store.index',[$language]);
    }

    public function updateStatus($language,Request $request)
    {
        $record=Store::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            return 1;
        }
        return 0;
    }
}
