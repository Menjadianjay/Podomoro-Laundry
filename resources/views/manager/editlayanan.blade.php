<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laundry Service</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/da.css') }}">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: url("{{ asset('img/dash.png') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #5eb1e6;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 45%;
        }

        button:hover {
            background-color: #007bff;
        }

        .btn-batal {
            background-color: #f44336;
            color: white;
        }

        .btn-batal:hover {
            background-color: #e53935;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-check-label {
            margin-left: 5px;
        }

        .form-group {
            text-align: left;
        }

        .form-group.d-flex {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .form-group.d-flex {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 1.2em;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-content">
        <div class="container">
            <h2>Edit Laundry Service Type and Rate</h2>
            <form action="{{ route('manager.updatelayanan', $laundry->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Laundry Type:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="kiloan" name="jenis_laundry" value="kiloan"
                            {{ $laundry->jenis_laundry == 'kiloan' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="kiloan">By Weight</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="satuan" name="jenis_laundry" value="satuan"
                            {{ $laundry->jenis_laundry == 'satuan' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="satuan">By Item</label>
                    </div>
                </div>

                <label for="jenis_layanan">Service Type:</label>
                <input type="text" id="jenis_layanan" name="jenis_layanan" value="{{ $laundry->jenis_layanan }}" required>

                <div>
                    <label for="durasi_layanan">Turnaround Time:</label>
                    <select id="durasi_layanan" name="durasi_layanan" required>
                        <option value="Express" {{ $laundry->durasi_layanan == 'Express' ? 'selected' : '' }}>Express</option>
                        <option value="Kilat" {{ $laundry->durasi_layanan == 'Kilat' ? 'selected' : '' }}>Fast</option>
                        <option value="Reguler" {{ $laundry->durasi_layanan == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                    </select>
                </div>

                <label for="tarif_layanan">Service Rate:</label>
                <input type="number" id="tarif_layanan" name="tarif_layanan" value="{{ $laundry->tarif_layanan }}" required>

                <label for="keterangan">Notes:</label>
                <textarea id="keterangan" name="keterangan" rows="4">{{ $laundry->keterangan }}</textarea>

                <div class="form-group d-flex">
                    <button type="button" class="btn btn-batal" onclick="window.location.href='{{ route('manager.viewlayanan') }}'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
