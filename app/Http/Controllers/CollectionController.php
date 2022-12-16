<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Collection::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('jenisKoleksi', function ($collection) {
                    $jenisCollections = ['', 'Buku', 'Majalah', 'Cakram'];
                    return $jenisCollections[$collection->jenisKoleksi];
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('koleksiView', $row->id) . '" class="edit btn btn-primary">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('koleksi.daftarKoleksi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('koleksi.registrasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaKoleksi' => 'required|string|max:100',
            'jenisKoleksi' => 'required|numeric',
            'jumlahKoleksi' => 'required|numeric'
        ]);

        Collection::create($validated);
        return redirect('/koleksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        return view('koleksi.infoKoleksi', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenisKoleksi' => 'required|numeric',
            'jumlahSisa' => 'required|numeric',
            'jumlahKeluar' => 'required|numeric',
        ]);

        Collection::find($id)->update($validated);

        return redirect('/koleksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
