<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\National;
use Brian2694\Toastr\Facades\Toastr;

class NationalController extends Controller
{
    public function index($language)
    {
        $records = National::orderBy('created_at')->get();
        return view('Admin.National.index',compact('language','records'));
    }

    public function create($language)
    {
        $recordtoecreate = 0;
        return view('Admin.National.create',compact('language','recordtoecreate'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new National();

        $recordtostore->national_number=$request->national_number;
        if(isset($request->front_image)){
            $recordtostore->front_image=$request->front_image;
        }
        if(isset($request->back_image)){
            $recordtostore->back_image=$request->back_image;
        }
       
        $recordtostore->save();

        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.national.index',[$language]);
    }

    public function show($language,$id)
    {
        $record = National::findOrFail($id);
        return view('Admin.National.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $recordtoedit = National::where('id',$id)->first();
        return view('Admin.National.edit',compact('language','recordtoedit'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate = National::where('id',$id)->first();

        $recordtoupdate->national_number=$request->national_number;
        if(isset($request->front_image)){
            $recordtoupdate->front_image=$request->front_image;
        }
        if(isset($request->back_image)){
            $recordtoupdate->back_image=$request->back_image;
        }

        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.national.index',[$language]);
    }

    public function destroy($language,$id)
    {
        National::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.national.index',[$language]);
    }
}
