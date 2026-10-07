<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podomoro Laundry</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    @include('template.navbar')

    <section class="image-header">
        <img src="img\index_header.png" alt="Podomoro Laundry" class="img-fluid w-100" />
        <div class="text">
            <h3>Pickup and Delivery Laundry Service in Yogyakarta!</h3>
            <p><i>Fresh, Neat, Clean</i></p>
        </div>
    </section>

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid text-center text-white custom-bg">
        <div class="container">
            <div class="jumbotron-content">
                <h1 class="display-4">Welcome to Podomoro Laundry!</h1>
            </div>
        </div>
    </div>

    <div class="container text-center py-5">
        <h2 class="mb-4 text-primary"><b><i>SERVICE TYPES</i></b></h2>
        <div class="row">
            <div class="col-md-4">
                <a href="layanan" class="card mb-4 shadow-sm text-decoration-none text-dark">
                    <img src="img/wash.png" class="card-img-top" alt="Cuci & Setrika">
                    <div class="card-body">
                        <h2 class="card-title">Wash & Iron</h2>
                        <p class="card-text">Professional dry cleaning to keep your clothes soft.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="layanan" class="card mb-4 shadow-sm text-decoration-none text-dark">
                    <img src="img/fold.png" class="card-img-top" alt="Cuci & Lipat">
                    <div class="card-body">
                        <h2 class="card-title">Wash & Fold</h2>
                        <p class="card-text">A practical, time-saving wash-and-fold service.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="layanan" class="card mb-4 shadow-sm text-decoration-none text-dark">
                    <img src="img/iron.png" class="card-img-top" alt="Setrika">
                    <div class="card-body">
                        <h2 class="card-title">Ironing</h2>
                        <p class="card-text">Expert ironing to keep your clothes neat and wrinkle-free.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    

    <footer class="text-center py-4">
        <p>&copy; 2024 Podomoro Laundry. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
