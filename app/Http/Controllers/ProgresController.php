<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProgresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_admin = auth()->guard('admin')->user()->id_admin;

        $request->validate(
            [
                'ket_progres' => 'required'
            ],
            [
                'ket_progres.required' => 'Isi keterangan progres'
            ]
        );

        DB::table('progres_aspirasi')->insert(
            [
                'id_aspirasi' => $request->id_aspirasi,
                'id_admin' => $id_admin,
                'status' => $request->status,
                'tanggal_update' => now(),
                'ket_progres' => $request->ket_progres,
                'umpan_balik' => $request->umpan_balik
            ]
        );

        return redirect('Admin/DashboardAdmin')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
