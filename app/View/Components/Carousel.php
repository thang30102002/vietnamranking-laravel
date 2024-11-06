<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carousel extends Component
{
    /**
     * Create a new component instance.
     */
    public $data;
    public function __construct(
        $number,
        $img1,
        $title1,
        $info1,
        $img2,
        $title2,
        $info2,
        $img3,
        $title3,
        $info3
    ) {
        $this->data = [
            'number' => $number,
            'img1' => $img1,
            'title1' => $title1,
            'info1' => $info1,
            'img2' => $img2,
            'title2' => $title2,
            'info2' => $info2,
            'img3' => $img3,
            'title3' => $title3,
            'info3' => $info3,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.carousel', $this->data);
    }
}
