<?php

namespace App\Livewire;

use Livewire\Component;

class DebiturModal extends Component
{
    public $nama;
    public $alamat;
    public $nohp;
    public $nomor_debitur;


    public function tambahDebitur()
    {
        $this->validate([
            'nama' => 'required',
            'nomor_debitur' => 'required',
            'alamat' => 'required',
            'nohp' => 'required'
        ]);

        $debitur = new \App\Models\Debitur;
        $debitur->nama = $this->nama;
        $debitur->alamat = $this->alamat;
        $debitur->nohp = $this->nohp;
        $debitur->nomor_debitur = $this->nomor_debitur;
        $debitur->save();

        $this->reset('nama', 'alamat', 'nohp', 'nomor_debitur');

        session()->flash('message', 'Debitur Berhasil Ditambahkan!');
        $this->redirect(route('debiturs'));
    }

    public function render()
    {
        return view('livewire.debitur-modal');
    }
}
