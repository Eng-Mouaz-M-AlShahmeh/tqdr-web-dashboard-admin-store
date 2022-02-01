<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Country;
use Brian2694\Toastr\Facades\Toastr;

class CityController extends Controller
{
    public function index($language)
    {
        $records = City::orderBy('created_at')->get();
        return view('Admin.City.index',compact('language','records'));
    }

    public function create($language)
    {
        $countries = Country::all();

        $recordtoecreate = 0;
        return view('Admin.City.create',compact('language','recordtoecreate','countries'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new City();

        $recordtostore->name=$request->name;
        $recordtostore->country_id=$request->country_id;
       
        $recordtostore->save();
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.city.index',[$language]);
    }

    public function show($language,$id)
    {
        $record=City::findOrFail($id);
        return view('Admin.City.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $countries = Country::all();

        $recordtoedit = City::where('id',$id)->first();
        return view('Admin.City.edit',compact('language','recordtoedit','countries'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate=City::where('id',$id)->first();

        $recordtoupdate->name=$request->name;
        $recordtoupdate->country_id=$request->country_id;

        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.city.index',[$language]);
    }

    public function destroy($language,$id)
    {
        City::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.city.index',[$language]);

    }

}
