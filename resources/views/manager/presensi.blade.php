<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Staff Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/da.css') }}">
    <style>
        /* Style CSS tetap sama */
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url("{{ asset('img/dash.png') }}");
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
            margin: 50px auto;
            margin-top: 10%;
            margin-left: 40%;
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
        select,
        textarea,
        input[type="file"],
        input[readonly] {
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
            width: 25%;
        }
        button:hover {
            background-color: #007bff;
        }
        .btn-secondary {
            background-color: #f44336;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 15%;
        }
        .btn-secondary:hover {
            background-color: #e53935;
        }
        .form-group {
            text-align: left;
        }
        .form-group.d-flex {
            justify-content: space-between;
            display: flex;
        }
                /* Error message positioned at the top center of the page */
        .alert {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 600px;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin-top: 5%;
            margin-left: 5%;
        }
        .alert-success {
            background-color: #4CAF50;
            color: white;
        }
        .alert-danger {
            background-color: #f44336;
            color: white;
        }
        .alert-info {
            background-color: #2196F3;
            color: white;
        }

                /* Responsive styles for small screens */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
            button {
                width: 50%;
            }
            .btn-secondary {
                width: 50%;
            }
        }
    </style>
</head>

<body>
    @include('template.sidebarmanager')
            <!-- Alert message at the top center -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    <div class="dashboard-content">
        <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <h2>Enter Staff Attendance</h2>

                <div class="form-group">
                    <label for="nama">Staff Name</label>
                    <select id="nama" name="nama">
                        <option value="Ferdy">Ferdy</option>
                        <option value="Mado">Mado</option>
                        <option value="Juliano">Juliano</option>
                        <option value="Rio">Rio</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="kehadiran">Attendance Status</label>
                    <select id="kehadiran" name="kehadiran">
                        <option value="Hadir">Present</option>
                        <option value="Sakit">Sick</option>
                        <option value="Absent">Absent</option>
                        <option value="Ijin">Permission</option>
                    </select>
                </div>

                <div class="form-group" id="keterangan-group" style="display: none;">
                    <label for="keterangan">Notes</label>
                    <textarea id="keterangan" name="keterangan" rows="4" class="form-control" placeholder="Enter notes"></textarea>
                </div>

                <div class="form-group">
                    <label for="upload">Upload Medical Certificate</label>
                    <input type="file" id="upload" name="upload">
                </div>

                <div class="form-group d-flex">
                    <a href="{{ route('manager.dashboard') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const kehadiranSelect = document.getElementById("kehadiran");
            const keteranganGroup = document.getElementById("keterangan-group");

            function toggleKeterangan() {
                if (kehadiranSelect.value !== "Hadir") {
                    keteranganGroup.style.display = "block";
                } else {
                    keteranganGroup.style.display = "none";
                }
            }
            toggleKeterangan();

            kehadiranSelect.addEventListener("change", toggleKeterangan);
        });
    </script>
</body>

</html>
