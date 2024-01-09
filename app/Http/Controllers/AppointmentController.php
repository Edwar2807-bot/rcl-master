<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\EmailAgenda;
use Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware(['docente'])->only(['destroy']);
        


    }


    public function index(Request $request)
    {
        $lab = 1;
        $appointments = null;
        $appointments = Appointment::where('proyecto',1)->get();
        /**if ($lab == null || $lab == 1) {
            $lab = 1;
            $appointments = Appointment::where('proyecto',1)->get();
        }else if ($lab == 2) {
            $appointments = Appointment::where('proyecto',2)->get();
        }else{
            $appointments = Appointment::where('proyecto',3)->get();
        }**/
        return view('appointments.index', compact('appointments','lab'));
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

  $diaAgenda = new Carbon($request->diaAgenda);
        $fin = new Carbon($request->diaAgenda);
        $fin->addMinutes(59);

        $fecha = $diaAgenda->toDateString();
        $hora = $diaAgenda->toTimeString();

        $existe = Appointment::where('proyecto',$request['laboratorio'])
                            ->whereDate('start_time', $fecha)
                            ->whereTime('start_time', $hora)
                            ->exists();


      if ($existe) {
          return redirect()->back()->with('error', 'El laboratorio no se encuentra disponible a las '.$diaAgenda.' a '.$fin);
      }
        $agenda = $request->user()->appointments()->create([
          'proyecto' => $request['laboratorio'],
          'start_time' => $diaAgenda,
          'finish_time' => $fin
        ]);

        // $infoMail = new \stdClass();
        // $infoMail->email = $request->user()->email;
        // $infoMail->usuario = $request->user()->usuario;
        // $infoMail->start_time = $agenda->start_time;

        // Mail::to('JADACUOR16@gmail.com')
        //             ->cc('juan.cuero@unillanos.edu.co')
        //                 ->send(new EmailAgenda($infoMail));

        return redirect()->back()->with('success', 'Se ha agendado correctamente a las '.$diaAgenda.' a '.$fin);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Se ha eliminado la reserva correctamente');
    }
}
