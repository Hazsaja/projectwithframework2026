<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight">
            Struk Transaksi
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-md mx-auto px-4 sm:px-6">
            
            {{-- Card Struk (Background Putih, Border Halus, Shadow Modern) --}}
            <div id="receipt" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 text-gray-800">
                
                {{-- Header Toko & Invoice --}}
                <div class="text-center border-b border-dashed border-gray-200 pb-4 mb-4">
                    <h3 class="font-bold text-xl text-gray-900 tracking-tight">POS Barokah Mart</h3>
                    <p class="text-xs font-mono font-medium text-indigo-600 mt-1">
                        {{ $transaction->invoice_number }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $transaction->created_at->format('d M Y H:i') }} &bull; Kasir: <span class="font-medium text-gray-700">{{ $transaction->user->name }}</span>
                    </p>
                </div>

                {{-- Detail Item Belanja --}}
                <div class="space-y-3 mb-4">
                    @foreach ($transaction->details as $detail)
                        <div class="flex justify-between items-start text-sm">
                            <div class="flex-1 pr-2">
                                <p class="font-medium text-gray-800">{{ $detail->product->name }}</p>
                                <p class="text-xs text-gray-400">
                                    {{ $detail->qty }} x Rp{{ number_format($detail->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <span class="font-semibold text-gray-900 font-mono text-xs">
                                Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- Ringkasan Pembayaran --}}
                <div class="border-t border-dashed border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between items-center text-base font-bold text-gray-900">
                        <span>Total</span>
                        <span class="font-mono text-lg text-indigo-600">Rp{{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs text-gray-600">
                        <span>Bayar</span>
                        <span class="font-mono font-medium">Rp{{ number_format($transaction->pay, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs text-gray-600">
                        <span>Kembali</span>
                        <span class="font-mono font-medium text-emerald-600">Rp{{ number_format($transaction->change, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Pesan Penutup Struk --}}
                <div class="text-center mt-6 pt-4 border-t border-gray-100">
                    <p class="text-xs text-gray-400">Terima kasih telah berbelanja!</p>
                </div>

            </div>

            {{-- Tombol Aksi (Disembunyikan saat dicetak) --}}
            <div class="mt-6 flex flex-col sm:flex-row gap-3 print:hidden">
                <button onclick="window.print()" class="w-full inline-flex justify-center items-center py-2.5 px-4 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-semibold text-sm rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Cetak Struk
                </button>

                <a href="{{ route('pos.index') }}" class="w-full inline-flex justify-center items-center py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                    Transaksi Baru
                </a>
            </div>

        </div>
    </div>

    {{-- Style Tambahan Khusus untuk Cetak Thermal / Kertas --}}
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #receipt, #receipt * {
                visibility: visible;
            }
            #receipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
        }
    </style>
</x-app-layout>