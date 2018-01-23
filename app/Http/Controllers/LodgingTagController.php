<?php

namespace App\Http\Controllers;

use App\LodgingTag;
use Illuminate\Http\Request;
use Session;
use Log;

class LodgingTagController extends Controller
{
    public function create(Request $request){
        
        if(is_null($request->request_id)){
            $RequestId = Session::get('request_id');
        }else{
            $RequestId = $request->request_id;
        }
        $idenCom= sha1($RequestId.' '.date('h:i:s'));
        if($request->form['type_nacional'] == 0){
           $lod = LodgingTag::create([
                                    'request_id'        => $RequestId,
                                    'iden'              => $idenCom,
                                    'type_nationality'  => $request->form['type_nacional'],
                                    'number_nights'     => $request->form['numero_noches'],
                                    'unit_cost'         => $request->form['costo_unitario'],
                                    'number_rooms'      => $request->form['numero_cuartos'],
                                    'total_cost'        => $request->form['costo_total'],
                                    'naci_checks'       => (is_null($request->form['nacional_cheque']))? '0.00': $request->form['nacional_cheque'],
                                    'naci_debit'        => (is_null($request->form['nacional_debito']))? '0.00': $request->form['nacional_debito'],
                                    'naci_credit'       => (is_null($request->form['nacional_credito']))? '0.00': $request->form['nacional_credito'],
                                    'naci_cash'         => (is_null($request->form['nacional_efectivo']))? '0.00': $request->form['nacional_efectivo'],
                                    'naci_amex'         => (is_null($request->form['nacional_amex']))? '0.00': $request->form['nacional_amex']
                                    ]);
                            $lodD = LodgingTag::where('id',$lod->iden)->first();
                            return response()->json($lodD);
        }else if($request->form['type_nacional'] == 1){
            $lod = LodgingTag::create([
                                    'request_id'        => $RequestId,
                                    'iden'              => $idenCom,
                                    'type_nationality'  => $request->form['type_nacional'],
                                    'number_nights'     => $request->form['numero_noches'],
                                    'unit_cost'         => $request->form['costo_unitario'],
                                    'number_rooms'      => $request->form['numero_cuartos'],
                                    'total_cost'        => $request->form['costo_total'],
                                    'extra_checks'      => (is_null($request->form['extranjero_cheque']))? '0.00':$request->form['extranjero_cheque'],
                                    'extra_debit'       => (is_null($request->form['extranjero_debito']))? '0.00':$request->form['extranjero_debito'],
                                    'extra_credit'      => (is_null($request->form['extranjero_credito']))? '0.00':$request->form['extranjero_credito'],
                                    'extra_cash'        => (is_null($request->form['extranjero_efectivo']))? '0.00':$request->form['extranjero_efectivo'],
                                    'extra_amex'        => (is_null($request->form['extranjero_amex']))? '0.00':$request->form['extranjero_amex']
                                    ]);
                            $lodD = LodgingTag::where('id',$lod->iden)->first();
                            return response()->json($lodD);
        }
    }

}
