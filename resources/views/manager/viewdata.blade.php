<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Laundry Transactions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/da.css') }}">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        body {
            background-image: url("{{ asset('img/dash.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-content {
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1400px;
            margin: 20px;
            position: relative;
            left: 8%;
            overflow-x: auto; /* Tambahkan scrollbar horizontal jika diperlukan */
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%; /* Tabel menyesuaikan lebar kontainer */
            border-collapse: collapse;
            margin-bottom: 1rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            table-layout: auto; /* Agar kolom tabel fleksibel sesuai konten */
        }

        th, td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        th {
            background-color: #f7f7f7;
            font-weight: bold;
        }

        .btn-actions {
            display: flex;
            gap: 5px;
            flex-wrap: nowrap;
        }

        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            min-width: 70px;
            margin: 2px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 5px;
            align-items: center;
        }

        .pagination a {
            color: #007bff;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 5px;
            min-width: 10px;
            height: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .pagination a:hover {
            background-color: #f2f2f2;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
        }

        /* Responsive Styles */
        @media screen and (max-width: 1400px) {
            .container {
                width: 95%;
                left: 5%;
            }
        }

        @media screen and (max-width: 992px) {
            th, td {
                padding: 10px;
                font-size: 0.85rem;
            }

            .container {
                width: 98%;
                left: 1%;
                margin: 10px;
            }
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 15px;
                margin: 10px;
                width: 100%;
                left: 0;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 10px;
                background: #fff;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: right;
                min-height: 40px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                white-space: normal;
            }

            td:before {
                content: attr(data-label);
                position: relative;
                left: 0;
                width: 45%;
                padding-right: 10px;
                text-align: left;
                font-weight: bold;
            }

            .btn-actions {
                justify-content: center;
                padding-left: 0;
            }

            .btn-actions td:before {
                content: none;
            }
        }

        @media screen and (max-width: 480px) {
            h2 {
                font-size: 1.2rem;
            }

            .container {
                padding: 10px;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    @include('template.sidebarmanager')
    <div class="dashboard-content">
        <div class="container">
            <h2>View Laundry Transactions</h2>

            @if ($transactions->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date Received</th>
                        <th>Customer Name</th>
                        <th>Phone No.</th>
                        <th>Address</th>
                        <th>Service Type</th>
                        <th>Laundry Type</th>
                        <th>Turnaround Time</th>
                        <th>Weight (kg)</th>
                        <th>Payment Method</th>
                        <th>Total Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td data-label="No">{{ $loop->iteration }}</td>
                        <td data-label="Date Received">{{ $transaction->tanggal_masuk }}</td>
                        <td data-label="Customer Name">{{ $transaction->pelanggan->nama }}</td>
                        <td data-label="Phone No.">{{ $transaction->pelanggan->no_telp }}</td>
                        <td data-label="Address">{{ $transaction->pelanggan->alamat }}</td>
                        <td data-label="Service Type">{{ $transaction->laundry->jenis_layanan }}</td>
                        <td data-label="Laundry Type">{{ $transaction->laundry->jenis_laundry }}</td>
                        <td data-label="Turnaround Time">{{ $transaction->laundry->durasi_layanan }}</td>
                        <td data-label="Weight">{{ $transaction->berat }}</td>
                        <td data-label="Payment Method">{{ $transaction->metode_pembayaran }}</td>
                        <td data-label="Total Price">Rp {{ number_format($transaction->total_harga, 2, ',', '.') }}</td>
                        <td data-label="Actions" class="btn-actions">
                            <a href="{{ route('manager.editdata', ['id' => $transaction->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('manager.delete', ['id' => $transaction->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                @for ($i = 1; $i <= $transactions->lastPage(); $i++)
                    <a href="{{ $transactions->url($i) }}" class="{{ $transactions->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor
            </div>
            @else
            <div class="alert alert-info text-center">
                No transaction data is available.
            </div>
            @endif
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('manager.dashboard') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
