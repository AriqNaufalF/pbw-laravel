<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DetailTransactionController extends Controller
{
    public function getAllDetailTransactions($transactionId)
    {
        $detail_transactions = DB::table('detail_transactions as dt')
            ->select(
                'dt.id',
                'dt.tanggalKembali',
                't.tanggalPinjam',
                'dt.status as statusType',
                DB::raw('(case when dt.status="1" then "Pinjam"
                when dt.status="2" then "Kembali"
                when dt.status="3" then "Hilang" end) as status'),
                'c.namaKoleksi as koleksi'
            )
            ->join('collections as c', 'c.id', '=', 'dt.collectionId')
            ->join('transactions as t', 't.id', '=', 'dt.transactionId')
            ->where('dt.transactionId', '=', $transactionId)->get();

        return DataTables::of($detail_transactions)
            ->addColumn('action', function ($row) {
                $html = '';
                if ($row->statusType == "1") {
                    $html = '<a class="btn btn-primary" href="' . route('kembalikan', $row->id) . '">Edit</a>';
                }
                return $html;
            })->make(true);
    }

    public function detailTransactionKembalikan($detailTransactionId)
    {
        $detailTransaction = DB::table('detail_transactions as dt')
            ->select(
                'dt.id',
                't.id as idTransaksi',
                'dt.tanggalKembali',
                't.tanggalPinjam',
                'dt.status',
                'uPinjam.fullname as namaPeminjam',
                'uTugas.fullname as namaPetugas',
                'c.namaKoleksi as koleksi'
            )
            ->join('collections as c', 'c.id', '=', 'dt.collectionId')
            ->join('transactions as t', 't.id', '=', 'dt.transactionId')
            ->join('users as uPinjam', 't.userIdPeminjam', '=', 'uPinjam.id')
            ->join('users as uTugas', 't.userIdPetugas', '=', 'uTugas.id')
            ->where('dt.id', '=', $detailTransactionId)->first();

        return view('detailTransaction.kembalikan', compact('detailTransaction'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailTransaction $detailTransaction)
    {
        if ($request->status != 1) {
            $affected = DB::table('detail_transactions')
                ->where('id', $request->idDetailTransaksi)
                ->update([
                    'status' => $request->status,
                    'tanggalKembali' => Carbon::now()->toDateString()
                ]);

            if ($request->status == 2) {
                // kalau dikembalikan
                DB::table('collections')->increment('jumlahSisa');
                DB::table('collections')->decrement('jumlahKeluar');
            } else {
                // Kalau hilang
                DB::table('collections')->increment('jumlahSisa');
            }
        }

        $transaction = Transaction::find($request->idTransaksi)->get();

        return redirect('transaksiView/' . $request->idTransaksi)->with('transaction', $transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailTransaction $detailTransaction)
    {
        //
    }
}
