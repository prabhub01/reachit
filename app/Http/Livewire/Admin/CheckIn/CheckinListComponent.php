<?php

namespace App\Http\Livewire\Admin\CheckIn;

use Livewire\Component;

class CheckinListComponent extends Component
{

    public $data;
    
    public function render()
    {

        $data=[];
        return view('livewire.admin.check-in.checkin-list-component', $data);
    }
}