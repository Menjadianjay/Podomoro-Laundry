<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_tentang.css">
    <title>Podomoro Laundry</title>
</head>

<body>

    @include('template.navbar')
    

    <section class="image-header">
        <img src="img/about_header.png" alt="Podomoro Laundry" class="img-fluid w-100" style="float: left;" />
        <!-- Text is centered inside the transparent box -->
        <div class="centered-text">
            <h1 class="larger-header"><b>About Us</b></h1> <!-- Large "About Us" header outside the transparent box -->

        </div>
    </section>

    <div class="white-bg">
        <!-- Text in the white background section -->
        <div class="text-center">
        <div class="overlay-box">
                <h1><b>PodoMoro Laundry!</b></h1>
                <p><b>Fresh, Neat, Clean</b></p>
                <p> PodoMoro Laundry has operated in Yogyakarta since 2023,
                    providing individual-item and per-kilogram laundry services in Yogyakarta and the surrounding area.
                    We remain committed to service quality for our customers and to working in harmony with the local community.
                    We turn creative service ideas into technology-based solutions in today’s digital era so
                    every customer can access our service information. This is especially helpful for visitors and travelers to Bali who need
                    fast laundry service. Make the most of your vacation or important daily routines without being interrupted by extra household chores.
                    For travelers, it is important to visit their destinations without worrying about access to clean clothes,
                    making their trip more memorable and enjoyable.</p>
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
