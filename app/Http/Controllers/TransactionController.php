<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction.daftarTransaksi');
    }

    public function getAllTransactions()
    {
        $transaction = DB::table('transactions')->select(
            'transactions.id as id',
            'u1.fullname as peminjam',
            'u2.fullname as petugas',
            'tanggalPinjam',
            'tanggalSelesai'
        )
            ->join('users as u1', 'userIdPeminjam', '=', 'u1.id')
            ->join('users as u2', 'userIdPetugas', '=', 'u2.id')
            ->orderBy('tanggalPinjam', 'asc')
            ->get();

        return DataTables::of($transaction)
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('transaksiView', $row->id) . '" class="edit btn btn-primary">Edit</a>';
                return $btn;
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        $collections = Collection::where('jumlahSisa', '>', 0)->get();
        return view('transaction.transaksiTambah', compact('users', 'collections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'idPeminjam' => 'required|numeric|gt:0',
            'koleksi1' => 'required|numeric|gt:0'
        ], [
            'idPeminjam.gt' => 'Pilih satu makhluk',
            'koleksi1.gt' => 'Pilih jenis Item'
        ]);

        $transaction = new Transaction();
        $transaction->userIdPeminjam = $request->idPeminjam;
        $transaction->userIdPetugas = auth()->user()->id;
        $transaction->tanggalPinjam = Carbon::now()->toDateString();
        $transaction->save();
        // Mengambil id transaksi terbaru
        $lastTransactionId = $transaction->id;

        $detilTransaksi1 = new DetailTransaction();
        $detilTransaksi1->transactionId = $lastTransactionId;
        $detilTransaksi1->collectionId = $request->koleksi1;
        $detilTransaksi1->status = 1;
        $detilTransaksi1->save();
        // Mengurangi jumlah stok
        DB::table('collections')->where('id', $request->koleksi1)->decrement('jumlahSisa');
        DB::table('collections')->where('id', $request->koleksi1)->increment('jumlahKeluar');

        if ($request->koleksi2 > 0) {
            $detilTransaksi2 = new DetailTransaction();
            $detilTransaksi2->transactionId = $lastTransactionId;
            $detilTransaksi2->collectionId = $request->koleksi2;
            $detilTransaksi2->status = 1;
            $detilTransaksi2->save();
            // Mengurangi jumlah stok
            DB::table('collections')->where('id', $request->koleksi2)->decrement('jumlahSisa');
            DB::table('collections')->where('id', $request->koleksi2)->increment('jumlahKeluar');
        }

        if ($request->koleksi3 > 0) {
            $detilTransaksi3 = new DetailTransaction();
            $detilTransaksi3->transactionId = $lastTransactionId;
            $detilTransaksi3->collectionId = $request->koleksi3;
            $detilTransaksi3->status = 1;
            $detilTransaksi3->save();
            // Mengurangi jumlah stok
            DB::table('collections')->where('id', $request->koleksi3)->decrement('jumlahSisa');
            DB::table('collections')->where('id', $request->koleksi3)->increment('jumlahKeluar');
        }

        return redirect()->route('transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaksi = DB::table('transactions')->select(
            'transactions.id as id',
            'u1.fullname as peminjam',
            'u2.fullname as petugas',
            'tanggalPinjam',
            'tanggalSelesai'
        )
            ->join('users as u1', 'userIdPeminjam', '=', 'u1.id')
            ->join('users as u2', 'userIdPetugas', '=', 'u2.id')
            ->where('transactions.id', '=', $transaction->id)
            ->orderBy('tanggalPinjam', 'asc')
            ->first();
        return view('transaction.transaksiView', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
