<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

	protected $fillable = [
        'proyecto', 'start_time', 'finish_time', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getProyectoAttribute($value)
	{
		$proyecto = "";
		if ($value == 1) {
			$proyecto = "Control e Identificación de Sistemas";
		}
		
	    return $proyecto;
	}
}
