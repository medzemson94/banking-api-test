<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    //
    /***
     *   login Method 
 */
    public function login(Request $request){
        
        
        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);
   
        if(!empty($token)){

            return response()->json([
                "status" => true,
                "message" => "User logged in succcessfully",
                "token" => $token,
                'user'=>auth()->user()
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
 

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
    /**
     *   register Method
     */
    public function  register(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
            'phone' => 'required',
            
        ]);
        if ($validator->fails()) {
            return  response()->json(['status' => 422, 'errors'  => 'insertion  errors'], 422);
        } else {
            $user = Users::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'is_enable'=>true,
                 'role' =>'customer'
                
            ]);
            return  ($user)?response()->json(['status'=>200,'message'=>'register Successfull'],200):response()->json(['status'=>500,'message'=>'Internal  server error'],500);
        }

        
    }
    public function  getUsers()
        {
            $users= Users::all();
            return ($users->count() > 0) ? response()->json(['status' => 200, 'acccounts'  => $users], 200) : response()->json(['status' => 404, 'message'  => 'No record  found'], 404);   
        }
}
