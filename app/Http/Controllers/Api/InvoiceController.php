<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Invoice;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller 
{
    public $key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdHFkci5jb20uc2FcL2FwaVwvbG9naW4iLCJpYXQiOjE2Mzc3NjcyODgsImV4cCI6MTYzNzc2OTA4OCwibmJmIjoxNjM3NzY3Mjg4LCJqdGkiOiJ6azRLYnJ3T0FRTUdicnNPIiwic3ViIjoxMiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.jrj22YPlVZKR6l04IkzgX67ZuaQN50GGiLCeUtwzMtA';

    public function index(Request $request)
    {
        $data = $request->only(
            'apikey',
            'id'
        );
        
        if($this->key === $request->apikey) {
            $invoice = Invoice::where('service_provider_id', $request->id)->get();

            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $invoice
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
    }
    
    public function inquiry(Request $request)
    {
        $data = $request->only(
            'apikey',
            'id'
        );
        
        if($this->key === $request->apikey) {
            
            $invoice = Invoice::where('id', $request->id)->first();
             
            if($invoice === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not Found'
                ], 404);
            } else {
                if($invoice->is_paid == 1) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invoice is paid'
                    ], 204); 
                } else {
                   return response()->json([
                        'success' => true,
                        'message' => 'Success',
                        'data' => $invoice
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
    
    public function store(Request $request)
    {
        $data = $request->only(
            'apikey',
            'amount',
            'remaining_amount',
            'is_paid',
            'service_provider_id'
        );
        
        if($this->key === $request->apikey) {
            
            $invoice = new Invoice();
            
            $invoice->amount =  $request->amount;
            $invoice->remaining_amount =  $request->remaining_amount;
            $invoice->is_paid =  $request->is_paid;
            $invoice->service_provider_id =  $request->service_provider_id;
            
            $invoice->save();
             
            return response()->json([
                        'success' => true,
                        'message' => 'Success',
                        'data' => $invoice
            ], 200);
            
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        
    }


}
