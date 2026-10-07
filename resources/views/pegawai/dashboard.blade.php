<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Laundry</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/da.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url("{{ asset('img/dash.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .dashboard-content {
            margin-left: 250px; /* Adjust for sidebar width */
            padding: 20px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns for cards */
            gap: 20px;
            padding: 20px 0;
            margin-bottom: 20px;
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
            flex: 1;
        }

        .dashboard-card:hover {
            transform: scale(1.05);
        }

        .dashboard-card h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .dashboard-card .value {
            font-size: 2em;
            font-weight: bold;
            color: #5eb1e6;
        }

        .transaction-table-wrapper {
            overflow-x: auto; /* Enable horizontal scroll for wrapper */
            border-radius: 10px;
            margin-top: 20px;
        }

        .transaction-table {
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .transaction-table table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px; /* Minimum width for large tables */
        }

        .transaction-table th,
        .transaction-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap; /* Prevent text wrapping in cells */
        }

        .transaction-table th {
            background-color: rgb(218, 214, 214);
            color: #333;
        }

        .transaction-table tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternate row background for readability */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 columns for smaller screens */
                gap: 15px;
            }
        }

        @media (max-width: 576px) {
            .dashboard-grid {
                grid-template-columns: 1fr; /* 1 column for mobile screens */
            }

            .dashboard-content {
                margin-left: 0;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Include -->
    @include('template.sidebarpegawai')

    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Total Transaksi</h3>
                <div class="value">{{ $transactionCount }}</div>
                <p>Current Transaction Count</p>
            </div>

            <div class="dashboard-card">
                <h3>Total Revenue</h3>
                <div class="value">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
                <p>Total Laundry Revenue</p>
            </div>

            <div class="dashboard-card">
                <h3>Latest Transaction</h3>
                @if($transactions->count() > 0)
                    @php
                        $latestTransaction = $transactions->last();
                    @endphp
                    <div class="value">{{ $latestTransaction->tanggal_masuk }}</div>
                @else
                    <p>No transactions</p>
                @endif
            </div>
        </div>

        <!-- Transaction Table -->
        <div class="transaction-table-wrapper">
            <div class="transaction-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Service</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions->take(5) as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->tanggal_masuk }}</td>
                            <td>{{ $transaction->pelanggan->nama }}</td>
                            <td>{{ $transaction->laundry->jenis_layanan }}</td>
                            <td>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
