<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\Apirest\MasterController;

class TravelWebController extends MasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     *Metodo para la creacion del arbol de viajes por cada proyecto y subproyecto
     *@access public 
     *@param
     *@return 
     */
    public function build_tree_viajes($data){
        $usuario = Session::get('user_id'); 
        $token = Session::get('token');
        $url = "http://34.225.245.91/api/travel/viajes?id_proyecto=".$data->id_proyecto."&id_subproyecto=".$data->id_subproyecto;
        $viajes = $this->sendGet( $url, false, $usuario, $token );
        $viajes = json_decode( $viajes );
                if (isset($viajes->success) && $viajes->success == true) {
                    /*$tree = '';
                    foreach ($viajes->result as $result) {
                         $tree .= '<l1>';
                         $tree .= '<label class="tree_label">';
                         $tree .= '<i class="fa fa-folder-open" aria-hidden="true">';
                         $tree .= $result->nombre;
                         $tree .= '</li>';
                    }
                    return $tree;*/
                    return $viajes->result;
                }

                return false;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $data += $request->all();
        $data['business_id'] = Session::get('business_id');
        $data['user_id'] = Session::get('user_id');
        $rules = [
            'nombre'        =>  'required|min:2|max:150|alpha_num_spaces|string_exist:travels,name',
            'descripcion'   =>  'required|min:2|max:150|alpha_num_spaces',
            'project_id'    =>  'required|integer',
            'subproject_id' =>  'required|integer',
            'business_id'   =>  'required',
            'user_id'       =>  'required',
            'activo'        =>  'required',
        ];
        $shortName = $data['nombre_corto'];
        if(trim($shortName) == ''){
            $shortName =$data['nombre'];
        }else{
            $rules += ['nombre_corto'  =>  'min:2|max:150'];
        }
        $val =Validator::make($data,$rules);
        if($val->fails()){
            return  response()->json($val->errors());
        }

        $data = Travel::create([
            'name'          =>  $data['nombre'],
            'description'   =>  $data['descripcion'],
            'project_id'    =>  $data['project_id'],
            'sub_project_id'=>  $data['subproject_id'],
            'business_id'   =>  $data['business_id'],
            'user_id'       =>  $data['user_id'],
            'label'    =>  $shortName
        ]);
        return response()->json(['success' => true ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $travel = Travel::find($id);
        $dataUser = ServiciosController::getProfile($travel->user_id);
        $array= [
            'travel'        =>  $travel,
            'project'       =>  $travel->project,
            'subproject'    =>  $travel->subproject,
            'user'          =>  $dataUser
        ];
        return response()->json($array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
