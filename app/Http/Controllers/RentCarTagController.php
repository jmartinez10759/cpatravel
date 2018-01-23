<?php

namespace App\Http\Controllers;

use App\RentCarTag;
use Session;
use Illuminate\Http\Request;

class RentCarTagController extends Controller
{
    public function create(Request $request){
        if(is_null($request->request_id)){
            $RequestId = Session::get('request_id');
        }else{
            $RequestId = $request->request_id;
        }
        $idenCom = sha1($RequestId.' '.date('h:i:s'));
        if($request->form['type_nacional'] == 0){
            $rent = RentCarTag::create([
                                    'iden'              =>  $idenCom,
                                    'request_id'        =>  $RequestId,
                                    'type_nationality'  =>  $request->form['type_nacional'],
                                    'number_days'       =>  $request->form['numero_dias'],
                                    'authorized_amount' =>  $request->form['renta_por_dia'],
                                    'total_rent'        =>  $request->form['presupuesto_renta'],
                                    'naci_checks'       => (is_null($request->form['nacional_cheque']))? '0.00': $request->form['nacional_cheque'],
                                    'naci_debit'        => (is_null($request->form['nacional_debito']))? '0.00': $request->form['nacional_debito'],
                                    'naci_credit'       => (is_null($request->form['nacional_credito']))? '0.00': $request->form['nacional_credito'],
                                    'naci_cash'         => (is_null($request->form['nacional_efectivo']))? '0.00': $request->form['nacional_efectivo'],
                                    'naci_amex'         => (is_null($request->form['nacional_amex']))? '0.00': $request->form['nacional_amex']
                                ]);
            $rentD = RentCarTag::where('id',$rent->iden)->first();
            return response()->json($rentD);
        }elseif($request->form['type_nacional'] == 1){
            $rent = RentCarTag::create([
                                    'iden'              =>  $idenCom,
                                    'request_id'        =>  $RequestId,
                                    'type_nationality'  =>  $request->form['type_nacional'],
                                    'number_days'       =>  $request->form['numero_dias'],
                                    'authorized_amount' =>  $request->form['renta_por_dia'],
                                    'total_rent'        =>  $request->form['presupuesto_renta'],
                                    'extra_checks'      => (is_null($request->form['extranjero_cheque']))? '0.00':$request->form['extranjero_cheque'],
                                    'extra_debit'       => (is_null($request->form['extranjero_debito']))? '0.00':$request->form['extranjero_debito'],
                                    'extra_credit'      => (is_null($request->form['extranjero_credito']))? '0.00':$request->form['extranjero_credito'],
                                    'extra_cash'        => (is_null($request->form['extranjero_efectivo']))? '0.00':$request->form['extranjero_efectivo'],
                                    'extra_amex'        => (is_null($request->form['extranjero_amex']))? '0.00':$request->form['extranjero_amex']
                                ]);
            $rentD = RentCarTag::where('id',$rent->iden)->first();
            return response()->json($rentD);
        }
    }
}
