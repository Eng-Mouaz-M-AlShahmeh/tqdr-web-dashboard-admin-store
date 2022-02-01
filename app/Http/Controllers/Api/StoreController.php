<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Store;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    protected $admin;
    
    public $key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdHFkci5jb20uc2FcL2FwaVwvbG9naW4iLCJpYXQiOjE2Mzc3NjcyODgsImV4cCI6MTYzNzc2OTA4OCwibmJmIjoxNjM3NzY3Mjg4LCJqdGkiOiJ6azRLYnJ3T0FRTUdicnNPIiwic3ViIjoxMiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.jrj22YPlVZKR6l04IkzgX67ZuaQN50GGiLCeUtwzMtA';

    public function index(Request $request)
    {
        $data = $request->only(
            'apikey'
        );
        
        if($this->key === $request->apikey) {
            
            $stores = Store::where('status', 1)->get();

            $store_item = [];
            $store_list = [];
            
            foreach ($stores as $store) {
                $store_item['id'] = $store->id;
                $store_item['username'] = $store->username;
                $store_item['store_name'] = $store->store_name;
                $store_item['web_url'] = $store->web_url;
                $store_item['logo'] = $store->logo;
                $store_item['cover_image'] = $store->cover_image;
                $store_item['phone'] = $store->phone;
                $store_item['email'] = $store->email;
                $store_item['description'] = $store->description;
                $store_item['facebook'] = $store->socialLinks->facebook;
                $store_item['twitter'] = $store->socialLinks->twitter;
                $store_item['instagram'] = $store->socialLinks->instagram;
                $store_item['linkedin'] = $store->socialLinks->linkedin;
                $store_item['youtube'] = $store->socialLinks->youtube;
                $store_item['status'] = $store->status;
                $store_item['createdAt'] = $store->created_at;
                $store_item['updatedAt'] = $store->updated_at;
                $store_list[] = $store_item;
            }

            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $store_list,
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
            'search_key'
        );
        
        if($this->key === $request->apikey) {
            
            
            if(!empty( Store::where('store_name', 'like', '%' . $request->search_key . '%')->get()) ) {
            
             $stores = Store::where('store_name', 'like', '%' . $request->search_key . '%')->orderby('id', 'desc')->get();
       
             $store_item = [];
             $store_list = [];
            
             foreach ($stores as $store) {
                $store_item['id'] = $store->id;
                $store_item['username'] = $store->username;
                $store_item['store_name'] = $store->store_name;
                $store_item['web_url'] = $store->web_url;
                $store_item['logo'] = $store->logo;
                $store_item['cover_image'] = $store->cover_image;
                $store_item['phone'] = $store->phone;
                $store_item['email'] = $store->email;
                $store_item['description'] = $store->description;
                $store_item['facebook'] = $store->socialLinks->facebook;
                $store_item['twitter'] = $store->socialLinks->twitter;
                $store_item['instagram'] = $store->socialLinks->instagram;
                $store_item['linkedin'] = $store->socialLinks->linkedin;
                $store_item['youtube'] = $store->socialLinks->youtube;
                $store_item['status'] = $store->status;
                $store_item['createdAt'] = $store->created_at;
                $store_item['updatedAt'] = $store->updated_at;
                $store_list[] = $store_item;
             }

             return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $store_list,
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
