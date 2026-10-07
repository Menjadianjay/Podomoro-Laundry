<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi Laundry</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/da.css') }}">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        body {
            background-image: url("{{ asset('img/dash.png') }}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #ffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            text-align: center;
            margin: 20px;
            position: relative;
            left: auto;
            top: auto;
            transform: none;
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: clamp(1.2rem, 2.5vw, 1.5rem);
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
            font-size: clamp(0.9rem, 2vw, 1rem);
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: clamp(0.9rem, 2vw, 1rem);
        }

        /* Radio buttons container */
        .form-group .form-check {
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .form-check-input {
            margin-right: 5px;
        }

        .form-check-label {
            font-size: clamp(0.9rem, 2vw, 1rem);
        }

        /* Buttons container */
        .form-group.d-flex {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
            align-items: center;
            flex-wrap: wrap;
        }

        button, .btn-secondary {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: clamp(0.9rem, 2vw, 1rem);
            min-width: 100px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        button {
            background-color: #5eb1e6;
            color: white;
        }

        button:hover {
            background-color: #007bff;
        }

        .btn-secondary {
            background-color: #f44336;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #e53935;
        }

        /* Media Queries */
        @media screen and (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
                margin: 10px;
            }

            .form-group.d-flex {
                justify-content: center;
            }

            button, .btn-secondary {
                width: 45%;
                min-width: auto;
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                padding: 10px;
                margin: 5px;
            }

            .form-check {
                display: block;
                margin-bottom: 5px;
            }

            button, .btn-secondary {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Edit Transaksi Laundry</h3>
        <form action="{{ route('manager.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="tanggalMasuk">Date Received:</label>
                <input type="date" id="tanggalMasuk" name="tanggalMasuk" required value="{{ $transaction->tanggal_masuk }}">
            </div>
            <div class="form-group">
                <label for="namaPelanggan">Customer Name:</label>
                <input type="text" id="namaPelanggan" name="namaPelanggan" placeholder="Enter customer name" required value="{{ $transaction->pelanggan->nama }}">
            </div>
            <div class="form-group">
                <label for="noTelp">Phone No.:</label>
                <input type="text" id="noTelp" name="noTelp" placeholder="Enter customer phone number" required value="{{ $transaction->pelanggan->no_telp }}">
            </div>
            <div class="form-group">
                <label for="alamat">Address:</label>
                <textarea id="alamat" name="alamat" placeholder="Enter customer address" rows="3" required>{{ $transaction->pelanggan->alamat }}</textarea>
            </div>
            <div class="form-group">
                <label for="layanan">Laundry Service:</label>
                <select id="layanan" name="layanan" required>
                    <option value="" disabled>Select a service</option>
                    @foreach($laundries as $laundry)
                        <option value="{{ $laundry->jenis_layanan }} - {{ $laundry->durasi_layanan }}"
                            {{ $transaction->laundry->jenis_layanan . ' - ' . $transaction->laundry->durasi_layanan == $laundry->jenis_layanan . ' - ' . $laundry->durasi_layanan ? 'selected' : '' }}>
                            {{ $laundry->jenis_layanan }} - {{ $laundry->durasi_layanan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="berat">Weight (kg):</label>
                <input type="number" id="berat" name="berat" placeholder="Enter laundry weight" required value="{{ $transaction->berat }}">
            </div>
            <div class="form-group">
                <label>Payment Method:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="cash" name="metodePembayaran" value="cash" required {{ $transaction->metode_pembayaran == 'cash' ? 'checked' : '' }}>
                    <label class="form-check-label" for="cash">Cash</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="transfer" name="metodePembayaran" value="transfer" required {{ $transaction->metode_pembayaran == 'transfer' ? 'checked' : '' }}>
                    <label class="form-check-label" for="transfer">Transfer</label>
                </div>
            </div>
            <div class="form-group d-flex">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('manager.viewdata') }}'">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</body>

</html>
