<?php

namespace App\Http\Controllers;

use App\Models\DataCustomer;
use Illuminate\Http\Request;

class DataCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('datacustomer.index');
    }

    public function data()
    {
        $datacustomer = DataCustomer::orderBy('id', 'desc')->get();

        return datatables()
            ->of($datacustomer)
            ->addIndexColumn()
            ->addColumn('aksi', function ($datacustomer) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('datacustomer.update', $datacustomer->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>
                    <button onclick="deleteData(`' . route('datacustomer.destroy', $datacustomer->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datacustomer = new DataCustomer();
        $datacustomer->nama = $request->nama;
        $datacustomer->alamat = $request->alamat;
        $datacustomer->no_telp = $request->no_telp;
        $datacustomer->status = $request->status;
        $datacustomer->save();

        return redirect()->route('datacustomer.index');
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $datacustomer = DataCustomer::find($id);

        return response()->json($datacustomer);
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
        $datacustomer = DataCustomer::find($id);
        $datacustomer->nama = $request->nama;
        $datacustomer->alamat = $request->alamat;
        $datacustomer->no_telp = $request->no_telp;
        $datacustomer->status = $request->status;
        $datacustomer->update();

        return redirect()->route('datacustomer.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datacustomer = DataCustomer::find($id);
        $datacustomer->delete();

        return response(null, 204);
    }
}
