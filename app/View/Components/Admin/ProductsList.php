<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class ProductsList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $products;
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.products-list');
    }
}
