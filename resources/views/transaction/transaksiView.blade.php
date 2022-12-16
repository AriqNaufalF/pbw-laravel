@php
    $headers = ['No', 'Koleksi', 'Tanggal Pinjam', 'Tanggal selesai', 'Action'];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto relative">
                    <div>
                        <x-input-label for="peminjam" :value="__('Peminjam')" />

                        <x-text-input id="peminjam" class="block mt-1 w-full" type="text" :value="$transaksi->peminjam" readonly />
                    </div>
                    <div class="my-4">
                        <x-input-label for="petugas" :value="__('Petugas')" />

                        <x-text-input id="petugas" class="block mt-1 w-full" type="text" :value="$transaksi->petugas"
                            readonly />
                    </div>
                    <table class="table yajra-dt">
                        <thead>
                            <tr>
                                @foreach ($headers as $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('head')
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

        <script type="text/javascript">
            $(function() {
                var table = $('.yajra-dt').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('getAllDetailTransactions', $transaksi->id) }}",
                    columns: [{
                            data: 'id',
                            name: 'No'
                        },
                        {
                            data: 'koleksi',
                            name: 'Koleksi'
                        },
                        {
                            data: 'tanggalPinjam',
                            name: 'Tanggal Pinjam'
                        },
                        {
                            data: 'tanggalKembali',
                            name: 'Tanggal Selesai'
                        },
                        {
                            data: 'action',
                            name: 'Action'
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
