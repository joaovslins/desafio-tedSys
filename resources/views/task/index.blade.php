@extends('layouts.app')

@section('content')

@if (session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
  <div class="row">
      <div class="col-md-10">
        <h1>Suas Tarefas</h1> 
      </div>
      <div class="col-md-2">
        <a class="btn btn-primary" href="{{ route('task.create') }}">Nova Tarefa</a>
      </div> 
  </div>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Título</th>
          <th scope="col">Descrição</th>
          <th scope="col">Prioridade</th>
          <th scope="col">Status</th>
          <th scope="col">Data Limite</th>
          <th scope="col">Criada em:</th>
          <th scope="col">Atualizada em:</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tasks as $task)
          <tr>
            <th> {{ $task->title }} </th>
            <td> {{ $task->description }} </td>
            <td> {{ $task->getPriorityAttributeAsText($task->priority) }} </td>
            <td> {{ $task->getStatusAttributeAsText($task->status) }} </td>
            <td> {{ $task->getDeadlineAttributeAsText($task->deadline) }} </td>
            <td> {{ $task->getCreatedAtAttributeAsText($task->created_at) }} </td>
            <td> {{ $task->getUpdatedAtAttributeAsText($task->updated_at) }} </td>
            <td> 
              <div>
                <!-- edit -->
                <a href="{{ route('task.edit', $task->id) }}">
                    <i class="fas fa-edit"></i>
                </a>

                <!-- delete -->
                <a href="{{ route('task.destroy', $task->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $task->id }}').submit();">
                  <i class="fas fa-trash-alt"></i>
                </a>
                <form id="delete-form-{{ $task->id }}" action="{{ route('task.destroy', $task->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <!-- view -->
                <a href="#" id="view" data-url="{{ route('task.show', $task->id) }}">
                  <i class="fas fa-eye" data-toggle="modal" data-target="#taskModal"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach  
      </tbody>
    </table>  
  </div> 
</div>

<div class="modal fade" id="modalDetalhes" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalhesLabel">Detalhes da Tarefa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
            <!-- conteúdo da modal -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="taskModal"> </div>

<script>

$(document).ready(function() {
        $('#view').click(function() {
            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    $('#modalContent').html(response);
                    $('#modalDetalhes').modal('show');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection