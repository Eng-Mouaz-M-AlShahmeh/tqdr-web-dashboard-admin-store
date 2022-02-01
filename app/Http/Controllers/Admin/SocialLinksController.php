<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\SocialLinks;
use Brian2694\Toastr\Facades\Toastr;

class SocialLinksController extends Controller
{
    public function index($language)
    {
        $records = SocialLinks::orderBy('created_at')->get();
        return view('Admin.SocialLinks.index',compact('language','records'));
    }

    public function create($language)
    {
        $recordtoecreate = 0;
        return view('Admin.SocialLinks.create',compact('language','recordtoecreate'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new SocialLinks();

        $recordtostore->facebook=$request->facebook;
        $recordtostore->twitter=$request->twitter;
        $recordtostore->instagram=$request->instagram;
        $recordtostore->linkedin=$request->linkedin;
        $recordtostore->youtube=$request->youtube;
       
        $recordtostore->save();

        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.sociallinks.index',[$language]);
    }

    public function show($language,$id)
    {
        $record=SocialLinks::findOrFail($id);
        return view('Admin.SocialLinks.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $recordtoedit = SocialLinks::where('id',$id)->first();
        return view('Admin.SocialLinks.edit',compact('language','recordtoedit'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=SocialLinks::where('id',$id)->first();

        $recordtoupdate->facebook=$request->facebook;
        $recordtoupdate->twitter=$request->twitter;
        $recordtoupdate->instagram=$request->instagram;
        $recordtoupdate->linkedin=$request->linkedin;
        $recordtoupdate->youtube=$request->youtube;

        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.sociallinks.index',[$language]);
    }

    public function destroy($language,$id)
    {
        SocialLinks::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.sociallinks.index',[$language]);
    }
}
