<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Session;
use App\Models\InvoiceOrder;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Store;
use App\Models\InvoiceOrderLink;
use App\Models\ServiceProvider;
use Mail;
use Config;

class FrontController extends Controller 
{
    

    
    // public function index($language) {
    //     return view('Front.index',compact('language'));
    // }
    
    function serviceproviderssearch($language, Request $request) {
        if(!empty(ServiceProvider::where('phone', '=', $request->key)
        ->orwhere('nighborhood', 'like', '%' . $request->key . '%')
        ->orwhere('storeName', 'like', '%' . $request->key . '%')
        ->first())
        
        ) {
            
             $key = $request->key;
             
             $serviceprovider = ServiceProvider::where('phone', '=', $request->key)
        ->orwhere('nighborhood', 'like', '%' . $request->key . '%')
        ->orwhere('storeName', 'like', '%' . $request->key . '%')->orderby('id', 'desc')->get();
       
        return view('Front.serviceproviderssearch',compact('language','serviceprovider', 'key'));
        } else {
            
            $key = $request->key;
            
             $serviceprovider = new ServiceProvider();
       
        return view('Front.serviceproviderssearch',compact('language','serviceprovider', 'key'));
        
            //  \Brian2694\Toastr\Facades\Toastr::error( 'عذراً لا يوجد نتائج','',["positionClass" => "toast-top-right"] );
            // return redirect()->back();
            
            //return view('Front.storepaylinkfail',compact('language'));
        }
    }
    
      function storepaylink($language,$id)
    {
        if(!empty(InvoiceOrderLink::where('id',$id)->first()->store )) {
             $store = InvoiceOrderLink::where('id',$id)->first()->store;
        $customer_phone = InvoiceOrderLink::where('id',$id)->first()->customer_phone;
        $amount = InvoiceOrderLink::where('id',$id)->first()->amount;
        
        // $invoiceorder = InvoiceOrder::where('id',$id)->first();
        return view('Front.storepaylink',compact('language','store','customer_phone','amount'));
        } else {
            return view('Front.storepaylinkfail',compact('language'));
        }
       
    }
    
    
    
    // public function balanceInquiry($language,Request $request)
    // {
    //     if($request->invoiceId === null) {
    //         Session::forget('amount');
    //         $amountval = 'رقم الإيصال مطلوب!';
    //         Session::put('amount', $amountval);
    //         return redirect()->back();
    //     }
    //     $invoiceRem = Invoice::where('id',$request->invoiceId)->first()->remaining_amount;
    //     Session::forget('amount');
    //     $amountval = 'المبلغ المتبقي في الإيصال رقم '.$request->invoiceId.' هو '.$invoiceRem. ' ريال ';
    //     Session::put('amount', $amountval);
    //     return redirect()->back();
    // }

    public function pay($language,Request $request)
    {
        // $this->validate($request, [
        //     'phone'         => 'required',
        //     'amount'        => 'required',
        //     'store'         => 'required',
        //     'order_number'  => 'required',
        // ]);

        // dd($request->store);
        
        

        if($request->phone === null) {
            Session::forget('errorpay');
            $errorpayval = 'رقم الجوال مطلوب!';
            Session::put('errorpay', $errorpayval);
            return redirect()->back();
        }

        if($request->amount === null) {
            Session::forget('errorpay');
            $errorpayval = 'المبلغ مطلوب!';
            Session::put('errorpay', $errorpayval);
            return redirect()->back();
        }

        if($request->store === null) {
            Session::forget('errorpay');
            $errorpayval = 'اختيار الشريك (المتجر) مطلوب!';
            Session::put('errorpay', $errorpayval);
            return redirect()->back();
        }

        if($request->order_number === null) {
            Session::forget('errorpay');
            $errorpayval = 'رقم الإيصال مطلوب!';
            Session::put('errorpay', $errorpayval);
            return redirect()->back();
        }

        if($request->amount > 5000) {
            Session::forget('errorpay');
            $errorpayval = 'عذراً مبلغ الطلب لا يمكن أن يكون أكثر من 5000 ريال للعملية الواحدة';
            Session::put('errorpay', $errorpayval);
            // \Brian2694\Toastr\Facades\Toastr::error( 'عذراً مبلغ الطلب لا يمكن أن يكون أكثر من 500 ريال للعملية الواحدة!','',["positionClass" => "toast-top-right"] );
            return redirect()->back();
        }

        foreach(\App\Models\Invoice::all() as $invoice) {
            if($invoice->id == $request->order_number) {
                if($invoice->is_paid == 1) {
                    Session::forget('errorpay');
                    $errorpayval = 'عذراً لم يعد هذا الإيصال صالح لإجراء العملية';
                    Session::put('errorpay', $errorpayval);
                    // \Brian2694\Toastr\Facades\Toastr::error( 'عذراً لم يعد هذا الإيصال صالح لإجراء العملية!','',["positionClass" => "toast-top-right"] );
                    return redirect()->back();
                } else { 
                    if($request->amount > $invoice->amount && $request->amount > $invoice->remaining_amount) {
                        Session::forget('errorpay');
                        $errorpayval = 'عذراً المبلغ الموجود في الإيصال غير كافٍ لعملية الدفع!';
                        Session::put('errorpay', $errorpayval);
                        return redirect()->back();
                        
                        
                        
                        
                        //       ..........................
                        
                        //       ..........................
                        
                        //       تطوير الدفع باكثر من ايصال
                        
                        //       ..........................
                        
                        //      ...........................
                        
                        
                        
                        
                    } else if($invoice->remaining_amount > 0 && $request->amount <= $invoice->remaining_amount) {
                        // update remaining_amount
                        $recordtoupdate=Invoice::where('id',$invoice->id)->first();
                        if($recordtoupdate->remaining_amount - $request->amount == 0) {
                            $recordtoupdate->is_paid = 1;
                            $recordtoupdate->status = 0;
                        }
                        $recordtoupdate->remaining_amount=$recordtoupdate->remaining_amount - $request->amount;
                        $recordtoupdate->save();
                        // update remaining_amount end
                        // save customer phone
                        if(Customer::where('phone', $request->phone)->exists() === false) {
                            $recordtostore1 = new Customer();
                            $recordtostore1->phone=$request->phone;
                            $recordtostore1->save();
                        }
                        // save customer phone end
                        // save invoice order
                        $recordtostore = new InvoiceOrder();
                        $recordtostore->amount=$request->amount;   
                        $recordtostore->customer_phone=$request->phone;
                        $recordtostore->store_id=$request->store;
                        $recordtostore->invoice_id=$request->order_number;
                        $recordtostore->save();
                        // save invoice order end
                        Session::forget('errorpay');
                        
                        
                        // إرسال إيميلات ورسائل جوال
                        // send sms to customer
                        // function SendSms($UserName,$UserPassword,$Numbers,$Originator,$Message,$infos="",$xml=""){
                        
                        $infos="";
                        $xml="";
                        if(!preg_match('/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/', $request->phone)) {
                            Session::forget('errorpay');
                            $errorpayval = 'يجب أن يكون رقم الجوال سعودي!';
                            Session::put('errorpay', $errorpayval);
                            return redirect()->back();
                            
                        }
                        
                        // $Numbers = str_replace("05","966",$request->phone);
                        
                        
                        
                        
                        
                        
                        $Numbers = $request->phone;
                        
                         $NameStore = \App\Models\Store::where('id', $request->store)->first()->store_name;
                         
                        
                        if(Config::get('app.locale') == 'en') {
                            $Message = 'Dear customer your order number '.$request->order_number.' completed with an amount of '.$request->amount.' SAR to '.$NameStore;
                        } else {
                            $Message = 'عزيزنا العميل لقد تم تنفيذ طلبك رقم '.$request->order_number.' بمبلغ'.$request->amount.' ريال إلى '.$NameStore;
                        }
                        
                        
                        
                        // YesRepeat=1
    $url = "https://mobile.net.sa/sms/gw/";
	if(!$url || $url==""){
		return "No URL";
	}else{
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_HEADER, false);
		curl_setopt ($ch, CURLOPT_POST, true);
		$dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $Numbers, 'msg' => $Message, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);  
// 		curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
		$FainalResult = curl_exec ($ch);
		curl_close ($ch);   
// 		return $FainalResult;
	}
// }




                        
                        // send sms to customer end
                        
                        // send sms to store
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                         $NumbersStore = \App\Models\Store::where('id', $request->store)->first()->phone;
                         
                         $NameStore = \App\Models\Store::where('id', $request->store)->first()->store_name;
                        
                        
                        if(Config::get('app.locale') == 'en') {
                             $MessageStore = 'Dear partner '.$NameStore.' order number '.$request->order_number.' confirmed with an amount of '.$request->amount.' SAR to mobile number '.$request->phone;
                        } else {
                             $MessageStore = 'شريكنا العزيز '.$NameStore.' تم تأكيد طلب برقم  '.$request->order_number.' بمبلغ '.$request->amount.' ريال لرقم جوال '.$request->phone;
                        }
                        
                        
                      
                        
                        
                        // YesRepeat=1
    $url = "https://mobile.net.sa/sms/gw/";
	if(!$url || $url==""){
		return "No URL";
	}else{
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_HEADER, false);
		curl_setopt ($ch, CURLOPT_POST, true);
		$dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $NumbersStore, 'msg' => $MessageStore, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);  
// 		curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
		$FainalResult = curl_exec ($ch);
		curl_close ($ch);   
// 		return $FainalResult;
	}
	
	
	
	
	
	
	
	
                        // send sms to store end
                        
                        // send email to store
                        
                        // $to_name = 'نظام تقدر - إشعار بعملية';
                        // $to_email = 'm.m.shahmeh@gmail.com';
                        // $data = "Hello <strong>....</strong>, <p>aaaa</p>";
                        
                        // array('name'=>"Ogbonna Vitalis(sender_name)", "body" => "A test mail");
                        
                       
                        
                        Mail::send([], [], function ($message) {
                            
                             $storeEmail = Store::where('id', $GLOBALS['request']->store)->first()->email;
                            
                          $message->to($storeEmail );
                          
                            $message->subject('نظام تقدر - إشعار بعملية ');
                            
                            $message->from('info@tqdr.com.sa');
                            // here comes what you want
                            // ->setBody('Hi, welcome user!'); // assuming text/plain
                            // // or:
                            $message->setBody('
                            <h1>عزيزنا الشريك (المتجر) '
                            .Store::where("id", $GLOBALS['request']->store)->first()->store_name
                            .'</h1> 
                            <h2>يسعدنا خدمتكم في نظام تقدر للوساطة التجارية</h2>
                            <br/><br/>
                            <h4>تمت عملية دفع بمبلغ '.$GLOBALS['request']->amount.' ريال لرقم إيصال '.$GLOBALS['request']->order_number.'</h4>', 'text/html'); 
                            // for HTML rich messages
                        });
                            
                        //     send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                        // $message->to($to_email, $to_name)
                        // ->subject('TQDR Test Mail');
                        // $message->from('info@tqdr.com.sa','TQDR System');
                        // });
                        
                        // send email to store end
                        
                        // العملية ناجحة
                        
                        return redirect()->route( 'front.paysuccess' , [$language,$recordtostore->id]);
                    } else if($invoice->remaining_amount == 0 && $request->amount <= $invoice->amount) {
                        // update remaining_amount
                        $recordtoupdate=Invoice::where('id',$invoice->id)->first();
                        if($recordtoupdate->amount - $request->amount == 0) {
                            $recordtoupdate->is_paid = 1;
                            $recordtoupdate->status = 0;
                        } else if($recordtoupdate->amount - $request->amount > 0) {
                            $recordtoupdate->remaining_amount=$recordtoupdate->amount - $request->amount;
                            $recordtoupdate->is_paid = 0;
                        }
                        $recordtoupdate->save();
                        // update remaining_amount end
                        // save customer phone
                        if(Customer::where('phone', $request->phone)->exists() === false) {
                            $recordtostore1 = new Customer();
                            $recordtostore1->phone=$request->phone;
                            $recordtostore1->save();
                        }
                        // save customer phone end
                        // save invoice order
                        $recordtostore = new InvoiceOrder();
                        $recordtostore->amount=$request->amount;   
                        $recordtostore->customer_phone=$request->phone;
                        $recordtostore->store_id=$request->store;
                        $recordtostore->invoice_id=$request->order_number;
                        $recordtostore->save();
                        // save invoice order end
                        Session::forget('errorpay');
                        
                        // إرسال إيميلات ورسائل جوال
                        // send sms to customer
                        
                        
                        // send sms to customer end
                        
                        // send sms to store
                        
                        
                        // send sms to store end
                        
                        // send email to store
                        
                        
                        // send email to store end
                        
                        // العملية ناجحة
                        
                        return redirect()->route( 'front.paysuccess' , [$language,$recordtostore->id]);
                    } else {
                        Session::forget('errorpay');
                        $errorpayval = 'عذراً المبلغ الموجود في الإيصال غير كافٍ لعملية الدفع!';
                        Session::put('errorpay', $errorpayval);
                        return redirect()->back();
                    }
                    
                } 
            } else {
                // Session::forget('errorpay');
                // // \Brian2694\Toastr\Facades\Toastr::error( 'عذراً لم يتم العثور على رقم الإيصال!','',["positionClass" => "toast-top-right"] );
                // return redirect()->back();
            }
        }

        Session::forget('errorpay');
        $errorpayval = 'عذراً لم يتم العثور على رقم الإيصال';
        Session::put('errorpay', $errorpayval);
        return redirect()->back();
    }

    function paysuccess($language,$id)
    {
        $invoiceorder = InvoiceOrder::where('id',$id)->first();
        return view('Front.successpayment',compact('language','invoiceorder'));
    }

    function storepay($language,$id)
    {
        $store = Store::where('id',$id)->first();
        // $invoiceorder = InvoiceOrder::where('id',$id)->first();
        return view('Front.storepay',compact('language','store'));
    }

    function adminLogin($language)
    {
        return view('Admin.Account.login',[$language] );
    }

    function adminCheckLogin($language,Request $request)
    {
        
        $this->validate($request, [
            'email'           => 'required|email',
            'password'        => 'required|alphaNum|min:6',
        ]);

        $user_data = array(
            'email'           => $request->get('email'),
            'password'       => $request->get('password'),
        );


        // if( Auth::attempt($user_data) ) {
        //     switch(Auth::user()->admType) {
        //         case(1):
        //             return redirect()->route( 'adminSuccessLogin' );
        //             break;
        //         case(2):            
        //             return redirect()->route( 'storeSuccessLogin' ); 
        //             break;
        //         default:
        //             return null;
        //     }
        // } else {
        //     \Brian2694\Toastr\Facades\Toastr::error( 'الايميل أو كلمة المرور لا تتطابق مع السجلات!','',["positionClass" => "toast-top-right"] );
        //     return redirect()->back();
        // }
        

        if( Auth::guard('admin')->attempt($user_data) ) 
        {
            return redirect()->route( 'adminSuccessLogin', [$language] );
            // if(Auth::user()->admType == 1) {
            //     return redirect()->route( 'adminSuccessLogin' );
            // } else if(Auth::user()->admType == 2) {
            //     return redirect()->route( 'storeSuccessLogin' );
            // }  
        } 
        
        else if( Auth::guard('store')->attempt($user_data) ) 
        {
            return redirect()->route( 'storeSuccessLogin' , [$language] );
        }

        else 
        {
            \Brian2694\Toastr\Facades\Toastr::error( 'الايميل أو كلمة المرور لا تتطابق مع السجلات!','',["positionClass" => "toast-top-right"] );
            return redirect()->back();
        }

    }

    function adminSuccessLogin($language)
    {
        return view('Admin.Dashboard.index',[$language] );
    }

    function adminLogout($language)
    {
        Auth::guard('admin')->logout();

        Auth::logout();

        return redirect()->route('front.index',[$language]);
    }




    //...................................

    // function storeLogin()
    // {
    //     return view('store.account.login');
    // }
    // function storeCheckLogin(Request $request)
    // {
    //     return view('store.dashboard.index');
    //     // $this->validate($request, [
    //     //     'username'           => 'required',
    //     //     'password'        => 'required|alphaNum|min:6',
    //     // ]);
    //     // $user_data = array(
    //     //     'username'           => $request->get('username'),
    //     //     'password'        => $request->get('password'),
    //     // );
    //     // if(Auth::attempt($user_data)) 
    //     // {
    //     //     return redirect()->route('storeSuccessLogin', app()->getLocale());
    //     // }
    //     // else 
    //     // {
    //     //     return back()->with('error', 'Wrong Login Details');
    //     // }
    // }

    function storeSuccessLogin($language)
    {
        return view('Store.Dashboard.index', [$language] );
    }

    function storeLogout($language)
    {
        Auth::guard('admin')->logout();
        Auth::logout();
        return redirect()->route('front.index', [$language]);

        // Auth::logout();
        // return redirect()->route('front.index', app()->getLocale());
    }

    //...........................


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
