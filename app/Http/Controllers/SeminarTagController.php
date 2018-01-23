<?php

namespace App\Http\Controllers;

use App\SeminarTag;
use Session;
use Illuminate\Http\Request;
use App\Label;

class SeminarTagController extends Controller
{
    public function create(Request $request){
        if(is_null($request->request_id)){
            $RequestId = Session::get('request_id');
        }else{
            $RequestId = $request->request_id;
        }
        $idenCom = sha1($RequestId.' '.date('h:i:s'));
        if($request->form['type_nacional'] == 0){
            try{
                $semi=SeminarTag::create([
                    'iden'              =>  $idenCom,
                    'request_id'        =>  $RequestId,
                    'type_nationality'  =>  $request->form['type_nacional'],
                    'name_event'        =>  $request->form['nombre_evento'],
                    'number_events'     =>  $request->form['numero_de_eventos'],
                    'authorized_amount' =>  $request->form['costo_por_evento'],
                    'total_amount'      =>  $request->form['total_costo'],
                    'naci_checks'       => (is_null($request->form['nacional_cheque']))? '0.00': $request->form['nacional_cheque'],
                    'naci_debit'        => (is_null($request->form['nacional_debito']))? '0.00': $request->form['nacional_debito'],
                    'naci_credit'       => (is_null($request->form['nacional_credito']))? '0.00': $request->form['nacional_credito'],
                    'naci_cash'         => (is_null($request->form['nacional_efectivo']))? '0.00': $request->form['nacional_efectivo'],
                    'naci_amex'         => (is_null($request->form['nacional_amex']))? '0.00': $request->form['nacional_amex']
                ]);
                $labelCorpo = sha1( $request->form['nombre_evento'].' - '.date('h:i:s'));
                Label::create([
                    'iden'                                  =>  $labelCorpo,
                    'name'                                  =>  $request->form['nombre_evento'],
                    'user_id'                               =>  Session::get('user_id'),
                    'business_id'                           =>  Session::get('business_id'),
                    'type_label'                            =>  'usuario'
                ]);
                $semiD = SeminarTag::where('id',$semi->iden)->first();
                return response()->json($semiD);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }elseif($request->form['type_nacional'] == 1){
            try{
                $semi=SeminarTag::create([
                    'iden'              =>  $idenCom,
                    'request_id'        =>  $RequestId,
                    'type_nationality'  =>  $request->form['type_nacional'],
                    'name_event'        =>  $request->form['nombre_evento'],
                    'number_events'     =>  $request->form['numero_de_eventos'],
                    'authorized_amount' =>  $request->form['costo_por_evento'],
                    'total_amount'      =>  $request->form['total_costo'],
                    'extra_checks'      => (is_null($request->form['extranjero_cheque']))? '0.00':$request->form['extranjero_cheque'],
                    'extra_debit'       => (is_null($request->form['extranjero_debito']))? '0.00':$request->form['extranjero_debito'],
                    'extra_credit'      => (is_null($request->form['extranjero_credito']))? '0.00':$request->form['extranjero_credito'],
                    'extra_cash'        => (is_null($request->form['extranjero_efectivo']))? '0.00':$request->form['extranjero_efectivo'],
                    'extra_amex'        => (is_null($request->form['extranjero_amex']))? '0.00':$request->form['extranjero_amex']
                ]);
                $labelCorpo = sha1( $request->form['nombre_evento'].' - '.date('h:i:s'));
                Label::create([
                    'iden'                                  =>  $labelCorpo,
                    'name'                                  =>  $request->form['nombre_evento'],
                    'user_id'                               =>  Session::get('user_id'),
                    'business_id'                           =>  Session::get('business_id'),
                    'type_label'                            =>  'usuario'
                ]);
                $semiD = SeminarTag::where('id',$semi->iden)->first();
                return response()->json($semiD);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        }
    }
}
