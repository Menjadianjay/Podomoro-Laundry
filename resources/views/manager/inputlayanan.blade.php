<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Laundry Service</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/da.css') }}">
    <style>
        /* Reset and Base Styles */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: url("{{ asset('img/dash.png') }}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Container Styling */
        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            left: 5%;
            transform: translateX(0);
            overflow-y: auto;
            max-height: 90vh;
        }

        /* Typography */
        h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            text-align: center;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #444;
            font-weight: 500;
            text-align: left;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
            box-sizing: border-box;
            margin-bottom: 1rem;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #5eb1e6;
            outline: none;
        }

        /* Radio Buttons */
        .form-check {
            display: inline-flex;
            align-items: center;
            margin-right: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .form-check-input {
            margin-right: 0.5rem;
        }

        /* Buttons */
        .form-group.d-flex {
            display: flex;
            gap: 1rem;
            justify-content: space-between;
            margin-top: 1.5rem;
        }

        button {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            min-width: 120px;
        }

        button:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background-color: #5eb1e6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #007bff;
        }

        .btn-batal {
            background-color: #f44336;
            color: white;
        }

        .btn-batal:hover {
            background-color: #e53935;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .container {
                padding: 1.5rem;
                width: 90%;
                max-width: none;
                left: 0;
                transform: none;
            }

            h2 {
                font-size: 1.25rem;
            }

            input[type="text"],
            input[type="number"],
            select,
            textarea {
                padding: 0.625rem;
                font-size: 0.9rem;
            }

            button {
                padding: 0.625rem 1.25rem;
                min-width: 100px;
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                padding: 1rem;
                width: 95%;
            }

            h2 {
                font-size: 1.1rem;
                margin-bottom: 1rem;
            }

            .form-group.d-flex {
                flex-direction: column;
                gap: 0.75rem;
            }

            button {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .form-check {
                display: block;
                margin-bottom: 0.75rem;
            }

            label {
                font-size: 0.9rem;
            }

            input[type="text"],
            input[type="number"],
            select,
            textarea {
                font-size: 0.875rem;
                padding: 0.5rem;
            }
        }

        /* Scrollbar Styling */
        .container::-webkit-scrollbar {
            width: 6px;
        }

        .container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body>
    @include('template.sidebarmanager')
    <div class="dashboard-content">
        <div class="container">
            <h2>Enter Laundry Service Type and Rate</h2>
            <form action="{{ route('manager.storelayanan') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Laundry Type:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="kiloan" name="jenis_laundry" value="kiloan" required>
                        <label class="form-check-label" for="kiloan">By Weight</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="satuan" name="jenis_laundry" value="satuan" required>
                        <label class="form-check-label" for="satuan">By Item</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="jenis_layanan">Service Type:</label>
                    <input type="text" id="jenis_layanan" name="jenis_layanan" placeholder="Masukkan jenis layanan (contoh: Cuci Kering)" required>
                </div>

                <div class="form-group">
                    <label for="durasi_layanan">Turnaround Time:</label>
                    <select id="durasi_layanan" name="durasi_layanan" required>
                        <option value="" disabled selected>Select Turnaround Time</option>
                        <option value="Express">Express</option>
                        <option value="Kilat">Fast</option>
                        <option value="Reguler">Reguler</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tarif_layanan">Service Rate:</label>
                    <input type="number" id="tarif_layanan" name="tarif_layanan" placeholder="Masukkan Tarif layanan (contoh: 5000)" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Notes:</label>
                    <textarea id="keterangan" name="keterangan" placeholder="Masukkan keterangan layanan" rows="4"></textarea>
                </div>

                <div class="form-group d-flex">
                    <button type="button" class="btn btn-batal" onclick="window.location.href='{{ route('manager.dashboard') }}'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
