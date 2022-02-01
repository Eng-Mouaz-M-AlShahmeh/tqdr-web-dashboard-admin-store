<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\InvoiceOrder;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Store;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Mail;
use Config;

class InvoiceOrderController extends Controller
{
    public $key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdHFkci5jb20uc2FcL2FwaVwvbG9naW4iLCJpYXQiOjE2Mzc3NjcyODgsImV4cCI6MTYzNzc2OTA4OCwibmJmIjoxNjM3NzY3Mjg4LCJqdGkiOiJ6azRLYnJ3T0FRTUdicnNPIiwic3ViIjoxMiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.jrj22YPlVZKR6l04IkzgX67ZuaQN50GGiLCeUtwzMtA';
    
    public $isRecordCount, $totalInvoices, $amountcal;
    public $phone, $amount, $store;
    public $localInvoiceOrders = [];
    public $order_number = [];
    
    public function pay(Request $request)
    {
        $data = $request->only(
            'apikey',
            'phone',
            'amount',
            'store',
            'order_number[]'
        );
        
        if($this->key === $request->apikey) {
            
            if($request->phone == '') {
                return response()->json([
                    'success' => false,
                    'message' => 'رقم الجوال مطلوب',
                ], 400);
            }

            if($request->amount == '') {
                return response()->json([
                    'success' => false,
                    'message' => 'المبلغ مطلوب',
                ], 400);
            }

            if($request->store === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'اختيار المتجر مطلوب',
                ], 400);
            }

            if($request->order_number == '') {
                return response()->json([
                    'success' => false,
                    'message' => 'رقم الطلب مطلوب',
                ], 400);
            }

            if($request->amount > 5000) {
                return response()->json([
                    'success' => false,
                    'message' => 'المبلغ يجب أن يكون أقل من 5000 ريال للعملية الواحدة',
                ], 422);
            }
        
            if(!preg_match('/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/', $request->phone)) {
                return response()->json([
                    'success' => false,
                    'message' => 'رقم الجوال يجب أن يكون رقم جوال سعودي صحيح',
                ], 422);
                                
            }
        
            foreach(Invoice::all() as $invoice) {
                foreach($request->order_number as $key => $value) {
                    if($invoice->id == $request->order_number[$key]) {
                        $this->isRecordCount = $this->isRecordCount + 1;
                    }
                }
            }
        
            if($this->isRecordCount == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'رقم الطلب (أرقام الطلبات) ليست موجودة',
                ], 400);
            }

            $this->totalInvoices = 0;
            // begin foreach loop invoices database
            foreach(Invoice::all() as $invoice) {
                // begin foreach loop invoices orders input fields
                foreach($request->order_number as $key => $value) {
                    if($invoice->id == $request->order_number[$key]) {
                        if($invoice->is_paid == 1) {
                            return response()->json([
                                'success' => false,
                                'message' => 'رقم الطلب (أرقام الطلبات) ليست صالحة لعملية الدفع',
                            ], 422);
                        } else { 
                            $this->totalInvoices = $this->totalInvoices + $invoice->remaining_amount;
                            $this->localInvoiceOrders[] = $request->order_number[$key];
                        } 
                    }
                } // end foreach loop invoices orders input fields
            } // end foreach loop invoices database
            
            $this->phone = $request->phone;
            $this->amount = $request->amount;
            $this->store = $request->store;
            $this->order_number[] = $request->order_number;
        
            if($this->amount > $this->totalInvoices) {
                return response()->json([
                    'success' => false,
                    'message' => 'المبلغ المتوفر في رقم الطلب (أرقام الطلبات) ليست كافية لعملية الدفع',
                ], 422);
            } else {
                $this->amountcal = $this->amount;
                // begin foreach loop invoices database
                foreach(Invoice::all() as $invoice) {
                    // begin foreach loop success invoices orders
                    foreach($this->localInvoiceOrders as $successOrderID) {
                        
                        $GLOBALS['successOrderID1'] = $successOrderID;
                        
                        if($invoice->id == $successOrderID) { 
                            // update remaining_amount
                            $recordtoupdate=Invoice::where('id',$successOrderID)->first();
                            
                            if($this->amountcal == 0) {
                                // // save invoice order
                                // $recordtostore = new InvoiceOrder();
                                // $recordtostore->amount = $this->amount;   
                                // $recordtostore->customer_phone = $this->phone;
                                // $recordtostore->store_id = $this->store;
                                // $recordtostore->invoice_id = '0';
                                // $recordtostore->save();
                                // // save invoice order end
                                
                                // return response()->json([
                                //     'success' => true,
                                //     'message' => 'Payment done by amount '.$this->amount.' SAR, for mobile '.$this->phone.' , for store '.\App\Models\Store::where('id', $this->store)->first()->store_name.' by multi order numbers and reamaining amount to pay'.$this->amountcal.' SAR',
                                //     'data' => '',
                                // ], 200);
                                continue;
                                
                            } elseif($recordtoupdate->remaining_amount == 0 && $this->totalInvoices > $this->amountcal && $this->amountcal != 0) {
                                continue;
                            } elseif($recordtoupdate->remaining_amount < $this->amountcal && $this->totalInvoices > $this->amountcal) {
                                // save customer phone
                                if(Customer::where('phone', $this->phone)->exists() === false) {
                                    $recordtostore1 = new Customer();
                                    $recordtostore1->phone = $this->phone;
                                    $recordtostore1->save();
                                }
                                // save customer phone end
                                // save invoice order
                                $recordtostore = new InvoiceOrder();
                                $recordtostore->amount = $recordtoupdate->remaining_amount;   
                                $recordtostore->customer_phone = $this->phone;
                                $recordtostore->store_id = $this->store;
                                $recordtostore->invoice_id = $successOrderID;
                                $recordtostore->save();
                                // save invoice order end
                                // ................................
                                // ................................
                                // send sms
                                // ................................
                                // customer sms
                                $infos="";
                                $xml="";
                                $Numbers = $this->phone;
                                $NameStore = \App\Models\Store::where('id', $this->store)->first()->store_name;
                                if(Config::get('app.locale') == 'ar') {
                                    $Message = 'Dear customer your order number '.$successOrderID.' completed with an amount of '.$recordtoupdate->remaining_amount.' SAR to '.$NameStore;
                                } else {
                                    $Message = 'عزيزنا العميل لقد تم تنفيذ طلبك رقم '.$successOrderID.' بمبلغ'.$recordtoupdate->remaining_amount.' ريال إلى '.$NameStore;
                                }
                                $url = "https://mobile.net.sa/sms/gw/";
                                if(!$url || $url==""){
                                		return "No URL";
                                } else {
                                	$ch = curl_init(); 
                                	curl_setopt($ch, CURLOPT_URL,$url);
                                	curl_setopt ($ch, CURLOPT_HEADER, false);
                                	curl_setopt ($ch, CURLOPT_POST, true);
                                	$dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $Numbers, 'msg' => $Message, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
                                	curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
                                	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                                	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                	curl_setopt($ch, CURLOPT_VERBOSE, 0);  
                                    // curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
                                	$FainalResult = curl_exec ($ch);
                                	curl_close ($ch);   
                                    // return $FainalResult;
                                }
                                // end customer sms
                                // ................................
                                // ................................
                                // store sms
                                $NumbersStore = \App\Models\Store::where('id', $this->store)->first()->phone;
                                $NameStore = \App\Models\Store::where('id', $this->store)->first()->store_name;
                                if(Config::get('app.locale') == 'ar') {
                                    $MessageStore = 'Dear partner '.$NameStore.' order number '.$successOrderID.' confirmed with an amount of '.$recordtoupdate->remaining_amount.' SAR to mobile number '.$this->phone;
                                } else {
                                    $MessageStore = 'شريكنا العزيز '.$NameStore.' تم تأكيد طلب برقم  '.$successOrderID.' بمبلغ '.$recordtoupdate->remaining_amount.' ريال لرقم جوال '.$this->phone;
                                }
                                $url = "https://mobile.net.sa/sms/gw/";
                            	if(!$url || $url==""){
                            		return "No URL";
                            	} else {
                            		$ch = curl_init(); 
                            		curl_setopt($ch, CURLOPT_URL,$url);
                            		curl_setopt ($ch, CURLOPT_HEADER, false);
                            		curl_setopt ($ch, CURLOPT_POST, true);
                            		$dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $NumbersStore, 'msg' => $MessageStore, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
                            		curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
                            		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                            		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            		curl_setopt($ch, CURLOPT_VERBOSE, 0);  
                                    // curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
                            		$FainalResult = curl_exec ($ch);
                            		curl_close ($ch);   
                                    // return $FainalResult;
                            	}
                            	// end store sms
                                // ................................
                                // end send sms
                                // ................................
                                // ................................
                                // send email
                                $GLOBALS['successamount'] = $recordtoupdate->remaining_amount;
                                Mail::send([], [], function ($message) {
                                    $storeEmail = Store::where('id', $this->store)->first()->email;
                                    $message->to($storeEmail );
                                    $message->subject('نظام تقدر - إشعار بعملية ');
                                    $message->from('info@tqdr.com.sa');
                                    $message->setBody('
                                    <h1>عزيزنا الشريك (المتجر) '
                                    .Store::where("id", $this->store)->first()->store_name
                                    .'</h1> 
                                    <h2>يسعدنا خدمتكم في نظام تقدر للوساطة التجارية</h2>
                                    <br/><br/>
                                    <h4>تمت عملية دفع بمبلغ '.$GLOBALS['successamount'].' ريال لرقم إيصال '.$GLOBALS['successOrderID1'].'</h4>', 'text/html'); 
                                });
                                // end send email
                                // ................................
                                
                                $this->amountcal = $this->amountcal - $recordtoupdate->remaining_amount;
                                
                                // $jsonMsg = 'Payment done by amount '.$recordtoupdate->remaining_amount.' SAR, for mobile '.$this->phone.' , for store '.\App\Models\Store::where('id', $this->store)->first()->store_name.' by order number '.$successOrderID.' and reamaining amount to pay'.$this->amountcal.' SAR';
                                
                                // .................................
                                $recordtoupdate->is_paid = 1;
                                $recordtoupdate->status = 0;
                                $recordtoupdate->remaining_amount = 0;
                                $recordtoupdate->save();
                                
                                
                                // return response()->json([
                                //     'success' => true,
                                //     'message' => $jsonMsg,
                                // ], 200);
                                
                                // continue;
                                
                            } elseif($recordtoupdate->remaining_amount == $this->amountcal) {
                                // save customer phone
                                if(Customer::where('phone', $this->phone)->exists() === false) {
                                    $recordtostore1 = new Customer();
                                    $recordtostore1->phone = $this->phone;
                                    $recordtostore1->save();
                                }
                                // save customer phone end
                                // save invoice order
                                $recordtostore = new InvoiceOrder();
                                $recordtostore->amount = $this->amountcal;   
                                $recordtostore->customer_phone = $this->phone;
                                $recordtostore->store_id = $this->store;
                                $recordtostore->invoice_id = $successOrderID;
                                $recordtostore->save();
                                // save invoice order end
                                // ................................
                                // ................................
                                // send sms
                                // ................................
                                // customer sms
                                $infos="";
                                $xml="";
                                $Numbers = $this->phone;
                                $NameStore = \App\Models\Store::where('id', $this->store)->first()->store_name;
                                if(Config::get('app.locale') == 'ar') {
                                    $Message = 'Dear customer your order number '.$successOrderID.' completed with an amount of '.$this->amountcal.' SAR to '.$NameStore;
                                } else {
                                    $Message = 'عزيزنا العميل لقد تم تنفيذ طلبك رقم '.$successOrderID.' بمبلغ'.$this->amountcal.' ريال إلى '.$NameStore;
                                }
                                $url = "https://mobile.net.sa/sms/gw/";
                                if(!$url || $url=="") {
                                		return "No URL";
                                } else {
                                	$ch = curl_init(); 
                                	curl_setopt($ch, CURLOPT_URL,$url);
                                	curl_setopt ($ch, CURLOPT_HEADER, false);
                                	curl_setopt ($ch, CURLOPT_POST, true);
                                	$dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $Numbers, 'msg' => $Message, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
                                	curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
                                	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                                	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                	curl_setopt($ch, CURLOPT_VERBOSE, 0);  
                                    // curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
                                	$FainalResult = curl_exec ($ch);
                                	curl_close ($ch);   
                                    // return $FainalResult;
                                }
                                // end customer sms
                                // ................................
                                // ................................
                                // store sms
                                $NumbersStore = \App\Models\Store::where('id', $this->store)->first()->phone;
                                $NameStore = \App\Models\Store::where('id', $this->store)->first()->store_name;
                                if(Config::get('app.locale') == 'ar') {
                                    $MessageStore = 'Dear partner '.$NameStore.' order number '.$successOrderID.' confirmed with an amount of '.$this->amountcal.' SAR to mobile number '.$this->phone;
                                } else {
                                    $MessageStore = 'شريكنا العزيز '.$NameStore.' تم تأكيد طلب برقم  '.$successOrderID.' بمبلغ '.$this->amountcal.' ريال لرقم جوال '.$this->phone;
                                }
                                $url = "https://mobile.net.sa/sms/gw/";
                            	if(!$url || $url=="") {
                            		return "No URL";
                            	} else {
                            		$ch = curl_init(); 
                            		curl_setopt($ch, CURLOPT_URL,$url);
                            		curl_setopt ($ch, CURLOPT_HEADER, false);
                            		curl_setopt ($ch, CURLOPT_POST, true);
                            		$dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $NumbersStore, 'msg' => $MessageStore, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
                            		curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
                            		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                            		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            		curl_setopt($ch, CURLOPT_VERBOSE, 0);  
                                    // curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
                            		$FainalResult = curl_exec ($ch);
                            		curl_close ($ch);   
                                    // return $FainalResult;
                            	}
                            	// end store sms
                                // ................................
                                // end send sms
                                // ................................
                                // ................................
                                // send email
                                Mail::send([], [], function ($message) {
                                    $storeEmail = Store::where('id', $this->store)->first()->email;
                                    $message->to($storeEmail );
                                    $message->subject('نظام تقدر - إشعار بعملية ');
                                    $message->from('info@tqdr.com.sa');
                                    $message->setBody('
                                    <h1>عزيزنا الشريك (المتجر) '
                                    .Store::where("id", $this->store)->first()->store_name
                                    .'</h1> 
                                    <h2>يسعدنا خدمتكم في نظام تقدر للوساطة التجارية</h2>
                                    <br/><br/>
                                    <h4>تمت عملية دفع بمبلغ '.$this->amountcal.' ريال لرقم إيصال '.$GLOBALS['successOrderID1'].'</h4>', 'text/html'); 
                                });
                                // end send email
                                // ................................

                                // $jsonMsg = 'Payment done by amount '.$this->amountcal.' SAR, for mobile '.$this->phone.' , for store '.\App\Models\Store::where('id', $this->store)->first()->store_name.' by order number '.$successOrderID.' and reamaining amount to pay 0 SAR';
                                
                                $this->amountcal = 0;
                                
                                // .................................
                                $recordtoupdate->is_paid = 1;
                                $recordtoupdate->status = 0;
                                $recordtoupdate->remaining_amount = 0;
                                $recordtoupdate->save();
                                
                                // return response()->json([
                                //     'success' => true,
                                //     'message' => $jsonMsg,
                                // ], 200);

                                
                            } elseif($recordtoupdate->remaining_amount > $this->amountcal) {
                                // save customer phone
                                if(Customer::where('phone', $this->phone)->exists() === false) {
                                    $recordtostore1 = new Customer();
                                    $recordtostore1->phone = $this->phone;
                                    $recordtostore1->save();
                                }
                                // save customer phone end
                                // save invoice order
                                $recordtostore = new InvoiceOrder();
                                $recordtostore->amount = $this->amountcal;   
                                $recordtostore->customer_phone = $this->phone;
                                $recordtostore->store_id = $this->store;
                                $recordtostore->invoice_id = $successOrderID;
                                $recordtostore->save();
                                // save invoice order end
                                // ................................
                                // ................................
                                // send sms
                                // ................................
                                // customer sms
                                $infos="";
                                $xml="";
                                $Numbers = $this->phone;
                                $NameStore = \App\Models\Store::where('id', $this->store)->first()->store_name;
                                if(Config::get('app.locale') == 'ar') {
                                    $Message = 'Dear customer your order number '.$successOrderID.' completed with an amount of '.$this->amountcal.' SAR to '.$NameStore;
                                } else {
                                    $Message = 'عزيزنا العميل لقد تم تنفيذ طلبك رقم '.$successOrderID.' بمبلغ'.$this->amountcal.' ريال إلى '.$NameStore;
                                }
                                $url = "https://mobile.net.sa/sms/gw/";
                                if(!$url || $url=="") {
                                		return "No URL";
                                } else {
                                	$ch = curl_init(); 
                                	curl_setopt($ch, CURLOPT_URL,$url);
                                	curl_setopt ($ch, CURLOPT_HEADER, false);
                                	curl_setopt ($ch, CURLOPT_POST, true);
                                	$dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $Numbers, 'msg' => $Message, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
                                	curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
                                	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                                	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                	curl_setopt($ch, CURLOPT_VERBOSE, 0);  
                                    // curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
                                	$FainalResult = curl_exec ($ch);
                                	curl_close ($ch);   
                                    // return $FainalResult;
                                }
                                // end customer sms
                                // ................................
                                // ................................
                                // store sms
                                $NumbersStore = \App\Models\Store::where('id', $this->store)->first()->phone;
                                $NameStore = \App\Models\Store::where('id', $this->store)->first()->store_name;
                                if(Config::get('app.locale') == 'ar') {
                                    $MessageStore = 'Dear partner '.$NameStore.' order number '.$successOrderID.' confirmed with an amount of '.$this->amountcal.' SAR to mobile number '.$this->phone;
                                } else {
                                    $MessageStore = 'شريكنا العزيز '.$NameStore.' تم تأكيد طلب برقم  '.$successOrderID.' بمبلغ '.$this->amountcal.' ريال لرقم جوال '.$this->phone;
                                }
                                $url = "https://mobile.net.sa/sms/gw/";
                            	if(!$url || $url=="") {
                            		return "No URL";
                            	} else {
                            		$ch = curl_init(); 
                            		curl_setopt($ch, CURLOPT_URL,$url);
                            		curl_setopt ($ch, CURLOPT_HEADER, false);
                            		curl_setopt ($ch, CURLOPT_POST, true);
                            		$dataPOST = array('userName' => '966566293256', 'userPassword' => '78515823', 'userSender' => 'Tqdr.com.sa', 'numbers' => $NumbersStore, 'msg' => $MessageStore, 'By' => "standard".$infos.$xml,'YesRepeat' => '1');
                            		curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataPOST); 
                            		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                            		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            		curl_setopt($ch, CURLOPT_VERBOSE, 0);  
                                    // curl_setopt($ch, CURLE_HTTP_NOT_FOUND,1); 
                            		$FainalResult = curl_exec ($ch);
                            		curl_close ($ch);   
                                    // return $FainalResult;
                            	}
                            	// end store sms
                                // ................................
                                // end send sms
                                // ................................
                                // ................................
                                // send email
                                Mail::send([], [], function ($message) {
                                    $storeEmail = Store::where('id', $this->store)->first()->email;
                                    $message->to($storeEmail );
                                    $message->subject('نظام تقدر - إشعار بعملية ');
                                    $message->from('info@tqdr.com.sa');
                                    $message->setBody(
                                    ' <h1>عزيزنا الشريك (المتجر) '.
                                    Store::where("id", $this->store)->first()->store_name .
                                    '</h1> 
                                    <h2>يسعدنا خدمتكم في نظام تقدر للوساطة التجارية</h2>
                                    <br/><br/>
                                    <h4>تمت عملية دفع بمبلغ ' .
                                    $this->amountcal .
                                    ' ريال لرقم إيصال ' . 
                                    $GLOBALS['successOrderID1'].
                                    '</h4>', 'text/html'); 
                                });
                                // end send email
                                // ................................
                                
                                // $jsonMsg = 'Payment done by amount '.$this->amountcal.' SAR, for mobile '.$this->phone.' , for store '.\App\Models\Store::where('id', $this->store)->first()->store_name.' by order number '.$successOrderID.' and reamaining amount to pay 0 SAR';

                                // .................................
                                $recordtoupdate->is_paid = 0;
                                $recordtoupdate->status = 1;
                                $recordtoupdate->remaining_amount = $recordtoupdate->remaining_amount - $this->amountcal;
                                $recordtoupdate->save();
                                
                                $this->amountcal = 0;
                                
                                // return response()->json([
                                //     'success' => true,
                                //     'message' => $jsonMsg,
                                // ], 200);
                                
    
                            }
                        }
                    } // end foreach loop invoices orders input fields
                } // end foreach loop invoices database
                
                
                return response()->json([
                    'success' => true,
                    'message' => 'Payment done by amount '.$this->amount.' SAR, for mobile '.$this->phone.' , for store '.\App\Models\Store::where('id', $this->store)->first()->store_name.' by order number(s) and reamaining amount to pay '.$this->amountcal.' SAR',
                ], 200);
                                
                                
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
    }

  
}
