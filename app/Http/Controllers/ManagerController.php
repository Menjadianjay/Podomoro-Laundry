<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Laundry;
use App\Models\Pelanggan;

class ManagerController extends Controller
{

    public function dashboard()
    {
        $transactions = Transaction::with(['pelanggan', 'laundry'])->get();
        $totalIncome = $transactions->sum('total_harga');
        $transactionCount = $transactions->count();
        $laundryCount = Laundry::count(); // Count the services

        return view('manager.dashboard', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'transactionCount' => $transactionCount,
            'laundryCount' => $laundryCount, // Kirim ke view
        ]);
    }


    public function inputdata()
    {
        // Get service type, service name, and turnaround time from the laundries table
        $laundries = Laundry::all();
        return view('manager.inputdata', compact('laundries'));
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

        // Hitung total harga
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

        return redirect()->route('manager.dashboard')->with('success', 'Transaction saved successfully.');
    }


    public function viewData()
    {
        $transactions = Transaction::with(['pelanggan', 'laundry'])->orderBy('created_at', 'desc')->paginate(5);
        return view('manager.viewdata', compact('transactions'));
    }


    public function editdata($id)
    {
        $transaction = Transaction::with('pelanggan', 'laundry')->findOrFail($id);
        $laundries = Laundry::all();
        return view('manager.editdata', compact('transaction', 'laundries'));
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

        // Update laundry
        $laundry = Laundry::where('jenis_layanan', $jenisLayanan)
            ->where('durasi_layanan', $durasiLayanan)
            ->firstOrFail();

        // Hitung ulang total harga
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

        return redirect()->route('manager.viewdata')->with('success', 'Transaction updated successfully.');
    }

    public function delete($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->delete();
            return redirect()->route('manager.viewdata');
        }
        return redirect()->route('manager.viewdata');
    }
}
