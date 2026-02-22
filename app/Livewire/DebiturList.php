<?php

namespace App\Livewire;

use App\Models\Debitur;
use App\Models\Pelunasan;
use Livewire\Component;

class DebiturList extends Component
{
    public $debiturs;

    public $masterDebiturs;

    public $detailId;

    public $search = "";

    public function mount() {
        $this->debiturs = Debitur::all();
        $this->masterDebiturs = $this->debiturs;
        // dd($this->debiturs);
    }

    public function showDetail($debiturId) {
        $this->detailId = $debiturId;

        // $this->dispatch('get-debitur-data', $debiturId)->to(DebiturPayments::class);
    }
    public function render()
    {
        $this->debiturs = $this->masterDebiturs;

        if($this->search != "") {
            $data = $this->debiturs->filter(function($item) {
                return stripos($item->nomor_debitur, $this->search) !== false;
            });

            $this->debiturs = $data;
        }

       return view('livewire.debitur-list');
    }   
}
