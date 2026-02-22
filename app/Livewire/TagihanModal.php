<?php

namespace App\Livewire;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class TagihanModal extends Component
{
    public $showModalState = false;

    public $debitur_id = '';

    public $keterangan = '';

    public $jumlah = '';

    public $cicilan = '';

    public $tanggal = '';

    public $dataPeminjam;

    public function mount($debitur_id)
    {
        $this->dataPeminjam = User::find($debitur_id);
        $this->tanggal = date('Y-m-d');
    }

    public function showModal()
    {
        $this->showModalState = true;
    }

    public function hideModal()
    {
        $this->showModalState = false;
    }

    public function buatTagihan()
    {

        try {
            // Validate Form
            // Validate Form
            $form = $this->validate(
                [
                    'jumlah' => 'required|numeric',
                    'tanggal' => 'required|date',
                    'cicilan' => 'required|numeric',
                    'keterangan' => 'nullable',
                    'debitur_id' => 'required|exists:users,id'
                ]
            );

            //Buat Parent Tagihan
            $parent = Tagihan::create($form);

            //buat variabel childrenTagihan yang sama seperti $form namun tanpa cicilan
            $childrenTagihan = array_diff_key($form, array_flip(['cicilan']));
            
            //menghitung jumlah pembayaran tiap cicilan
            $childrenTagihan['jumlah'] = $form['jumlah'] / $form['cicilan'];

            //buat array kosong untuk menampung tagihan
            $arrayCicilan = [];

            //looping sebanyak cicilan
            for ($i = 0; $i < $form['cicilan']; $i++) {
                $arrayCicilan[$i] = $childrenTagihan;
                $date = Carbon::parse($form['tanggal']);
                $date->addMonth($i+1);
                $arrayCicilan[$i]['tanggal'] = $date->format('Y-m-d');
                $arrayCicilan[$i]['parent_id'] = $parent->id;
                $arrayCicilan[$i]['keterangan'] = 'Cicilan untuk tagihan : '.$form['keterangan'];
                $arrayCicilan[$i]['created_at'] = Carbon::now();
                $arrayCicilan[$i]['updated_at'] = Carbon::now();
            }
            // dd($arrayCicilan);

            // Create Tagihan
            $status = Tagihan::insert($arrayCicilan);

            if ($status) {

                return redirect()->to(route('debitur_detail',['id'=>$this->debitur_id]))->with('success', 'Tagihan berhasil ditambahkan!');
            }

            return redirect()->to('')->with('fail', 'Tagihan gagal ditambahkan!');
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', 'Terjadi Kesalahan');
        }
    }

    public function render()
    {
        return view('livewire.tagihan-modal');
    }
}
