<div>
    {{-- {{ dd($riwayatPembayaran) }} --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Tagihan Debitur') }}
            </h2>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Success</span> {{ session('success') }}
        </div>
    @elseif (session()->has('fail'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Fail</span> {{ session('fail') }}
        </div>
    @endif

    <div class="mt-4">
        <div class="max-w-7xl mx-auto max-h-7xl">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 px-8 text-gray-900 dark:text-gray-100">
                    <div class="p-3 text-2xl font-bold flex justify-between">
                        <h2>{{ $debitur->nama }}</h2>
                        <livewire:tagihan-modal :debitur_id="$debitur->id" />
                    </div>
                    <div class="p-4">Jumlah Tagihan : Rp {{ $totaltagihan }}</div>
                    <div class="flex justify-center ">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="row" class="px-6 py-3 text-center">
                                        No
                                    </th>
                                    <th scope="row" class="px-6 py-3 text-center">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Jumlah (Rupiah)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Keterangan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            @forelse ($tagihan as $payment)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    wire:key="{{ $payment->id }}">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ $payment->tanggal->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span>{{ number_format($payment->jumlah, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <p>{{ $payment->keterangan ??= 'Tidak ada keterangan' }} </p>
                                    </td>
                                    <td class="px-6 py-4 text-center">

                                        @if ($payment->jumlah == 0)
                                            <p class="text-green-600 bg-green-100 rounded-xl text-center font-bold">
                                                Lunas
                                            </p>
                                        @else
                                            <p class="text-yellow-600 bg-yellow-100 rounded-xl text-center font-bold">
                                                Belum Lunas</p>
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 flex gap-1 justify-center">
                                        @if ($payment->jumlah != 0 && $payment->parent_id != null)
                                            <livewire:pembayaran-modal :tagihan_id="$payment->id" :debitur_id="$debitur->id"
                                                :key="Str::random(20)" />
                                        @endif
                                        @if ($payment->parent_id == null)
                                            <button
                                                wire:confirm.prompt="Apakah anda yakin ingin menghapus tagihan ini?|YA|TIDAK"
                                                wire:click="hapusTagihan({{ $payment->id }})"
                                                class="p-2 bg-red-800 rounded-md text-white"> Hapus </button>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        No Data
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                    <div class="mt-4 p-3 text-lg font-bold">
                        Riwayat Pembayaran
                    </div>

                    <div class="mb-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="row" class="px-6 py-3 text-center">
                                        No
                                    </th>
                                    <th scope="row" class="px-6 py-3 text-center">
                                        Tanggal
                                    </th>
                                    <th scope="row" class="px-6 py-3 text-center">
                                        Jumlah (Rupiah)
                                    </th>
                                    <th scope="row" class="px-6 py-3 text-center">
                                        Keterangan
                                    </th>

                                </tr>
                            </thead>
                            @forelse ($riwayatPembayaran as $pembayaran)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    wire:key="{{ $pembayaran->id }}">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $pembayaran->tanggal->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span>{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <p>{{ $pembayaran->keterangan ?? 'Tidak ada keterangan' }} </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        No Data
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                    <a wire:navigate href="{{ route('debiturs') }}"
                        class="p-2 px-4 mb-4 bg-red-800 text-md text-white rounded-lg float-right">
                        kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
