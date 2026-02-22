<div>
    {{-- Do your work, then step back. --}}
    <div>
        <!-- Modal -->
        <div x-data="{ open: false }">
            <button
            button class="p-2 px-4 bg-blue-800 text-sm text-white rounded-lg font-semibold"
            @click="open = !open"> +Tambah Debitur</button>
    
            @teleport('body')
                <div x-show="open" class="fixed start-0 top-0 z-40 w-full bg-gray-800/40 h-full flex justify-center items-center py-2">
                    <div class="w-2/3 flex-col items-center bg-gray-100 p-10 rounded-lg box-border">
                        <h2 class="font-bold text-3xl text-center mb-10">Tambah Debitur</h2>
                        <form class="w-2/3 m-auto" wire:submit="tambahDebitur">
                            <div class="flex flex-col justify-center">
                                <label for="nama" class="block mt-2 text-md font-medium leading-6">Nomor
                                    Debitur</label>
                                <div class="mt-1 mb-3">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600">
                                        <input 
                                            wire:model="nomor_debitur"
                                            type="text" name="nomor_debitur" id="nomor_debitur" autocomplete="nomor_debitur"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="ex. 12345">
                                    </div>
    
                                    <x-input-error :messages="$errors->get('nomor_debitur')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex flex-col justify-center">
                                <label for="nama" class="block mt-2 text-md font-medium leading-6">Nama
                                    Debitur</label>
                                <div class="mt-1 mb-3">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600">
                                        <input 
                                            wire:model="nama"
                                            type="text" name="nama" id="nama" autocomplete="nama"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="ex. Bagas">
                                    </div>
    
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex flex-col justify-center">
                                <label for="alamat" class="block mt-2 text-md font-medium leading-6">Alamat</label>
                                <div class="mt-1 mb-3">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600 ">
                                        <input 
                                            wire:model="alamat"
                                            type="text" name="alamat" id="alamat" autocomplete="alamat"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="ex. Jln. Adisucipto">
                                    </div>
    
                                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex flex-col justify-center">
                                <label for="nohp"
                                    class="block mt-2 text-md font-medium leading-6">Nomor HP</label>
                                <div class="mt-1 mb-6">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600 ">
                                        <input 
                                            wire:model="nohp"
                                            type="text" name="nohp" id="nohp" autocomplete="nohp"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-3 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="ex. +6289...">
                                    </div>
                                    <x-input-error :messages="$errors->get('nohp')" class="mt-2" />
    
                                </div>
                            </div>
                            <div class="w-2/3 flex justify-center m-auto gap-x-2 ">
                                <button @click="open = !open" class="bg-red-600/75 p-2 rounded-lg shadow-sm text-white">Kembali</button>
                                <button class="bg-green-600 p-2 rounded-lg text-white" type="submit">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endteleport
        </div>
    </div>
    
</div>
