<?php

namespace App\Http\Controllers;

#use App\Project;
#use App\SubProject;
#use App\Travel;
#use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\Apirest\MasterController;
use App\Http\Controllers\TravelWebController;
#use App\Http\Controllers\Apirest\ValidatePermissonController;


class SubProjectWebController extends MasterController
{
    
    private $_permits;
    private $_total_permisos;
    
    /*public function __construct( Request $request ){
        $http_usuario = $request->id_usuario;
        $http_token = $request->token;
        $this->_permits = self::permisson_validate( [ 'usuario' => $http_usuario,'token' => $http_token] );
        $this->_total_permisos = [21,19,45,44];
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        dd($request);
        if (in_array($this->_permits, $this->_total_permisos)) {
            
                $url = "http://34.225.245.91/api/travel/subproyectos?id_proyecto=".$request->id_proyecto;
                $proyecto = $this->sendGet( $url,false,$request->id_usuario,$request->token );
                $proyecto = json_decode( $proyecto );
                if (isset($proyecto->success) && $proyecto->success == true) {
                    return [ 'success' => $proyecto->success, 'result' => $proyecto->result ];
                }
                return $proyecto->error->description;
        }
        return false;


    }
    /**
     *Metodo para la creacion del arbol de subproyectos
     *@access public 
     *@param  array $tree [description ]
     *@return void
     */
    public function build_subproyectos( $data ){
            #$viajes = new TravelWebController();
            $url = "http://34.225.245.91/api/travel/subproyectos?id_proyecto=".$data->id;
            $subproyectos = $this->sendGet( $url, false, Session::get('user_id'), Session::get('token') );
            $subproyectos = json_decode( $subproyectos );
                if (isset($subproyectos->success) && $subproyectos->success == true) {
                    
                    return $subproyectos;

                    /*$tree = '';
                        foreach ($subproyectos->result as $result) {
                             $tree .= '<l1>';
                             $tree .= '<label class = "tree_label">';
                             $tree .= '<i class="fa fa-folder-open" aria-hidden="true"></i>';
                             $tree .= $result->nombre;
                             $tree .= '</label>';
                             $tree .= '<ul>';
                             $tree .= $viajes->build_tree_viajes($result);
                             $tree .= '</ul>';
                             $tree .= '</li>';
                        }
                    return $tree;*/
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

        /*
         * "id" => null
  "project_id" => "20"
  "nombre" => "ddddd"
  "descripcion" => "dddddddddddd"
  "activo" => "1"
         * */
        $data = [];
        $data += $request->all();
        $data['business_id'] = Session::get('business_id');
        $data['user_id'] = Session::get('user_id');

        $val =Validator::make($data,
            [
                'nombre'          => 'required|min:2|max:150|alpha_num_spaces|string_exist:sub_projects,name',
                'descripcion'   => 'required|min:2|max:150|alpha_num_spaces',
                'project_id'    => 'required|integer',
                'business_id'   => 'required',
                'user_id'       => 'required'
            ]);
        if($val->fails()){
            return  response()->json($val->errors());
        }

        SubProject::create([
            'name'          =>  $data['nombre'],
            'description'   =>  $data['descripcion'],
            'project_id'    =>  $data['project_id'],
            'business_id'   =>  $data['business_id'],
            'active'        =>  $data['activo'],
            'user_id'       =>  $data['user_id']
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subproject = SubProject::find($id);
        $dataUser = ServiciosController::getProfile($subproject->user_id);
        $array= [
            'subproject'    =>  $subproject,
            'project'       =>  $subproject->project,
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
