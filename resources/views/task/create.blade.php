@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row"> 
      <div class="col-md-10">
        <h1>Adicionando Tarefa</h1> 
      </div>
      <div class="col-md-2">
        <a class="btn btn-success" href="{{ route('task.index') }}">Voltar</a>
      </div> 
    </div>
    <div class="">
        @include('task.form', ['created' => true])
    </div>

</div>




@endsection