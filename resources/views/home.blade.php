@extends('template.template')

@section('title', 'Home - Rumah Hijau')

@section('content')

<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow_auto -->
    {{-- Carousel Start --}}
    <div id="carousel" style="margin-bottom: 8%">
        @foreach ($promos as $promo)
        <div class="slideHomePromo"><a href="#"><img class="homeImage" src="{{Storage::url($promo->photo)}}" alt="fotoimage"></a></div>
        @endforeach

        <div class="promoButton" style="position: absolute; margin-left: 45%; margin-top: 1%;">
            <button id="prev" style="float: left; font-size:50%; background-color: rgba(255, 255, 255, 0)"><div class="homeArrow" style="border: 1px solid white; border-radius: 100%; padding: 5%"><i class="fa fa-arrow-left" style="font-size: 150%"></i></div></button>
                <a class="homeSeeAllPromo" href="http://localhost:8000/promo">See All Promo</a>
            <button id="next" style="float: left; font-size:50%; background-color: rgba(255, 255, 255, 0)"><div class="homeArrow" style="border: 1px solid white; border-radius: 100%; padding: 5%"><i class="fa fa-arrow-right" style="font-size: 150%"></i></div></button>
        </div>
    </div>

    <script>

        const carousel = document.querySelector('#carousel');
        const indicators = document.querySelectorAll('.indicator');
        let currentSlide = 0;

        function updateIndicators() {
          indicators.forEach((indicator) => indicator.classList.remove('active'));
          indicators[currentSlide].classList.add('active');
        }

        carousel.addEventListener('scroll', () => {
          currentSlide = Math.round(carousel.scrollLeft / carousel.offsetWidth);
          updateIndicators();
        });

        indicators.forEach((indicator, index) => {
          indicator.addEventListener('click', () => {
            carousel.scrollLeft = index * carousel.offsetWidth;
            currentSlide = index;
            updateIndicators();
          });
        });
        const prevButton = document.querySelector('#prev');
        const nextButton = document.querySelector('#next');
        let isDown = false;
        let startX;
        let scrollLeft;

        carousel.addEventListener('mousedown', (e) => {
          isDown = true;
          carousel.classList.add('active');
          startX = e.pageX - carousel.offsetLeft;
          scrollLeft = carousel.scrollLeft;
        });
        carousel.addEventListener('mouseleave', () => {
          isDown = false;
          carousel.classList.remove('active');
        });
        carousel.addEventListener('mouseup', () => {
          isDown = false;
          carousel.classList.remove('active');
        });
        carousel.addEventListener('mousemove', (e) => {
          if(!isDown) return;
          e.preventDefault();
          const x = e.pageX - carousel.offsetLeft;
          const walk = (x - startX) * 3;
          carousel.scrollLeft = scrollLeft - walk;
        });

        prevButton.addEventListener('click', () => {
          carousel.scrollLeft -= carousel.offsetWidth;
        });

        nextButton.addEventListener('click', () => {
          carousel.scrollLeft += carousel.offsetWidth;
        });

    </script>

    {{-- Carousel End --}}



    <!-- Visit Destination Start AKA EXPLORE THE THOUSAND ISLAND -->
    <div>
        <div class="subTitleHome" style="text-align: center">
            <h1 style="color: #12AD2B; font-weight:bold">EXPLORE THE THOUSAND ISLAND</h1>
            <h3 style="color: #EB5406; font-weight:bold; margin-bottom:2%;">Let's Travel with Rumah Lestari Hijau</h3>
            <div style="width: 100%; background-image: url('gambar/autumn-reflections.png'); padding:5%; background-size: cover; ">
              {{-- GAMBAR DIDALAM GAMBAR --}}
                <img src="gambar/home1.svg" style="width: 25%; margin: 2%">
                <img src="gambar/home2.svg" style="width: 25%; margin: 2%">
                <img src="gambar/home3.svg" style="width: 25%; margin: 2%">
            </div>
            <a href="/destination"><button style="border-radius: 20px; background: linear-gradient(to right, orange, red); color: white; padding: 1%; padding-left: 3%; padding-right: 3%; translate: 0% -50%; cursor: pointer;">See More</button></a>
            <p class="paja">A Truly EXtraordinary Experience</p>
            {{-- Style= "Translate: X Y" --}}
        </div>
    </div>

    <!-- Visit Destination End -->


    <!-- Hero Visit Homestay and Culinary Start -->
    <div class="service">
      <div style="text-align: center" class="serviceTittle">
          <h1 style="font-weight: bold; color: #4CC417">OUR SERVICE PRODUCT</h1>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-6">
            <h4 class="serviceSubTittle">
                Choose The Place Where you want to Visit
            </h4>
              <div class="imgContainer">
                  <img src="{{Storage::url($destination->photo)}}" class="imgService">
                    <a href="/culinary"><button class="serviceButton">See More</button></a>
                  <p class="mt-3">   Menjelajahi tempat-tempat wisata yang menyenangkan!</p>
              </div>
          </div>

          <div class="col-6">
            <h4 class="serviceSubTittle">
                Explore a Different Way Culinary Experience
            </h4>
              <div class="imgContainer">
                  <img src="{{Storage::url($culinary->photo)}}"  class="imgService">
                    <a href="/homestay"><button class="serviceButton">See More</button></a>
                  <p class="mt-3"> Menjelajahi makanan-makanan yang enak!</p>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection

  <!-- Visit Homestay and Culinary End -->
