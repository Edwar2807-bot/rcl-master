@extends('layouts.admin')
@section('content')
<div class="row d-flex">

@foreach($parametros as $parametro)
 <div class="col-md-4">

 <div class="card ">
 	 <div class="card-body">
        <h4 class="card-title">{{$parametro->key}}</h4>

        @if($parametro->value != null )
                <div class="d-flex justify-content-center">

             <iframe src="https://viewer.millicast.com/v2?streamId={{$parametro->value}}"  width="400" height="300" ></iframe>

        </div>
        @endif
<hr>

 <form action="{{route('parameters.update',[$parametro->id])}}" method="POST">
 	<input name="_method" type="hidden" value="PUT">
                                                    @csrf
             <div class="input-group">
    <input type="text" class="form-control" value="{{$parametro->value}}" name="value" placeholder="Codigo streamId">
    <div class="input-group-append">
      <button class="btn btn-secondary" type="submit">
        <i class="fa fa-save"></i>
      </button>
    </div>
  </div>

 </form>


    </div>
   </div>

</div>

 @endforeach
</div>

@endsection
