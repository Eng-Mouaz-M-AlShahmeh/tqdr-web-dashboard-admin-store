<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Store;
use App\Models\InvoiceOrder;
use Mail;
use Config;

class Invoices extends Component
{
    public $phone, $store, $amount, $order_number, $errorpay, $totalInvoices, $localInvoiceOrders, $amountcal, $isRecordCount, $successpay, $infopay;
    public $inputs = [];
    public $i = 1;
    
    public function add($i) {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }
    
    public function remove($i) {
        unset($this->inputs[$i]);
    }
    
    
    public function render()
    {
        return view('livewire.invoices');
    }
    
    private function resetInputFields() {
        $this->phone = '';
        $this->store = '';
        $this->amount = '';
        $this->order_number = '';
        $this->errorpay = '';
        $this->totalInvoices = 0;
        $this->localInvoiceOrders = [];
        $this->amountcal = '';
        $this->isRecordCount = 0;
        $this->successpay = '';
        $this->infopay = '';
    }
    
    
     public function pay() {

        if($this->phone == '') {
            $this->errorpay = '';
            $errorpayval = 'رقم الجوال مطلوب!';
            $this->errorpay = $errorpayval;
            return redirect()->back();
        }

        if($this->amount == '') {
            $this->errorpay = '';
            $errorpayval = 'المبلغ مطلوب!';
            $this->errorpay = $errorpayval;
            return redirect()->back();
        }

        if($this->store === null) {
            $this->errorpay = '';
            $errorpayval = 'اختيار الشريك (المتجر) مطلوب!';
            $this->errorpay = $errorpayval;
            return redirect()->back();
        }

        if($this->order_number == '') {
            $this->errorpay = '';
            $errorpayval = 'رقم الإيصال مطلوب!';
            $this->errorpay = $errorpayval;
            return redirect()->back();
        }

        if($this->amount > 5000) {
            $this->errorpay = '';
            $errorpayval = 'عذراً مبلغ الطلب لا يمكن أن يكون أكثر من 5000 ريال للعملية الواحدة';
            $this->errorpay = $errorpayval;
            return redirect()->back();
        }
        
        if(!preg_match('/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/', $this->phone)) {
            $this->errorpay = '';
            $errorpayval = 'يجب أن يكون رقم الجوال سعودي!';
            $this->errorpay = $errorpayval;
            return redirect()->back();
                            
        }
        
        foreach(Invoice::all() as $invoice) {
            foreach($this->order_number as $key => $value) {
                if($invoice->id == $this->order_number[$key]) {
                    $this->isRecordCount = $this->isRecordCount + 1;
                }
            }
        }
        
        if($this->isRecordCount == 0) {
            $this->errorpay = '';
            $errorpayval = 'عذراً لم يتم العثور على الإيصال (الإيصالات)';
            $this->errorpay = $errorpayval;
            return redirect()->back();
        }

        $this->totalInvoices = 0;
        // begin foreach loop invoices database
        foreach(Invoice::all() as $invoice) {
            // begin foreach loop invoices orders input fields
            foreach($this->order_number as $key => $value) {
                if($invoice->id == $this->order_number[$key]) {
                    if($invoice->is_paid == 1) {
                        $this->errorpay = '';
                        $errorpayval = 'عذراً لم يعد هذا الإيصال (الإيصالات) صالح لإجراء العملية';
                        $this->errorpay = $errorpayval;
                        return redirect()->back();
                    } else { 
                        $this->totalInvoices = $this->totalInvoices + $invoice->remaining_amount;
                        $this->localInvoiceOrders[] = $this->order_number[$key];
                    } 
                }
            } // end foreach loop invoices orders input fields
            
        } // end foreach loop invoices database
        
        if($this->amount > $this->totalInvoices) {
            $this->errorpay = '';
            $errorpayval = 'عذراً المبلغ الموجود في الإيصال (الإيصالات) غير كافٍ لعملية الدفع!';
            $this->errorpay = $errorpayval;
            return redirect()->back();
        } else {
            $this->errorpay = '';
            $this->successpay = '';
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
                            
                            $this->successpay = ' تم عملية دفع بمبلغ '.
                            $this->amount .
                            ' لرقم جوال '.
                            $this->phone .
                            ' لمتجر '.
                            \App\Models\Store::where('id', $this->store)->first()->store_name .
                            ' برقم ايصال '.
                            ' متعدد ';
                            
                            $this->infopay =
                            ' مبلغ متبقي للدفع  '. 
                            $this->amountcal;
                            
                            // // save invoice order
                            // $recordtostore = new InvoiceOrder();
                            // $recordtostore->amount = $this->amount;   
                            // $recordtostore->customer_phone = $this->phone;
                            // $recordtostore->store_id = $this->store;
                            // $recordtostore->invoice_id = '0';
                            // $recordtostore->save();
                            // // save invoice order end
                            
                            $this->resetInputFields();
                            
                            //return redirect()->route( 'front.paysuccess' , [Config::get('app.locale'),$recordtostore->id]);
                        } elseif($recordtoupdate->remaining_amount == 0 && $this->totalInvoices > $this->amountcal && $this->amountcal != 0) {
                            $this->infopay =
                            ' مبلغ متبقي للدفع  '. 
                            $this->amountcal;
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
                            if(Config::get('app.locale') == 'en') {
                                $Message = 'Dear customer your order number '.$successOrderID.' completed with an amount of '.$recordtoupdate->remaining_amount.' SAR to '.$NameStore;
                            } else {
                                $Message = 'عزيزنا العميل لقد تم تنفيذ طلبك رقم '.$successOrderID.' بمبلغ'.$recordtoupdate->remaining_amount.' ريال إلى '.$NameStore;
                            }
                            $url = "https://mobile.net.sa/sms/gw/";
                            if(!$url || $url==""){
                            		return "No URL";
                            } else{
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
                            if(Config::get('app.locale') == 'en') {
                                $MessageStore = 'Dear partner '.$NameStore.' order number '.$successOrderID.' confirmed with an amount of '.$recordtoupdate->remaining_amount.' SAR to mobile number '.$this->phone;
                            } else {
                                $MessageStore = 'شريكنا العزيز '.$NameStore.' تم تأكيد طلب برقم  '.$successOrderID.' بمبلغ '.$recordtoupdate->remaining_amount.' ريال لرقم جوال '.$this->phone;
                            }
                            $url = "https://mobile.net.sa/sms/gw/";
                        	if(!$url || $url==""){
                        		return "No URL";
                        	} else{
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
                            $this->successpay = ' تم عملية دفع بمبلغ '.
                            $recordtoupdate->remaining_amount .
                            ' لرقم جوال '.
                            $this->phone .
                            ' لمتجر '.
                            \App\Models\Store::where('id', $this->store)->first()->store_name .
                            ' برقم ايصال '.
                            $successOrderID;
                            // .................................
                            $recordtoupdate->is_paid = 1;
                            $recordtoupdate->status = 0;
                            $this->amountcal = $this->amountcal - $recordtoupdate->remaining_amount;
                            $recordtoupdate->remaining_amount = 0;
                            $recordtoupdate->save();
                            // return redirect()->route( 'front.paysuccess' , [Config::get('app.locale'),$recordtostore->id]);
                            
                            $this->infopay =
                            ' مبلغ متبقي للدفع  '. 
                            $this->amountcal;
                            
                            continue;
                            
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
                            if(Config::get('app.locale') == 'en') {
                                $Message = 'Dear customer your order number '.$successOrderID.' completed with an amount of '.$this->amountcal.' SAR to '.$NameStore;
                            } else {
                                $Message = 'عزيزنا العميل لقد تم تنفيذ طلبك رقم '.$successOrderID.' بمبلغ'.$this->amountcal.' ريال إلى '.$NameStore;
                            }
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
                            if(Config::get('app.locale') == 'en') {
                                $MessageStore = 'Dear partner '.$NameStore.' order number '.$successOrderID.' confirmed with an amount of '.$this->amountcal.' SAR to mobile number '.$this->phone;
                            } else {
                                $MessageStore = 'شريكنا العزيز '.$NameStore.' تم تأكيد طلب برقم  '.$successOrderID.' بمبلغ '.$this->amountcal.' ريال لرقم جوال '.$this->phone;
                            }
                            $url = "https://mobile.net.sa/sms/gw/";
                        	if(!$url || $url==""){
                        		return "No URL";
                        	} else{
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
                            
                            $this->successpay = ' تم عملية دفع بمبلغ '.
                            $this->amountcal .
                            ' لرقم جوال '.
                            $this->phone .
                            ' لمتجر '.
                            \App\Models\Store::where('id', $this->store)->first()->store_name .
                            ' برقم ايصال '.
                            $successOrderID;
                            // ...................................
                            $recordtoupdate->is_paid = 1;
                            $recordtoupdate->status = 0;
                            $recordtoupdate->remaining_amount = 0;
                            $this->amountcal = 0;
                            $recordtoupdate->save();
                            
                            $this->infopay =
                            ' مبلغ متبقي للدفع  '. 
                            $this->amountcal;
                            
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
                            if(Config::get('app.locale') == 'en') {
                                $Message = 'Dear customer your order number '.$successOrderID.' completed with an amount of '.$this->amountcal.' SAR to '.$NameStore;
                            } else {
                                $Message = 'عزيزنا العميل لقد تم تنفيذ طلبك رقم '.$successOrderID.' بمبلغ'.$this->amountcal.' ريال إلى '.$NameStore;
                            }
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
                            if(Config::get('app.locale') == 'en') {
                                $MessageStore = 'Dear partner '.$NameStore.' order number '.$successOrderID.' confirmed with an amount of '.$this->amountcal.' SAR to mobile number '.$this->phone;
                            } else {
                                $MessageStore = 'شريكنا العزيز '.$NameStore.' تم تأكيد طلب برقم  '.$successOrderID.' بمبلغ '.$this->amountcal.' ريال لرقم جوال '.$this->phone;
                            }
                            $url = "https://mobile.net.sa/sms/gw/";
                        	if(!$url || $url==""){
                        		return "No URL";
                        	} else{
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
                            
                            // return redirect()->route( 'front.paysuccess' , [Config::get('app.locale'),$recordtostore->id]);
                            $this->successpay = ' تم عملية دفع بمبلغ '.
                            $this->amountcal .
                            ' لرقم جوال '.
                            $this->phone .
                            ' لمتجر '.
                            \App\Models\Store::where('id', $this->store)->first()->store_name .
                            ' برقم ايصال '.
                            $successOrderID;
                            // .................................
                            $recordtoupdate->is_paid = 0;
                            $recordtoupdate->status = 1;
                            $recordtoupdate->remaining_amount = $recordtoupdate->remaining_amount - $this->amountcal;
                            $this->amountcal = 0;
                            $recordtoupdate->save();
                            
                            $this->infopay =
                            ' مبلغ متبقي للدفع  '. 
                            $this->amountcal;

                        }
                    }
                } // end foreach loop invoices orders input fields
            } // end foreach loop invoices database
        }
    }
    
    
    
    
}
