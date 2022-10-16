<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;
use Livewire\WithPagination;

class TareaIndex extends Component
{
    use WithPagination;
    public $busqueda = '';
    public $paginacion = 10;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'busqueda' => ['except'=> ''],
        'paginacion' => ['except'=> 10],
    ];

    public function render()
    {
        $tareas = $this->consulta();
        $tareas = $tareas->paginate($this->paginacion);
        if($tareas->currentPage() > $tareas->lastPage())
        {
            $this->resetPage();
            $tareas = $this->consulta();
            $tareas = $tareas->paginate( $this->paginacion);
        }
        $params = [
            'tareas'=> $tareas,
        ];
        return view('livewire.tarea-index', $params);
    }
    private function consulta(){
        $query = Tarea::orderByDesc('id');
        if($this->busqueda != ''){
            $query->where('nombre','LIKE', '%'.$this->busqueda.'%');
        }
        return $query;
    }
}
