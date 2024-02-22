<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\account;
use App\Models\history;
use App\Models\transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransferAccountController extends Controller
{
    //
    public  function  createTransfert(Request $request)
    {
        $validator  = Validator::make($request->all(), [

            'Montant_transfert' => 'required',
            'destinataire' => 'required',
            'account_id' => 'required'

        ]);
        if ($validator->fails()) {
            return  response()->json(['status' => 422, 'errors'  => 'insertion  errors'], 422);
        } else {

            $account = account::find($request->account_id);
            $destinataire = account::find($request->destinataire);
            if ($account->solde > $request->Montant_transfert) {
                $destinatair  = account::update([
                    'solde' => (float)$destinataire->solde + $request->Montant_transfert
                ]);
                $transfer = transfer::create([
                    'Montant_transfert' => $request->Montant_transfert,
                    'destinataire' => $request->destinataire,
                    'user_id' => $account->user_id
                ]);
                return ($destinatair && $transfer) ? response()->json(['status' => 200, 'message' => 'register Successfull'], 200) : response()->json(['status' => 500, 'message' => 'Internal  server error'], 500);
            }else  return  response()->json([
                'status'=>403,
                'message'=> 'transaction  impossible'
            ],403);
                   

            
        }
    }
    public function getTransfert()
    {
          $transfer= transfer::all();
          return ($transfer->count() > 0) ? response()->json(['status' => 200, 'transfers'  => $transfer], 200) : response()->json(['status' => 404, 'message'  => 'No record  found'], 404);
 
    }
}
