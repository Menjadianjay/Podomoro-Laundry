<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Podomoro Laundry</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css" />
  <!-- Fontawesome icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>

<body>
  <!-- Navbar -->
  @include('template.navbar')
  
  <section class="contact-section">
    <div class="contact-bg" >
      <h3>Contact Us</h3>
      <h2>Podomoro Laundry</h2>
      <div class="line">
        <div></div>
        <div></div>
        <div></div>
      </div>
      <p class="text">
        Podomoro greatly values your feedback about our service, so
        please share it through the contact details below.
        Warm regards, the Podomoro team
      </p>
    </div>

    <div class="contact-body">
      <div class="contact-info">
        <div>
          <span><i class="fas fa-mobile-alt"></i></span>
          <span>Phone Number</span>
          <span class="text">0821-4732-9010</span>
        </div>
        <div>
          <span><i class="fas fa-envelope-open"></i></span>
          <span>Email</span>
          <span class="text">PodomoroLaundry@gmail.com</span>
        </div>
        <div>
          <span><i class="fas fa-map-marker-alt"></i></span>
          <span>Address</span>
          <span class="text">Jl. Sengkan No.22, Joho, Condongcatur, Kec. Depok, Kabupaten
            Sleman, Daerah Istimewa Yogyakarta</span>
        </div>
        <div>
          <span><i class="fas fa-clock"></i></span>
          <span>Opening Hours</span>
          <span class="text">Monday - Friday (9:00 AM - 5:00 PM)</span>
        </div>
      </div>

      <div class="contact-quotes">
        <div class="quotes">
          Your laundry will be clean and fragrant,
          and you can make life easier at home by leaving the laundry to us.
        </div>

        <div>
          <img src="img/logoo.png" alt="" />
        </div>
      </div>
    </div>

    <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2024144.871069837!2d110.3932746133847!3d-7.746480624592145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59d88b94ae77%3A0x44f82a6a31598bef!2sPodomoro%20Laundry!5e0!3m2!1sen!2sid!4v1717741182856!5m2!1sen!2sid" width="100%" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

    <div class="contact-footer">
      <h3>Contact Us</h3>
      <div class="social-links">
        <a href="https://www.facebook.com/groups/270109493113416" class="fab fa-facebook-f"></a>
        <a href="https://www.instagram.com/agnesalfaaa?igsh=dTJwODRqczZ4dzV4" class="fab fa-instagram"></a>
        <a href="https://www.linkedin.com/search/results/all/?keywords=laundry&origin=GLOBAL_SEARCH_HEADER&sid=N3n" class="fab fa-linkedin"></a>
        <a href="https://www.youtube.com/" class="fab fa-youtube"></a>
        <a href="https://api.whatsapp.com/send/?phone=6281385613704&text&type=phone_number&app_absent=0" class="fab fa-whatsapp"></a>
      </div>
    </div>
  </section>
</body>

</html>
