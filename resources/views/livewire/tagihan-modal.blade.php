<div>
    {{-- Do your work, then step back. --}}
    <div>
        <!-- Modal -->
        <div x-data="{ open: false }">
            <button
            class="p-2 bg-blue-800 rounded-md text-sm text-white font-semibold"
            @click="open = !open"> + Buat Tagihan</button>
    
            @teleport('body')
                <div x-show="open" class="fixed start-0 top-0 z-40 w-full bg-gray-800/40 h-full flex justify-center items-center py-2">
                    <div class=" w-2/3 flex-col items-center bg-gray-100 p-10 rounded-lg box-border">
                        <h2 class="font-bold text-3xl text-center mb-10">Tagihan</h2>
                        <div class="w-2/3 m-auto">
                            <input type="hidden" value="{{ $debitur_id }}" wire:model="debitur_id">
                            <div class="flex flex-col justify-center">
                                <label for="jumlah" class="block mt-2 text-md font-medium leading-6 ">Jumlah
                                    Tagihan</label>
                                <div class="mt-1 mb-3">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600">
                                        <input 
                                            wire:model="jumlah"
                                            type="text" name="jumlah" id="jumlah" autocomplete="jumlah"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3  placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="ex. 200000">
                                    </div>
    
                                    <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex flex-col justify-center">
                                <label for="keterangan" class="block mt-2 text-md font-medium leading-6 ">Keterangan</label>
                                <div class="mt-1 mb-3">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600 ">
                                        <input 
                                            wire:model="keterangan"
                                            type="text" name="keterangan" id="keterangan" autocomplete="keterangan"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3  placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="ex. Pembayaran peminjaman">
                                    </div>
    
                                    <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex flex-col justify-center">
                                <label for="cicilan" class="block mt-2 text-md font-medium leading-6 ">Jumlah Perulangan Cicilan</label>
                                <div class="mt-1 mb-3">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600 ">
                                        <input 
                                            wire:model="cicilan"
                                            type="number" name="cicilan" id="cicilan" autocomplete="cicilan"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3  placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="ex. 12">
                                    </div>
    
                                    <x-input-error :messages="$errors->get('cicilan')" class="mt-2" />
                                </div>
                            </div>
                            
                            <div class="flex flex-col justify-center">
                                <label for="tanggal"
                                    class="block mt-2 text-md font-medium leading-6">Tanggal</label>
                                <div class="mt-1 mb-6">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600 ">
                                        <input 
                                            wire:model="tanggal"
                                            type="date" name="tanggal" id="tanggal" autocomplete="tanggal"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Tanggal Pembayaran">
                                    </div>
                                    <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
    
                                </div>
                            </div>
                            <div class="w-2/3 flex justify-center m-auto gap-x-2 ">
                                <button @click="open = !open" class="bg-red-600/75 p-2 rounded-lg shadow-sm text-white">Kembali</button>
                                <button class="bg-green-600 p-2 rounded-lg text-white" wire:click="buatTagihan">Konfirmasi</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endteleport
        </div>
    </div>
    
</div>
