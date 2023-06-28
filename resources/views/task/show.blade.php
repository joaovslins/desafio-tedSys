<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $task->title }}</h4>
                    <p>{{ $task->description }}</p>
                    <p><strong>Prioridade:</strong> {{ $task->priority }}</p>
                    <p><strong>Status:</strong> {{ $task->status }}</p>
                    <p><strong>Prazo:</strong> {{ $task->deadline }}</p>
                    <p><strong>Data de Criação:</strong> {{ $task->created_at }}</p>
                    <p><strong>Data de Atualização:</strong> {{ $task->updated_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>