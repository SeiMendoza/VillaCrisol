<?php

namespace App\View\Components;

use App\Models\Tarea;
use Illuminate\View\Component;

class TareaFormBody extends Component
{
    private $tarea;
    /**
     * Create a new component instance.
     * @param \App\Models\Tarea $tarea
     * @return void
     */
    public function __construct($tarea = null)
    {
        if(is_null($tarea)){
            $tarea = Tarea::make([
                'perece' => 0
            ]);
        }
        $this->tarea = $tarea;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $params = [
            'tarea' => $this->tarea,
            'perece' => Tarea::PERECE,
        ];
        return view('components.tarea-form-body', $params);
    }
}
