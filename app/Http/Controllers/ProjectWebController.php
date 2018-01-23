<?php

namespace App\Http\Controllers;

use Log;
use Session;
use Validator;
use App\Project;
#use App\SubProject;
#use App\Travel;

use App\TblProyecto;
use App\TblSubProyecto;
use App\TblViaje;
use Illuminate\Http\Request;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TravelWebController;
use App\Http\Controllers\SubProjectWebController;
use App\Http\Controllers\Apirest\MasterController;

class ProjectWebController extends MasterController
{

    private $_permits;
    private $_total_permisos;
    
    public function __construct(){
        $this->_permits = self::permisson_validate();
        $this->_total_permisos = [21,19,45,44];
        if ( !in_array($this->_permits, $this->_total_permisos)) {
            return "No tiene permisos para ejecutar esta accion, por favor verificar sus previlegios";
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        if (in_array($this->_permits, $this->_total_permisos)) {
                $subproyecto = new SubProjectWebController();
                $viajes = new TravelWebController();
                $url = "http://34.225.245.91/api/travel/proyecto";
            #se utiliza este metodo para consumir el endpoint creado.
                $proyecto = $this->sendGet($url,false,$_SERVER['HTTP_USUARIO'],$_SERVER['HTTP_TOKEN']);
                $data = json_decode( $proyecto );

                /*if (isset($proyecto->success) && $proyecto->success == true) {
                    $proyectos = $proyecto->result;
                     $data = [
                        'data'                  => $this->build_tree( $proyectos ),
                        'titulo_principal'      => "PROYECTOS, SUBPROYECTOS Y VIAJE. ",
                        'usuario'               => Session::get('name'),
                        'avatar'                => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
                    ];
                    return view('process_bussines/project-main',$data);
                }

                return "SIN RESULTADOS";*/
                #$data = Project::orderBy('id', 'desc')->get();
               # $data = TblProyecto::all();
                $array= [];
                $i=0;
                    foreach ($data->result as $datos) {
                   # foreach ($data as $datos) {
                        $array[$i]['project']['id'] = $datos->id;
                        $array[$i]['project']['name'] = $datos->nombre;

                            #$dataSub = SubProject::where('project_id',$datos['id'])->get();
                            $dataSub = TblSubProyecto::where('id_proyecto',$datos->id)->get();
                            #$dataSub =  $subproyecto->build_subproyectos($datos);
                            $i2=0;
                            $array[$i]['subproject'] = [];
                            $array[$i]['travel'] = [];
                            foreach ($dataSub as $dats){
                                $array[$i]['subproject'][$i2]['id'] = $dats['id_subproyecto'];
                                $array[$i]['subproject'][$i2]['name'] = $dats['nombre'];
                                    #$travel = Travel::where('sub_project_id',$dats['id'])->get();
                                    $travel = TblViaje::where('id_subproyecto',$dats['id_subproyecto'])->get();
                                    #$travel = $viajes->build_tree_viajes( $dats );
                                        $i3=0;
                                        foreach($travel as $datr){
                                            $array[$i]['travel'][$i3]['id'] = $datr['id_viaje'];
                                            $array[$i]['travel'][$i3]['name'] = $datr['nombre'];
                                            $i3++;
                                        }
                                $i2++;
                            }
                        $i++;
                    }
                     $datos = [
                        'data'                  => $array,
                        'titulo_principal'      => "PROYECTOS, SUBPROYECTOS Y VIAJE. ",
                        'usuario'               => Session::get('name'),
                        'avatar'                => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
                    ];
                    #dd($datos);
                    return view('process_bussines/project-main',$datos);
               #return view('project',['data' => $array]);
        }

            return "No tiene permisos para realizar esta accion";


    }
    /**
     *Metodo donde contruye el menu del arbol de las listas dezplegables
     *@access public 
     *@param  $data  array [ description]
     *@return array [description]
     */
    public function build_tree( $data = array() ){
        $subproyecto = new SubProjectWebController();
        $proyectos = '';
        $proyectos .= '<ul class="tree" >';
        foreach ($data as $tree) {
            if (isset( $tree->proyecto )) {
                $proyectos .=  '<li>';
                $proyectos .=  '<label class="tree_label">';
                $proyectos .=  '<i class="fa fa-suitcase" aria-hidden="true"></i>';
                $proyectos .=  $tree->nombre;
                $proyectos .=  '</label>';
                $proyectos .=  '<ul>';
                $proyectos .=   $subproyecto->build_subproyectos($tree);
                $proyectos .=  '</ul>';
                $proyectos .=  '</li>';
            }
        }
        $proyectos .= '</ul>';
        return $proyectos;

    }
    /**
     *Metodo par obtener por medio del endpoint los datos particulares de un proyecto 
     *@access public 
     *@param 
     *@return void 
     */
    public function showById(){
        $id_proyecto = self::parser_string()['id_proyecto'];
        print_r($id_proyecto);exit();


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
        //dd(Session::all());
        //dd($request->all());
        $data = [];
        $data += $request->all();
        $data['business_id'] = Session::get('business_id');
        $data['user_id'] = Session::get('user_id');

        $val =Validator::make($data,
            [
                'nombre'          => 'required|min:2|max:150|alpha_num_spaces|string_exist:projects,name',
                'descripcion'   => 'required|min:2|max:150|alpha_num_spaces',
                'business_id'   => 'required',
                'user_id'       => 'required',
            ]);
        if($val->fails()){
            return  response()->json($val->errors());
        }

        $data= Project::create([
            'name'          => $data['nombre'],
            'description'   => $data['descripcion'],
            'business_id'   => $data['business_id'],
            'user_id'       => $data['user_id']
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
        echo "al diablo ";exit();
        $project = Project::find($id);
        $dataUser = ServiciosController::getProfile($project->user_id);

        $array= [
            'project' =>$project,
            'user'    =>$dataUser
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
