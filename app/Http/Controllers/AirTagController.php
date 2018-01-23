<?php

namespace App\Http\Controllers;
use App\AirTag;
use GuzzleHttp\Psr7\Response;
use Session;
use App\Tool;
use Illuminate\Http\Request;

class AirTagController extends Controller
{
    public function create(Request $request){
        if(is_null($request->request_id)){
            $RequestId = Session::get('request_id');
        }else{
            $RequestId = $request->request_id;
        }
        $idenCom = sha1($RequestId.' '.date('h:i:s'));
        if($request->form['type_nacional'] == 0){

            $air = AirTag::create([
                                'iden'              =>  $idenCom,
                                'request_id'        =>  $RequestId,
                                'type_nationality'  =>  $request->form['type_nacional'],
                                'place_origin'      =>  $request->form['ciudad_origen'],
                                'place_destination' =>  $request->form['ciudad_destino'],
                                'total_amount'      =>  $request->form['presupuesto'],
                                'start_date'        =>  Tool::dateFormat($request->form['fecha_salida']),
                                'end_date'          =>  Tool::dateFormat($request->form['fecha_llegada']),
                                'naci_checks'       =>  (is_null($request->form['nacional_cheque']))? '0.00':   $request->form['nacional_cheque'],
                                'naci_debit'        =>  (is_null($request->form['nacional_debito']))? '0.00':   $request->form['nacional_debito'],
                                'naci_credit'       =>  (is_null($request->form['nacional_credito']))? '0.00':  $request->form['nacional_credito'],
                                'naci_cash'         =>  (is_null($request->form['nacional_efectivo']))? '0.00': $request->form['nacional_efectivo'],
                                'naci_amex'         =>  (is_null($request->form['nacional_amex']))? '0.00': $request->form['nacional_amex']
                            ]);
                $airD = AirTag::where('id',$air->iden)->first();
                return response()->json($airD);
        }elseif($request->form['type_nacional'] == 1){
            $air = AirTag::create([
                                'iden'              =>  $idenCom,
                                'request_id'        =>  $RequestId,
                                'type_nationality'  =>  $request->form['type_nacional'],
                                'place_origin'      =>  $request->form['ciudad_origen'],
                                'place_destination' =>  $request->form['ciudad_destino'],
                                'total_amount'      =>  $request->form['presupuesto'],
                                'start_date'        =>  Tool::dateFormat($request->form['fecha_salida']),
                                'end_date'          =>  Tool::dateFormat($request->form['fecha_llegada']),
                                'extra_checks'      =>  (is_null($request->form['extranjero_cheque']))? '0.00': $request->form['extranjero_cheque'],
                                'extra_debit'       =>  (is_null($request->form['extranjero_debito']))? '0.00': $request->form['extranjero_debito'],
                                'extra_credi'       =>  (is_null($request->form['extranjero_credito']))? '0.00': $request->form['extranjero_credito'],
                                'extra_cash'        =>  (is_null($request->form['extranjero_efectivo']))? '0.00':   $request->form['extranjero_efectivo'],
                                'extra_amex'        =>  (is_null($request->form['extranjero_amex']))? '0.00':   $request->form['extranjero_amex']
                            ]);
                $airD = AirTag::where('id',$air->iden)->first();
                return response()->json($airD);
        }
    }
}
