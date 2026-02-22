<?php

namespace App\Livewire;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Livewire\Component;

class PembayaranModal extends Component
{
    public $showModalState = false;

    public $tagihan_id = '';

    public $debitur_id = '';

    public $keterangan = '';

    public $metode = '';

    public $jumlah = '';

    public $tanggal = '';

    public function mount($tagihan_id, $debitur_id)
    {
        $this->tanggal = date('Y-m-d');
        $this->tagihan_id = $tagihan_id;
        $this->debitur_id = $debitur_id;
    }

    public function showModal()
    {
        $this->showModalState = true;
    }

    public function hideModal()
    {
        $this->showModalState = false;
    }

    public function bayar()
    {

        try {

            // Validate Form
            $form = $this->validate(
                [
                    'metode' => 'required',
                    'jumlah' => 'required|numeric',
                    'tanggal' => 'required|date',
                    'keterangan' => 'nullable'
                ]
            );

            $form['tagihan_id'] = $this->tagihan_id;

            $tagihan = Tagihan::find($this->tagihan_id);
            $parent = Tagihan::find($tagihan->parent_id);

            $form['keterangan'] = 'Pembayaran ' . $tagihan->keterangan. '. Tanggal: ' . date('Y-m-d',strtotime($tagihan->tanggal).'. Keterangan: '. $form['keterangan']);

            $status = Pembayaran::create($form);

            // Update Jumlah Tagihan if status true dengan mengurangi jumlah tagihan dengan jumlah pembayaran
            if ($status) {

                $parent->jumlah = $parent->jumlah - $form['jumlah'];
                $parent->jumlah = $parent->jumlah > 0 ? $parent->jumlah : 0;
                $parent->save();
                // dd(Carbon::parse($parent->tanggal)->format('Y-m-d'));

                $this->updateTagihan(date('Y-m-d', strtotime($parent->tanggal.'+1 month')), $parent->id, $form['jumlah']);

                return redirect()->to(route('debitur_detail', ['id' => $this->debitur_id]))->with('success', 'Pembayaran berhasil ditambahkan!');
            }else{
                $status->delete();
            }

            return redirect()->to(route('debitur_detail', ['id' => $this->debitur_id]))->with('fail', 'Pembayaran gagal!');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateTagihan($tanggal, $parent_id, $jumlah)
    {
        $tagihan = Tagihan::where('tanggal', $tanggal)->where('parent_id',$parent_id)->first();
        
        if(!$tagihan) {
            return;
        }
        
        $hasil = $tagihan->jumlah - $jumlah;
        $tagihan->jumlah = $hasil > 0 ? $hasil : 0;
        $tagihan->save();

        if ($hasil < 0) {
            return $this->updateTagihan(date('Y-m-d', strtotime($tanggal . ' +1 month')), $parent_id, $hasil * -1);
        }
        return $tagihan;
    }
    public function render()
    {
        return view('livewire.pembayaran-modal');
    }
}
