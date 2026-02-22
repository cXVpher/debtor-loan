<?php

namespace App\Livewire;

use App\Models\Debitur;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Livewire\Component;

class DebiturPayments extends Component
{
    public $tagihan;
    
    public $totaltagihan;
    
    public $riwayatPembayaran;

    public $debitur;

    public function mount($id) {
        $tagihan = Tagihan::with('debitur')->where('debitur_id',$id);
        $this->tagihan = $tagihan->get();
        $tagihan = $tagihan->where('parent_id',null)->get();
        $this->totaltagihan = number_format($tagihan->sum('jumlah'),0,',','.');
        $this->debitur = Debitur::where('id',$id)->first();

        $this->riwayatPembayaran = Pembayaran::join('tagihans','pembayarans.tagihan_id','=','tagihans.id')
        ->where('debitur_id',$id)
        ->select('pembayarans.*','tagihans.jumlah as jumlah_tagihan')
        ->get();
        
    }
    
    public function hapusTagihan($id) {
        $tagihan = Tagihan::find($id);
        $cicilanTagihan = Tagihan::where('parent_id',$id)->get();
        $cicilanTagihan->each->dataPembayaran()->each->delete();
        // $cicilanTagihan->each->delete();
        $tagihan->delete();
        return redirect()->route('debitur_detail',$tagihan->debitur_id);
    }

    public function render()
    {
        return view('livewire.debitur-payments');
    }
}
