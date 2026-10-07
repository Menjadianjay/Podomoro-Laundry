<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/da.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url("{{ asset('img/dash.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .dashboard-card h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.2rem;
        }

        .dashboard-card .value {
            font-size: 2em;
            font-weight: bold;
            color: #5eb1e6;
            margin: 10px 0;
            word-break: break-word;
        }

        .dashboard-card p {
            color: #666;
            font-size: 0.9rem;
        }

        .transaction-table {
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            overflow: hidden;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            max-height: 500px;
            overflow-y: auto;
        }

        .transaction-table table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 700px;
        }

        .transaction-table thead {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .transaction-table th {
            background-color: rgb(218, 214, 214);
            color: #333;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            white-space: nowrap;
            border-bottom: 2px solid #ddd;
        }

        .transaction-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
            white-space: nowrap;
        }

        .transaction-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Scrollbar Styling */
        .table-wrapper::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .dashboard-content {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                padding: 10px 0;
            }

            .dashboard-content {
                padding: 15px;
            }

            .dashboard-card {
                padding: 15px;
            }

            .dashboard-card .value {
                font-size: 1.8em;
            }

            .transaction-table {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-content {
                padding: 10px;
            }

            .dashboard-card .value {
                font-size: 1.5em;
            }

            .dashboard-card p {
                font-size: 0.8rem;
            }

            .transaction-table {
                padding: 10px;
            }

            .transaction-table th,
            .transaction-table td {
                padding: 10px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    @include('template.sidebarmanager')

    <div class="dashboard-content">
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Total Transactions</h3>
                <div class="value">{{ $transactionCount }}</div>
                <p>Current Transaction Count</p>
            </div>

            <div class="dashboard-card">
                <h3>Total Revenue</h3>
                <div class="value">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
                <p>Total Laundry Revenue</p>
            </div>

            <div class="dashboard-card">
                <h3>Total Services</h3>
                <div class="value">{{ $laundryCount }}</div>
                <p>Available Service Count</p>
            </div>
        </div>

        <!-- Transaction Table -->
        <div class="transaction-table">
            <div class="table-wrapper">
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
