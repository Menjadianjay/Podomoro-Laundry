<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaundryController extends Controller
{
    public function create()
    {
        return view('manager.inputlayanan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_laundry' => 'required|string',
            'jenis_layanan' => 'required|string',
            'tarif_layanan' => 'required|numeric',
            'durasi_layanan' => 'required|string',
            'keterangan' => 'nullable|string', // Add notes validation
        ]);

        Laundry::create($request->all());

        return redirect()->route('manager.dashboard')->with('success', 'Laundry service added successfully.');
    }

    public function viewlayanan()
    {
        $laundries = Laundry::orderBy('created_at', 'desc')->paginate(5);
        return view('manager.viewlayanan', compact('laundries'));
    }

    public function edit($id)
    {
        $laundry = Laundry::findOrFail($id);
        return view('manager.editlayanan', compact('laundry'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_laundry' => 'required|string',
            'jenis_layanan' => 'required|string',
            'tarif_layanan' => 'required|numeric',
            'durasi_layanan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $laundry = Laundry::findOrFail($id);
        $laundry->update($request->all());

        return redirect()->route('manager.viewlayanan')->with('success', 'Laundry service updated successfully.');
    }

    public function destroy($id)
    {
        $laundry = Laundry::findOrFail($id);
        $laundry->delete();

        return redirect()->route('manager.viewlayanan')->with('success', 'Laundry service deleted successfully.');
    }

    public function viewlandinglayanan()
    {
        $laundries = DB::table('laundries')->get();
        return view('home.layanan', ['laundries' => $laundries]);
    }
}
