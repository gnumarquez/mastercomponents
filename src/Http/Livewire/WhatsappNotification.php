<?php

namespace Gnumarquez\Http\Livewire;

use Livewire\Component;
use App\Models\WhatsappModel;

class WhatsappNotification extends Component
{
    public $notifications = [];
    public $quantity = 0;

    protected $listeners = ['echo:whatsapp,.message'=>'$refresh'];

    public function render()
    {
        $this->notifications = WhatsappModel::select('whatsapp.*','c.id as c_id','c.nombre')->join('clients as c','c.whatsapp','whatsapp.telf')->whereReaded(0)->whereStatus(1)->orderBy('id','desc')->get();
        $this->quantity = WhatsappModel::select('whatsapp.*','c.id as c_id','c.nombre')->join('clients as c','c.whatsapp','whatsapp.telf')->whereReaded(0)->whereStatus(1)->count();

        return view("mastercomponents::livewire.whatsapp-notification");
    }
}
