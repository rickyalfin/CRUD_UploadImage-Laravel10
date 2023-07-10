<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hewan = Hewan::orderBy('id', 'desc')->get();

        return view('hewan.index', compact('hewan'));
    }

    public function data()
    {
        $hewan = Hewan::orderBy('id', 'desc')->get();

        return datatables()
            ->of($hewan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($hewan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('hewan.update', $hewan->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>
                    <button onclick="deleteData(`' . route('hewan.destroy', $hewan->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hewan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hewan = new Hewan();
        $hewan->nama_hewan = $request->nama_hewan;
        $hewan->deskripsi_hewan = $request->deskripsi_hewan;

        // Menyimpan file gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama_hewan) . '.' . $extension;
            $filePath = $file->storeAs('public/images', $filename);
            $hewan->image = Storage::url($filePath);
        }

        $hewan->save();

        return redirect()->route('hewan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hewan = Hewan::find($id);

        return response()->json($hewan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hewan = Hewan::find($id);

        return view('hewan.edit', compact('hewan'));
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
        $hewan = Hewan::find($id);
        $hewan->nama_hewan = $request->nama_hewan;
        $hewan->deskripsi_hewan = $request->deskripsi_hewan;

        // Update image
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($hewan->image) {
                Storage::delete('public/images/' . $hewan->image);
            }

            // Mendapatkan file yang diupload
            $file = $request->file('image');

            // Mendapatkan ekstensi file
            $extension = $file->getClientOriginalExtension();

            // Membuat nama file baru dengan format "namafile_timestamp.extension"
            $filename = $hewan->nama_hewan . '_' . time() . '.' . $extension;

            // Menyimpan file dengan nama baru
            $imagePath = $file->storeAs('public/images', $filename);

            // Menyimpan nama file baru ke dalam model hewan
            $hewan->image = $filename;

        }

        $hewan->save();

        return redirect()->route('hewan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hewan = Hewan::find($id);

        // Menghapus gambar jika ada
        if ($hewan->image) {
            Storage::delete('public/images/' . $hewan->image);
        }

        $hewan->delete();

        return response(null, 204);
    }
}
