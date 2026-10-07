<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_layanan.css">
</head>

<body>

    @include('template.navbar')

    <section class="image-header">
        <img src="img/layanan_header.png" alt="Podomoro Laundry" class="img-fluid w-100" />
        <div class="text">
            <p><b>Our Services</b></p>
            <!-- <p><b>Fresh, Neat, Clean</b></p> -->
        </div>
    </section>

    <section class="container my-5">
        <h3 style="text-align: center;">Podomoro Laundry Services</h3>
        <br>
        <div class="row">
            @foreach ($laundries as $laundry)
            <div class="col-md-4">
                <div class="carde">
                    <h3 class="card-title text-primary">{{$laundry->jenis_laundry}}</h3>
                    <h4 class="card-title">{{$laundry->jenis_layanan}} - {{$laundry->durasi_layanan}}</h4>
                    <p class="card-text">{{$laundry->keterangan}}</p>
                    <p class="card-info"><b>Price: {{$laundry->tarif_layanan}}/kg</b></p>
                    <a href="http://wa.me/6281385613704" class="btn btn-primary">Order now</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <footer class="text-center footer py-3">
        <p>&copy; 2024 Podomoro Laundry. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
