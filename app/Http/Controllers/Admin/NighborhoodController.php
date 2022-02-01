<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nighborhood;
use App\Models\City;
use Brian2694\Toastr\Facades\Toastr;


class NighborhoodController extends Controller
{
    public function index($language)
    {
        $records = Nighborhood::orderBy('created_at')->get();
        return view('Admin.Nighborhood.index',compact('language','records'));
    }

    public function create($language)
    {
        $cities = City::all();

        $recordtoecreate = 0;
        return view('Admin.Nighborhood.create',compact('language','recordtoecreate','cities'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new Nighborhood();

        $recordtostore->name=$request->name;
        $recordtostore->city_id=$request->city_id;
       
        $recordtostore->save();
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.nighborhood.index',[$language]);
    }

    public function show($language,$id)
    {
        $record=Nighborhood::findOrFail($id);
        return view('Admin.Nighborhood.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $cities = City::all();

        $recordtoedit = Nighborhood::where('id',$id)->first();
        return view('Admin.Nighborhood.edit',compact('language','recordtoedit','cities'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=Nighborhood::where('id',$id)->first();

        $recordtoupdate->name=$request->name;
        $recordtoupdate->city_id=$request->city_id;

        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.nighborhood.index',[$language]);
    }

    public function destroy($language,$id)
    {
        Nighborhood::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.nighborhood.index',[$language]);

    }

    // public function updateStatus(Request $request)
    // {
    //     $record=Nighborhood::findOrFail($request->id);
    //     $record->status = $request->status;
    //     if($record->save()){
    //         return 1;
    //     }
    //     return 0;
    // }

}
