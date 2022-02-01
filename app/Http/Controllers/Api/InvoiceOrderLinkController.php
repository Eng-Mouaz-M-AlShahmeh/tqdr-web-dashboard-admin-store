<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\InvoiceOrderLink;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class InvoiceOrderLinkController extends Controller 
{
    protected $admin;
    
    public $key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdHFkci5jb20uc2FcL2FwaVwvbG9naW4iLCJpYXQiOjE2Mzc3NjcyODgsImV4cCI6MTYzNzc2OTA4OCwibmJmIjoxNjM3NzY3Mjg4LCJqdGkiOiJ6azRLYnJ3T0FRTUdicnNPIiwic3ViIjoxMiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.jrj22YPlVZKR6l04IkzgX67ZuaQN50GGiLCeUtwzMtA';


    public function index(Request $request)
    {
        $data = $request->only(
            'apikey',
            'link'
        );
        
        if($this->key === $request->apikey) {
            $invoiceOrderLink = InvoiceOrderLink::where('link', $request->link)->get();
            
            if($invoiceOrderLink === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not Found'
                ], 404);
            } else {
                if($invoiceOrderLink->first()->status == 0) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid link'
                    ], 204); 
                } else {
                    $res_item = [];
                    $res_list = [];
                    $item = $invoiceOrderLink->first();
                    $res_item['id'] = $item->id;
                    $res_item['customer_name'] = $item->customer_name;
                    $res_item['customer_phone']=$item->customer_phone;
                    $res_item['store_id']=$item->store_id;
                    $res_item['store_name']=$item->store->store_name;
                    $res_item['amount']=$item->amount;
                    $res_item['link']=$item->link;
                    $res_item['status']=$item->status;
                    $res_item['created_at']=$item->created_at;
                    $res_item['updated_at']=$item->updated_at;
                    
                    $res_list[] = $res_item;
        
                    return response()->json([
                        'success' => true,
                        'message' => 'Success',
                        'data' => isset($res_item) ? $res_item : [],
                    ], 200); 
                }
                
                
            }
            
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
    }
    

}
