<?php

namespace App\Livewire;

use App\Models\Tagihan;
use Livewire\Component;

class Dashboard extends Component
{
    public $total_tagihan = 0;
    public $tagihan_terdekat = [];

    public function mount()
    {
        $this->total_tagihan = Tagihan::where('jumlah','>',0)->count();
        $this->tagihan_terdekat = Tagihan::where('jumlah','>',0)->where('parent_id','!=',NULL)->with('debitur')->orderBy('tanggal','asc')->first();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
