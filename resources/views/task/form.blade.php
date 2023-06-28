<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <!-- componente de data css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>
<body>
<body>
    <div class="card pt-4 pb-4 pe-4 ps-4">
        @if($created == true)
            <form action="{{ route('task.save') }}" method="POST">
        @else    
            <form action="{{ route('task.update', ['id' => $task->id]) }}" method="POST">
            @method('PUT') 
        @endif

        @csrf
            <div class="row">
                <!-- Title input -->
                <div class="form-outline mb-4 col-md-6">
                    <label class="form-label" for="title">Título</label>
                    <input type="text" id="title" class="form-control" name="title" @if($created == false) value="{{$task->title}}" @endif />
                </div>

                <!-- Description input -->
                <div class="form-outline mb-4 col-md-6">
                    <label class="form-label" for="description">Descrição</label>
                    <input type="text" id="description" class="form-control" name="description" @if($created == false) value="{{$task->description}}" @endif/>
                </div>
            </div>

            <div class="row">
                <!-- priority input -->
                <div class="form-outline mb-4 col-md-6">
                    <label class="form-label" for="priority">Prioridade</label>
                    <select id="priority" class="form-control" name="priority">
                        <option value="">Selecione uma opção</option>
                        @if($created == false)
                            <option value="{{$task->priority}}" selected>{{ $task->getPriorityAttributeAsText($task->priority) }}</option>
                        @endif
                    </select>
                </div>

                <!-- status input -->
                <div class="form-outline mb-4 col-md-6">
                    <label class="form-label" for="status">Status</label>
                    <select id="status" class="form-control" name="status">
                        <option value="">Selecione uma opção</option>
                        @if($created == false)
                            <option value="{{ $task->status }}" selected>{{ $task->getStatusAttributeAsText($task->status) }}</option>
                        @endif
                    </select>
                </div>

                <!-- deadline input -->
                <div class="form-outline mb-4 col-md-12">
                    <label for="data">Data Limite</label>
                    <div>
                        <input type="text" class="form-control datepicker" id="deadline" name="deadline" placeholder="dd/mm/yyyy" required @if($created == false) value="{{ $task->getDeadlineAttributeAsText($task->deadline) }}" @endif>
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Salvar</button>
        </form>
    </div>
</body>
    <!-- componente de data js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });

        $(document).ready(function() {
            $('#status').each(function() {
                var campoSelect = $(this);
                var url = '{{ route("task.listStatus") }}';

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        campoSelect.append('<option value="">Selecione uma opção</option>');

                        $.each(response, function(index, item) {
                            campoSelect.append('<option value="' + item.value + '">' + item.text + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#priority').each(function() {
                var campoSelect = $(this);
                var url = '{{ route("task.listPriority") }}';

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        campoSelect.append('<option value="">Selecione uma opção</option>');

                        $.each(response, function(index, item) {
                            campoSelect.append('<option value="' + item.value + '">' + item.text + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</html>