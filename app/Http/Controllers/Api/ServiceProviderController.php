<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class ServiceProviderController extends Controller
{
    protected $admin;
 
    public $key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdHFkci5jb20uc2FcL2FwaVwvbG9naW4iLCJpYXQiOjE2Mzc3NjcyODgsImV4cCI6MTYzNzc2OTA4OCwibmJmIjoxNjM3NzY3Mjg4LCJqdGkiOiJ6azRLYnJ3T0FRTUdicnNPIiwic3ViIjoxMiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.jrj22YPlVZKR6l04IkzgX67ZuaQN50GGiLCeUtwzMtA';
    
    public function checklogin(Request $request)
    {
        $data = $request->only(
            'apikey',
            'username',
            'password'
        );
        
        if($this->key === $request->apikey) {
            if ($serviceProvider = ServiceProvider::where('username', $request->username)->first()) {
              $pass = Hash::check($request->password, $serviceProvider->password);
              if ($pass) {
                return response()->json([
                    'success' => true,
                    'message' => 'Success',
                    'data' => $serviceProvider
                ], 200);
              } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Bad Request'
                ], 400);
              }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'NotFound'
                ], 404);
            } 
            
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
    }
    
    public function updatesp(Request $request)
    {
        $data = $request->only(
            'apikey',
            'id',
            'username',
            'password'
        );
        
        if($this->key === $request->apikey) {
            $serviceProvider = ServiceProvider::where('id', $request->id)->first();
            if ($serviceProvider) {
                $serviceProvider->username = $request->username;
                $serviceProvider->password = bcrypt($request->password);
                $serviceProvider->save();
              
                return response()->json([
                    'success' => true,
                    'message' => 'Updated Successfully',
                ], 200);

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'NotFound'
                ], 404);
            } 
            
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
    }
    
    public function index(Request $request)
    {
        $data = $request->only(
            'apikey'
        );
        
        if($this->key === $request->apikey) {
            $serviceProvider = ServiceProvider::where('status', 1)->get();

            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $serviceProvider
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
    }
    
    public function search(Request $request)
    {
        $data = $request->only(
            'apikey',
            'key_search'
        );
        
        if($this->key === $request->apikey) {
            
            if(!empty( 
                ServiceProvider::where('phone', '=', $request->key_search)
                ->orwhere('nighborhood', 'like', '%' . $request->key_search . '%')
                ->orwhere('storeName', 'like', '%' . $request->key_search . '%')
                ->first()) 
                ) {
            
             $serviceprovider = ServiceProvider::where('phone', '=', $request->key_search)
                ->orwhere('nighborhood', 'like', '%' . $request->key_search . '%')
                ->orwhere('storeName', 'like', '%' . $request->key_search . '%')->orderby('id', 'desc')->get();
       
            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $serviceprovider
            ], 200);
                    
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'No results'
                    ], 204);
                }
            
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
    }

 

    

  


  
}
