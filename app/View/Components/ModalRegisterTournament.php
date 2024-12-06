<?php

namespace App\View\Components;

use App\Models\Tournament;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalRegisterTournament extends Component
{
    /**
     * Create a new component instance.
     */
    public $tournament;
    public function __construct($tournamentid)
    {
        $this->tournament = Tournament::find($tournamentid);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-register-tournament', ['tournamentid' => $this->tournament]);
    }
}
