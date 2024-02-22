<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //
    public function createAccount(Request $request)
    {

        $validator  = Validator::make($request->all(), [

            'solde' => 'required|email|max:255',
            'user_id' => 'required'

        ]);
        if ($validator->fails()) {
            return  response()->json(['status' => 422, 'errors'  => 'insertion  errors'], 422);
        } else {
            $account = account::create([
                'account_number' => 'BANK-' . uniqid(),
                'solde' => $request->solde,
                'user_id' => $request->user_id
            ]);
            return ($account) ? response()->json(['status' => 200, 'message' => 'register Successfull'], 200) : response()->json(['status' => 500, 'message' => 'Internal  server error'], 500);
        }
    }

    public  function  editAccount(int $id, Request $request)
    {

        $validator  = Validator::make($request->all(), [

            'solde' => 'required',
            'user_id' => 'required'

        ]);
        if ($validator->fails()) {
            return  response()->json(['status' => 422, 'errors'  => 'insertion  errors'], 422);
        } else {
            $account = account::find($id);
            $account = account::update([
                'solde' => $request->solde
            ]);
            return ($account) ? response()->json(['status' => 200, 'message' => 'updated Successfull'], 200) : response()->json(['status' => 500, 'message' => 'Internal  server error'], 500);
        }
    }
    public function deleteAccount($id)
    {
        $account = account::find($id);
        if($account)
          { 
            $account->delete();
            return response()->json(['status' => 200, 'message' => 'deleted Successfull'], 200);
        }else{
            return response()->json(['status' => 404, 'no accounts find'], 404);
        }
            
    }
    public function getAllAccounts()
    {
        $accounts = account::all();
        return ($accounts->count() > 0) ? response()->json(['status' => 200, 'acccounts'  => $accounts], 200) : response()->json(['status' => 404, 'message'  => 'No record  found'], 404);
    }
    public function getAnAccount($id)
    {
        $account = account::find($id);
        return ($account) ? response()->json(['status' => 200, 'accounts' => $account], 200) : response()->json(['status' => 404, 'no accounts find'], 404);
    }
}
