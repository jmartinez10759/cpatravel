<?php

namespace App\Http\Controllers;

use App\Request as Solicitude;
use App\Tool;
use Mockery\Exception;
use Session;
use Log;
use App\Country;
use App\Label;
use App\Http\Controllers\ServiciosController;
use App\Authorization;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create(Request $request){


        $requestCompuesto = $request->fecha_inicio.' '.$request->hora_salida.' '.date('h:i:s');
        $dataRequest = Solicitude::create([
                        'iden'                  =>  sha1($requestCompuesto),
                        'start_date'            =>  Tool::dateFormat($request->fecha_inicio),
                        'end_date'              =>  Tool::dateFormat($request->fecha_fin),
                        'departure_hour'        =>  $request->hora_salida,
                        'hour_return'           =>  $request->hora_final,
                        'initial_destination'   =>  $request->destino_inicial,
                        'initial_destination_id'=>  $request->id_destino_inicial,
                        'final_destination'     =>  $request->destino_final,
                        'final_destination_id'  =>  $request->id_destino_final,
                        'days'                  =>  $request->dias,
                        'project_id'            =>  $request->project_id,
                        'subproject_id'         =>  $request->subproject_id,
                        'travel_id'             =>  $request->travel_id,
                        'user_id'               =>  Session::get('user_id')
                    ]);
        $dataId = Solicitude::where('id',$dataRequest->iden)->first();
        $request->session()->flash('request_id', $dataId->iden);
        return ['success' => true, 'data' => $dataId];
    }

    public function update(Request $request){
        try{
            $total_amout = (is_null($request->total_solicitud_txt)) ? '0.00': $request->total_solicitud_txt ;
            $data = Solicitude::find($request->request_id);
            $data->user_id_authorize = $request->user_id_autorization;
            $data->status = 2;
            $data->total_amount = $total_amout;
            $data->naci_checks = (is_null($request->nacional_cheques_soli)) ? '0.00' :$request->nacional_cheques_soli ;
            $data->naci_debit = (is_null($request->nacional_debito_soli)) ?  '0.00' :$request->nacional_debito_soli ;
            $data->naci_credit = (is_null($request->nacional_credito_soli)) ? '0.00' :$request->nacional_credito_soli ;
            $data->naci_cash = (is_null($request->nacional_efectivo_soli)) ? '0.00' :$request->nacional_efectivo_soli ;
            $data->naci_amex = (is_null($request->nacional_amex_soli)) ?  '0.00' :$request->nacional_amex_soli;
            $data->extra_checks = (is_null($request->extranjero_cheques_soli)) ?  '0.00' :$request->extranjero_cheques_soli ;
            $data->extra_debit = (is_null($request->extranjero_debito_soli)) ? '0.00' :$request->extranjero_debito_soli;
            $data->extra_credi = (is_null($request->extranjero_credito_soli)) ? '0.00' :$request->extranjero_credito_soli ;
            $data->extra_cash = (is_null($request->extranjero_efectivo_soli)) ? '0.00' :$request->extranjero_efectivo_soli ;
            $data->extra_amex = (is_null($request->extranjero_amex_soli)) ?  '0.00' :$request->extranjero_amex_soli;
            $data->save();
            return response()->json(['succes' => true]);
        }catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function detail($iden){
        $solicitud = Solicitude::find($iden);
        //dd($solicitud->lodgingtag->id);
        $modeladoStage = ServiciosController::getStateBusiness($state = 1)->getData();
        $country = Country::orderBy('name','ASC')->get();
        $dataLabel = Label::all();
        $dataM = Country::where('name','México')->first();
        return view('solicitud.solicitud_travel_detail',compact('solicitud','modeladoStage','country','dataLabel','dataM'));
    }

    public function moneyAuthorization(Request $request){
            try{
                $dataRe = Solicitude::find($request->request_id);
                $dataRe->naci_checks_auto = $request->nacional_cheques_auto;
                $dataRe->naci_debit_auto = $request->nacional_debito_auto;
                $dataRe->naci_credit_auto = $request->nacional_credito_auto;
                $dataRe->naci_cash_auto = $request->nacional_efectivo_auto;
                $dataRe->naci_amex_auto = $request->nacional_amex_auto;
                $dataRe->extra_checks_auto = $request->extranjero_cheques_auto;
                $dataRe->extra_debit_auto = $request->extranjero_debito_auto;
                $dataRe->extra_credi_auto = $request->extranjero_credito_auto;
                $dataRe->extra_cash_auto = $request->extranjero_efectivo_auto;
                $dataRe->extra_amex_auto = $request->extranjero_amex_auto;
                $dataRe->save();

                $idCom = sha1($request->request_id.' - '.date('h:i:s'));
                Authorization::create([
                    'iden'          =>  $idCom,
                    'request_id'    =>  $request->request_id,
                    'user_id'       =>  Session::get('user_id'),
                ]);
                return response()->json(['success' => true]);
            }catch (\Exception $e){
                dd($e->getMessage());
            }
    }


}
