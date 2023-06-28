<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //attr model
    protected $fillable = [
        'id',
        'title',	
        'description',	
        'priority',	
        'status',	
        'deadline',	
        'created_at',	
        'updated_at'
    ];


    //as text attr
    public function getStatusAttributeAsText($value)
    {
        $statusText = '';

        switch ($value) {
            case 1:
                $statusText = 'Pendente';
                break;
            case 2:
                $statusText = 'Em andamento';
                break;
            case 3:
                $statusText = 'Concluído';
                break;
            }

        return $statusText;
    }

    public function getPriorityAttributeAsText($value)
    {
        $priorityText = '';

        switch ($value) {
            case 1:
                $priorityText = 'Baixo';
                break;
            case 2:
                $priorityText = 'Médio';
                break;
            case 3:
                $priorityText = 'Alto';
                break;
            }
     
        return $priorityText;
    }

    //date formatter BR
    public function getDeadlineAttributeAsText($value){
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getCreatedAtAttributeAsText($value){
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttributeAsText($value){
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }
    
    
}
