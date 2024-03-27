<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Project1;
use DB;
use App\Appointment;
use Carbon\Carbon;
use App\Parameter;

class ProjectController extends Controller
{

    public function __construct()
    {

        $this->middleware(['auth']);

    }
    
    public function index(Request $request)
    {

        $ahora = Carbon::now();
        $fecha = $ahora->toDateString();
        $hora = $ahora->toTimeString();



        $showmotor = Appointment::where('proyecto',1)
                            ->where('user_id',$request->user()->id)
                            ->whereDate('start_time', $fecha)
                            ->whereDate('finish_time', $fecha)
                            ->whereTime('start_time', '<=', $hora)
                            ->whereTime('finish_time', '>=', $hora)
                            ->exists();

        $show2 = Appointment::where('proyecto',2)
                            ->where('user_id',$request->user()->id)
                            ->whereDate('start_time', $fecha)
                            ->whereDate('finish_time', $fecha)
                            ->whereTime('start_time', '<=', $hora)
                            ->whereTime('finish_time', '>=', $hora)
                            ->exists();
   
                            
        return view('projects.index',compact('showmotor','show2'));
    }


    public function show($project)
    {
        if ($project == 'project1') {
           return view('projects.codeProject1');
        }
    }

    public function apiproject1()
    {
      
    error_log("actualiza");  
    $project1 = Project1::OrderBy('id','desc')->get()->first(); 

    $dataSystem = DB::table('public.graph_p1')
                            ->where('project', $project1->id)
                            ->where('type', 0)->get();

    $data = [];  

    foreach ($dataSystem as $system) {

       $motor = DB::table('public.graph_p1')
                            ->where('project', $project1->id)
                            ->where('x', $system->x)
                            ->where('type', 1)->first();

        if ($motor != null) {
            $data[] = [
                'period' => $system->x,
                'System' => $system->y,
                'Motor' => $motor->y
            ];

        }else{
            
            break;     
        }                   
                
    }
    
    $response = new \stdClass();
    $response->graphData = $data;
    return response()->json($response)->header("Access-Control-Allow-Origin",  "*");



    }

    public function validarProject1(Request $request)
    {
          $ahora = Carbon::now();
        $fecha = $ahora->toDateString();
        $hora = $ahora->toTimeString();
           $showmotor = Appointment::where('proyecto',1)
                            ->where('user_id',$request->user()->id)
                            ->whereDate('start_time', $fecha)
                            ->whereDate('finish_time', $fecha)
                            ->whereTime('start_time', '<=', $hora)
                            ->whereTime('finish_time', '>=', $hora)
                            ->exists();
$v_motor = Appointment::where('proyecto',1)
                            ->where('user_id',$request->user()->id)
                            ->whereDate('start_time', $fecha)
                            ->whereDate('finish_time', $fecha)
                            ->whereTime('start_time', '<=', $hora)
                            ->whereTime('finish_time', '>=', $hora)
                            ->first();
        $camera1 = Parameter::where('key','CAMERA1')->first();
        if ($showmotor) {
            return view('projects.project1',compact('v_motor','camera1'));
        }

        return redirect ('/projects');
        
    }

    public function validarProject2(Request $request)
    {
        
        $ahora = Carbon::now();
        $fecha = $ahora->toDateString();
        $hora = $ahora->toTimeString();
           $showmotor = Appointment::where('proyecto',2)
                            ->where('user_id',$request->user()->id)
                            ->whereDate('start_time', $fecha)
                            ->whereDate('finish_time', $fecha)
                            ->whereTime('start_time', '<=', $hora)
                            ->whereTime('finish_time', '>=', $hora)
                            ->exists();
$v_motor = Appointment::where('proyecto',2)
                            ->where('user_id',$request->user()->id)
                            ->whereDate('start_time', $fecha)
                            ->whereDate('finish_time', $fecha)
                            ->whereTime('start_time', '<=', $hora)
                            ->whereTime('finish_time', '>=', $hora)
                            ->first();
        $camera1 = Parameter::where('key','CAMERA1')->first();
        if ($showmotor) {
            return view('projects.project2',compact('v_motor','camera1'));
        }

        return redirect ('/projects');
        
    }

    public function project1Download(Request $request,$idData)
    {
        
        return \Excel::create('Data', function($excel) use ($request) {

            $excel->sheet('Data', function($sheet) use ($request)
            {


            $sheet->cells('A1:C1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
            });

            //data
                $sheet->row(1, [
                    'X','SYSTEM','MOTOR'
                ]);

                $project1 = Project1::OrderBy('id','desc')->get()->first(); 

                $dataSystem = DB::table('public.graph_p1')
                            ->where('project', $project1->id)
                            ->where('type', 0)->get();


                $cont = 0;
                foreach ($dataSystem as $system) {

                   $motor = DB::table('public.graph_p1')
                                        ->where('project', $project1->id)
                                        ->where('x', $system->x)
                                        ->where('type', 1)->first();

                    if ($motor != null) {
                        
                         $sheet->row($cont+2, [$system->x,$system->y,$motor->y]);
                        $cont++;
                    }else{
                        
                        break;     
                    }                   
                            
                }

                $sheet->cell('E2', function($cell) use($project1) {
                $cell->setValue('T(s) Sampling');
                $cell->setFontWeight('bold');
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->cell('F2', function($cell) use($project1) {
                $cell->setValue('0.1');
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });


                $sheet->cell('E3', function($cell) use($project1) {
                $cell->setValue('T(s) Capture');
                $cell->setFontWeight('bold');
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->cell('F3', function($cell) use($project1) {
                $cell->setValue($project1->capture);
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->cell('E4', function($cell) use($project1) {
                $cell->setValue('RPM1');
                $cell->setFontWeight('bold');
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->cell('F4', function($cell) use($project1) {
                $cell->setValue($project1->rpm1);
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->cell('E5', function($cell) use($project1) {
                $cell->setValue('RPM2');
                $cell->setFontWeight('bold');
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->cell('F5', function($cell) use($project1) {
                $cell->setValue($project1->rpm2);
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->cell('E6', function($cell) use($project1) {
                $cell->setValue('RPM3');
                $cell->setFontWeight('bold');
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->cell('F6', function($cell) use($project1) {
                $cell->setValue($project1->rpm3);
                $cell->setAlignment('center');
                $cell->setAlignment('center');
                $cell->setBorder('thin','thin','thin','thin');
                });



            
            });
        })->download('xlsx');
    }

    public function camera1()
    {
        return view('projects.camera1');
    }

    public function redirectIndex()
    {
        return redirect ('/projects');
    }

    public function guiaSensorica(Request $request)
    {
        
    $file= public_path(). "/guia_sensorica.pdf";

    $headers = array(
              'Content-Type: application/pdf',
            );

    return \Response::download($file, 'Guia_de_Laboratorio_Remoto_Sensorica.pdf', $headers);
    }
  
}
