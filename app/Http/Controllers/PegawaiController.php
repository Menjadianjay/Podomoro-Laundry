<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Laundry;
use App\Models\Pelanggan;

class PegawaiController extends Controller
{
    public function dashboard()
    {

        $transactions = Transaction::all();

        // Calculate total income
        $totalIncome = $transactions->sum('total_harga');

        // Get transaction count
        $transactionCount = $transactions->count();

        return view('pegawai.dashboard', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'transactionCount' => $transactionCount
        ]);
    }

    public function inputdata()
    {
        // Get service type, service name, and turnaround time from the laundries table
        $laundries = Laundry::all();
        return view('pegawai.inputdata', compact('laundries')); // Return the view and laundry data
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggalMasuk' => 'required|date',
            'namaPelanggan' => 'required|string|max:255',
            'noTelp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'layanan' => 'required|string',
            'berat' => 'required|numeric',
            'metodePembayaran' => 'required|string',
        ]);

        // Split the service into service type and turnaround time
        [$jenisLayanan, $durasiLayanan] = explode(' - ', $request->layanan);

        // Create or retrieve the customer by name
        $pelanggan = Pelanggan::updateOrCreate(
            ['nama' => $request->namaPelanggan],
            [
                'no_telp' => $request->noTelp,
                'alamat' => $request->alamat,
            ]
        );

        // Retrieve the matching laundry service or create a new entry
        $laundry = Laundry::updateOrCreate(
            [
                'jenis_layanan' => $jenisLayanan,
                'durasi_layanan' => $durasiLayanan,
            ]
        );

        // Calculate the total price
        $totalHarga = $laundry->tarif_layanan * $request->berat;

        // Save the transaction
        Transaction::create([
            'tanggal_masuk' => $request->tanggalMasuk,
            'pelanggan_id' => $pelanggan->id,
            'laundry_id' => $laundry->id,
            'berat' => $request->berat,
            'metode_pembayaran' => $request->metodePembayaran,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('pegawai.dashboard')->with('success', 'Transaction saved successfully.');
    }

    public function viewData()
    {
        $transactions = Transaction::with(['pelanggan', 'laundry'])->orderBy('created_at', 'desc')->paginate(5);
        return view('pegawai.viewdata', compact('transactions'));
    }

    public function editdata($id)
    {
        $transaction = Transaction::with('pelanggan', 'laundry')->findOrFail($id);
        $laundries = Laundry::all();
        return view('pegawai.editdata', compact('transaction', 'laundries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggalMasuk' => 'required|date',
            'namaPelanggan' => 'required|string|max:255',
            'noTelp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'layanan' => 'required|string',
            'berat' => 'required|numeric',
            'metodePembayaran' => 'required|string',
        ]);

        $transaction = Transaction::findOrFail($id);

        // Split the service into service type and turnaround time
        [$jenisLayanan, $durasiLayanan] = explode(' - ', $request->layanan);

        // Update the customer
        $pelanggan = Pelanggan::updateOrCreate(
            ['nama' => $request->namaPelanggan],
            [
                'no_telp' => $request->noTelp,
                'alamat' => $request->alamat,
            ]
        );

        // Update the laundry service
        $laundry = Laundry::where('jenis_layanan', $jenisLayanan)
            ->where('durasi_layanan', $durasiLayanan)
            ->firstOrFail();

        // Recalculate the total price
        $totalHarga = $laundry->tarif_layanan * $request->berat;

        // Update the transaction
        $transaction->update([
            'tanggal_masuk' => $request->tanggalMasuk,
            'pelanggan_id' => $pelanggan->id,
            'laundry_id' => $laundry->id,
            'berat' => $request->berat,
            'metode_pembayaran' => $request->metodePembayaran,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('pegawai.viewdata')->with('success', 'Transaction updated successfully.');
    }


    public function delete($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->delete();
            return redirect()->route('pegawai.viewdata');
        }
        return redirect()->route('pegawai.viewdata');
    }
}
