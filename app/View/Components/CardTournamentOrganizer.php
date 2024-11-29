<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardTournamentOrganizer extends Component
{
    public $organizer;
    /**
     * Create a new component instance.
     */
    public function __construct($organizer)
    {
        $this->organizer= $organizer;
    }
    /**
     * Get the view / contents that represent the component.
     */
    
    public function render(): View|Closure|string
    {
        return view('components.card-tournament-organizer', ['organizer' => $this->organizer]);
    }
}
