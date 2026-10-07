<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Transaction Form</title>
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
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .dashboard-content {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            background-color: #ffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            position: relative;
            overflow-y: auto;
            max-height: 90vh;
            margin-left: 40%;
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: clamp(1.2rem, 4vw, 1.5rem);
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: clamp(0.9rem, 3vw, 1rem);
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: clamp(0.9rem, 3vw, 1rem);
        }

        .form-check {
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .form-check-input {
            margin-right: 5px;
        }

        .form-check-label {
            font-size: clamp(0.9rem, 3vw, 1rem);
        }

        .form-group.d-flex {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        button {
            background-color: #5eb1e6;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: clamp(0.9rem, 3vw, 1rem);
            width: 45%;
            min-width: 120px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #007bff;
        }

        .btn-secondary {
            background-color: #f44336;
        }

        .btn-secondary:hover {
            background-color: #e53935;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .container {
                padding: 15px;
                margin: 10px;
                width: calc(100% - 20px);
            }

            .form-group.d-flex {
                flex-direction: column;
            }

            button {
                width: 100%;
                margin-bottom: 10px;
            }

            .form-check {
                display: block;
                margin-bottom: 8px;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 10px;
            }

            input[type="text"],
            input[type="number"],
            input[type="date"],
            select,
            textarea {
                padding: 6px;
            }
        }
    </style>
</head>

<body>
    @include('template.sidebarpegawai')
    <div class="dashboard-content">
        <div class="container">
            <h3>Form Transaksi Laundry</h3>
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tanggalMasuk">Date Received:</label>
                    <input type="date" id="tanggalMasuk" name="tanggalMasuk" required>
                </div>
                <div class="form-group">
                    <label for="namaPelanggan">Customer Name:</label>
                    <input type="text" id="namaPelanggan" name="namaPelanggan" placeholder="Enter customer name" required>
                </div>
                <div class="form-group">
                    <label for="noTelp">Phone No.:</label>
                    <input type="text" id="noTelp" name="noTelp" placeholder="Enter customer phone number" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Address:</label>
                    <textarea id="alamat" name="alamat" placeholder="Enter customer address" rows="3" required></textarea>
                </div>

                <!-- Pilihan Layanan -->
                <div class="form-group">
                    <label for="layanan">Laundry Service:</label>
                    <select id="layanan" name="layanan" required>
                        <option value="" disabled selected>Select a service</option>
                        @foreach($laundries as $laundry)
                            <option value="{{ $laundry->jenis_layanan }} - {{ $laundry->durasi_layanan }}">
                                {{ $laundry->jenis_layanan }} - {{ $laundry->durasi_layanan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="berat">Weight (kg):</label>
                    <input type="number" id="berat" name="berat" placeholder="Enter laundry weight" required>
                </div>

                <div class="form-group">
                    <label>Payment Method:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="cash" name="metodePembayaran" value="cash" required>
                        <label class="form-check-label" for="cash">Cash</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="transfer" name="metodePembayaran" value="transfer" required>
                        <label class="form-check-label" for="transfer">Transfer</label>
                    </div>
                </div>

                <div class="form-group d-flex">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('pegawai.dashboard') }}'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Transaction</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
