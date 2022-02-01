<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceProvider;
use App\Models\Invoice;
use Brian2694\Toastr\Facades\Toastr;
use \Mpdf\Mpdf as PDF; 
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceController extends Controller
{
    public function index($language)
    {
        $records = Invoice::orderBy('created_at')->get();
        return view('Admin.Invoice.index',compact('language','records'));
    }

    public function create($language)
    {
        $serviceProviders = ServiceProvider::all();
        
        $recordtoecreate = 0;
        return view('Admin.Invoice.create',compact('language','recordtoecreate','serviceProviders'));
    }

    public function store($language,Request $request)
    {
        $recordtostore = new Invoice();

        if(isset($request->amount)){
            if($request->amount > 5000){
                \Brian2694\Toastr\Facades\Toastr::error('لا يمكن أن يكون مبلغ الإيصال أكبر من 5000 ريال للعملية الواحدة!','',["positionClass" => "toast-top-right"]);
                return  redirect()->back();
            }
            $recordtostore->amount=$request->amount-5;
        }
        $recordtostore->remaining_amount=$request->amount-5;
        $recordtostore->is_paid=$request->is_paid;
        $recordtostore->service_provider_id=$request->service_provider_id;
       
        $recordtostore->save();

        \Brian2694\Toastr\Facades\Toastr::success('لقد تم حفظ المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.invoice.index',[$language]);
    }

    public function show($language,$id)
    {
        $record = Invoice::findOrFail($id);
        return view('Admin.Invoice.show',compact('language','record'));
    }

    public function edit($language,$id)
    {
        $serviceProviders = ServiceProvider::all();

        $recordtoedit = Invoice::where('id',$id)->first();
        return view('Admin.Invoice.edit',compact('language','recordtoedit','serviceProviders'));
    }

    public function update($language,Request $request, $id)
    {
        $recordtoupdate = Invoice::where('id',$id)->first();

        if(isset($request->amount)){
            if($request->amount > 5000){
                \Brian2694\Toastr\Facades\Toastr::error('لا يمكن أن يكون مبلغ الإيصال أكبر من 5000 ريال للعملية الواحدة!','',["positionClass" => "toast-top-right"]);
                return  redirect()->back();
            }
            $recordtoupdate->amount=$request->amount-5;
        }
        $recordtoupdate->remaining_amount=$request->remaining_amount;
        $recordtoupdate->is_paid=$request->is_paid;
        $recordtoupdate->service_provider_id=$request->service_provider_id;

        $recordtoupdate->save();
        
        \Brian2694\Toastr\Facades\Toastr::success('لقد تم تعديل المستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.invoice.index',[$language]);
    }

    public function destroy($language,$id)
    {
        Invoice::where('id',$id)->delete();
        \Brian2694\Toastr\Facades\Toastr::error('تم حذف مستند بنجاح!','',["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.invoice.index',[$language]);
    }

    public function updateStatus($language,Request $request)
    {
        $record=Invoice::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            return 1;
        }
        return 0;
    }

    public function downloadPDF($language,$id)
    {
        $invoice = Invoice::where('id',$id)->first();
        $imageQrName=time().'.svg';
        $imageQr = QrCode::format('svg')
                 ->size(200)
                 ->encoding("UTF-8")
                 ->generate("المبلغ: $invoice->amount - رقم الإيصال: $invoice->id" , ''.public_path('uploads/qr/'.$imageQrName.'').'');

        $mpdf = new PDF();

        $mpdf->allow_charset_conversion=true;
        $mpdf->charset_in='UTF-8';
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont   = true;

        $mpdf->SetHeader('نظام تقدر -  أول منصة رقمية سعودية تعود ملكيتها لمؤسسة تقدر للوساطة التجارية - سجل تجاري رقم 10108581937 ');

        $mpdf->WriteHtml('
        <br/>
        <h3 style="text-align: center;"> نظام تقدر للوساطة التجارية </h3> 
        <br/><br/>
        <h1 style="text-align: center;"> إيصال فاتورة </h1> 
        <br/><br/>
        <h2 style="text-align: center;"> رقم الإيصال: '.$invoice->id.' </h2>
        <h2 style="text-align: center;"> مبلغ الإيصال: '.$invoice->amount.' ريال سعودي</h2>
        <br/>
        <div style="text-align: center;">
            <img src="'.public_path('uploads/qr/'.$imageQrName.'').'"/>
        </div>
        ');

        $mpdf->SetFooter('تطوير: شركة الرائدة الكبرى لتقنية نظم المعلومات');

        $mpdf->Output('tqdr-invoice.pdf', 'D');
    }

}
