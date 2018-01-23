<?php

namespace App\Http\Controllers;

use App\FoodTag;
use Session;
use Illuminate\Http\Request;

class FoodTagController extends Controller
{
    public function create(Request $request){
        if(is_null($request->request_id)){

            $RequestId = Session::get('request_id');

        }else{
            $RequestId = $request->request_id;
        }

        $idenCom = sha1($RequestId.' '.$request->presupuesto_diario.' '.$request->total_prespuesto.' '.date('h:i:s'));
        if($request->form['type_nacional'] == 0){
            $food = FoodTag::create([
                                'request_id'        => $RequestId,
                                'iden'              => $idenCom,
                                'type_nationality'  => $request->form['type_nacional'],
                                'number_foods'      => $request->form['numero_comidas'],
                                'daily_budget'      => $request->form['presupuesto_diario'],
                                'total_budget'      => $request->form['total_prespuesto'],
                                'naci_checks'       => (is_null($request->form['nacional_cheque']))? '0.00': $request->form['nacional_cheque'],
                                'naci_debit'        => (is_null($request->form['nacional_debito']))? '0.00': $request->form['nacional_debito'],
                                'naci_credit'       => (is_null($request->form['nacional_credito']))? '0.00': $request->form['nacional_credito'],
                                'naci_cash'         => (is_null($request->form['nacional_efectivo']))? '0.00': $request->form['nacional_efectivo'],
                                'naci_amex'         => (is_null($request->form['nacional_amex']))? '0.00': $request->form['nacional_amex']
                            ]);
            $foodD = FoodTag::where('id',$food->iden)->first();
            return response()->json($foodD);
        }else if($request->form['type_nacional'] == 1){
            $food = FoodTag::create([
                                    'request_id'        => $RequestId,
                                    'iden'              => $idenCom,
                                    'type_nationality'  => $request->form['type_nacional'],
                                    'number_foods'      => $request->form['numero_comidas'],
                                    'daily_budget'      => $request->form['presupuesto_diario'],
                                    'total_budget'      => $request->form['total_prespuesto'],
                                    'extra_checks'      => (is_null($request->form['extranjero_cheque']))? '0.00':$request->form['extranjero_cheque'],
                                    'extra_debit'       => (is_null($request->form['extranjero_debito']))? '0.00':$request->form['extranjero_debito'],
                                    'extra_credit'      => (is_null($request->form['extranjero_credito']))? '0.00':$request->form['extranjero_credito'],
                                    'extra_cash'        => (is_null($request->form['extranjero_efectivo']))? '0.00':$request->form['extranjero_efectivo'],
                                    'extra_amex'        => (is_null($request->form['extranjero_amex']))? '0.00':$request->form['extranjero_amex']
                                ]);
            $foodD = FoodTag::where('id',$food->iden)->first();
            return response()->json($foodD);
        }
    }
}
