<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresensiController extends Controller
{
    private function isWorkingHours()
    {
        $now = Carbon::now();
        $startTime = Carbon::createFromTime(8, 0, 0);
        $endTime = Carbon::createFromTime(19, 0, 0);
        return $now->between($startTime, $endTime);
    }

    public function presensi()
    {
        $nama = Auth::user()->name;
        $now = Carbon::now();

        // Check the attendance time
        $isWithinWorkHours = $this->isWorkingHours();

        // Check whether the user has already recorded attendance today during work hours
        $sudahPresensi = Presensi::where('nama', $nama)
            ->whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '08:00:00')
            ->whereTime('created_at', '<=', '19:00:00')
            ->exists();

        return view('pegawai.presensi', compact('sudahPresensi', 'isWithinWorkHours'));
    }

    public function presensimanager()
    {
        return view('manager.presensi');
    }

    public function store(Request $request)
    {
        // Validate working hours
        if (!$this->isWorkingHours()) {
            return redirect()->back()->with('error', 'Attendance can only be recorded between 8:00 AM and 7:00 PM.');
        }

        // Get the logged-in user's name
        $nama = Auth::user()->name;

        // Check whether attendance has already been recorded today during work hours
        $sudahPresensi = Presensi::where('nama', $nama)
            ->whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '08:00:00')
            ->whereTime('created_at', '<=', '19:00:00')
            ->exists();

        if ($sudahPresensi) {
            return redirect()->back()->with('error', 'You have already recorded attendance today!');
        }

        try {
            // Validate the input
            $request->validate([
                'nama' => 'required|string|max:255',
                'kehadiran' => 'required|string',
                'keterangan' => 'nullable|string',
                'upload' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048',
            ]);

            // Check working hours again before saving the staff input
            if (!$this->isWorkingHours()) {
                return redirect()->back()->with('error', 'Attendance can only be recorded between 8:00 AM and 7:00 PM.');
            }

            // If a file was uploaded, save it and get its path
            if ($request->hasFile('upload')) {
                $uploadPath = $request->file('upload')->store('uploads', 'public');
            } else {
                $uploadPath = null;
            }

            // Save the data to the attendance table
            Presensi::create([
                'nama_pegawai' => $request->nama,
                'kehadiran' => $request->kehadiran,
                'keterangan' => $request->keterangan,
                'upload' => $uploadPath,
            ]);

            // Get the currently logged-in user
            $user = Auth::user();

            // Check the user's role
            if ($user->name === 'manager') {
                return redirect()->intended(route('manager.dashboard'))
                    ->with('success', 'Attendance saved successfully.');
            } elseif (in_array($user->name, ['Ferdy', 'Mado', 'Rio', 'Juliano'])) {
                return redirect()->intended(route('pegawai.dashboard'))
                    ->with('success', 'Attendance saved successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred: ' . $e->getMessage())
                ->withInput();
        }
    }
    // public function presensi()
    // {
    //     $userId = Auth::id();
    //     $hariIni = Carbon::today();

    //     // Cek apakah user sudah presensi hari ini
    //     $sudahPresensi = Presensi::where('user_id', $userId)
    //         ->where('tanggal', $hariIni)
    //         ->exists();

    //     return view('pegawai.presensi', compact('sudahPresensi'));
    // }
    // public function presensimanager()
    // {
    //     return view('manager.presensi');
    // }

    // //Menyimpan data presensi ke database
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'kehadiran' => 'required|string',
    //         'keterangan' => 'nullable|string',
    //         'upload' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048',
    //     ]);

    //     // Jika ada file upload, simpan file dan dapatkan path-nya
    //     if ($request->hasFile('upload')) {
    //         $uploadPath = $request->file('upload')->store('uploads', 'public');
    //     } else {
    //         $uploadPath = null;
    //     }

    //     // Simpan data ke dalam tabel presensis
    //     Presensi::create([
    //         'nama_pegawai' => $request->nama,
    //         'kehadiran' => $request->kehadiran,
    //         'keterangan' => $request->keterangan,
    //         'upload' => $uploadPath,
    //     ]);

    //     // Redirect atau menampilkan pesan sukses
    //     // return redirect()->route('pegawai.dashboard')->with('success', 'Presensi berhasil disimpan.');
    //     // Ambil pengguna yang sedang login
    //     $user = Auth::user();
    //     // Cek peran pengguna (pegawai atau manager)
    //     if ($user->name === 'manager') {
    //         // Redirect ke halaman manager jika pengguna adalah manager
    //         return redirect()->intended(route('manager.dashboard'));
    //     } elseif (in_array($user->name, ['Ferdy', 'Mado', 'Rio', 'Juliano'])) {
    //         $userId = Auth::id();
    //         $hariIni = Carbon::today();

    //         // Cek apakah user sudah presensi hari ini
    //         $sudahPresensi = Presensi::where('user_id', $userId)
    //             ->where('tanggal', $hariIni)
    //             ->exists();

    //         if ($sudahPresensi) {
    //             return redirect()->back()->with('error', 'Anda sudah presensi hari ini!');
    //         } else {
    //             // Redirect ke halaman pegawai jika pengguna adalah pegawai dengan nama yang disebutkan
    //             return redirect()->intended(route('pegawai.dashboard'));
    //         }
    //     }
    // }
    // Display attendance data in a table on the staff dashboard
    public function viewpresensi()
    {
        $presensis = Presensi::orderBy('created_at', 'desc')->paginate(5); // Retrieve all attendance data from the database
        return view('pegawai.viewpresensi', compact('presensis'));
    }
    // Display attendance data in a table on the manager dashboard
    public function viewpresensiManager()
    {
        $presensis = Presensi::paginate(5); // Retrieve all attendance data from the database
        return view('manager.viewpresensi', compact('presensis'));
    }

    public function showFile($id)
    {
        // Find attendance data by ID
        $presensi = Presensi::find($id);

        // Jika data presensi ditemukan dan ada file yang diupload
        if ($presensi && $presensi->upload) {
            // Build the full file path
            $filePath = storage_path('app/public/' . $presensi->upload);

            // Check whether the file exists on the server
            if (file_exists($filePath)) {
                // Return the file to the browser for viewing or download
                return response()->file($filePath);
            } else {
                return redirect()->back()->with('error', 'File not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Attendance record or file not found.');
        }
    }

    // Display the attendance edit form
    public function editpresensi($id)
    {
        $presensi = Presensi::findOrFail($id);
        return view('manager.editpresensi', compact('presensi'));
    }

    // Update attendance data in the database
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kehadiran' => 'required|string',
            'keterangan' => 'nullable|string',
            'upload' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        $presensi = Presensi::findOrFail($id);

        // If a file was uploaded, save it and get its path
        if ($request->hasFile('upload')) {
            $uploadPath = $request->file('upload')->store('uploads', 'public');
        } else {
            $uploadPath = $presensi->upload; // Tetap gunakan file lama jika tidak ada yang diupload
        }

        // Update attendance data in the attendance table
        $presensi->update([
            'nama_pegawai' => $request->nama,
            'kehadiran' => $request->kehadiran,
            'keterangan' => $request->keterangan,
            'upload' => $uploadPath,
        ]);

        // Redirect with a success message
        return redirect()->route('manager.viewpresensi')->with('success', 'Attendance updated successfully.');
    }

    // Delete attendance data from the database
    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);

        // Delete the attendance record
        $presensi->delete();

        // Redirect with a success message
        return redirect()->route('manager.viewpresensi')->with('success', 'Attendance deleted successfully.');
    }
}
