@extends('template.template')

@section('title', 'Destination - Rumah Hijau')

@section('content')

<style>
.destinasiCheckDetail{
    font-weight: bold;
    color: white;
    background: green;
    /* background: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet); */
    width: 100%;
    padding: 5%;
    cursor: pointer;
}

.destinasiCheckDetail:hover{
    font-weight: bold;
    color: white;
    background: green;
    /* background: linear-gradient(to right, red, orange); */
    width: 100%;
    padding: 5%;
}
</style>

<div style="text-align: center; font-weight: bold; padding: 2%; padding-left: 20%; padding-right: 20%">
    <p style="color:rgb(17, 187, 17); font-size: 200%">Special Event</p>
    <p style="color:rgb(0, 87, 0); font-size: 150%">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque quis amet animihic eveniet </p>
</div>

<div id="carousel">
    {{---------------- LOOPING SPECIAL EVENT LIST ----------------}}
    @foreach ($des as $data)

    <div style="object-fit: contain ;background: linear-gradient(180deg, rgba(9, 66, 34, 0.15) -12.86%, rgba(59, 77, 129, 0.5) 106.85%, rgba(9, 66, 34, 0.5) 106.85%), url('{{Storage::url($data->photo)}}'); height: 377px; width: 312px;position:relative; border-radius: 10px; box-sizing: border-box; padding: 20px;" class="destinasiSlide">

        {{-- <img style="filter: linear-gradient(180deg, rgba(9, 66, 34, 0.15) -12.86%, rgba(59, 77, 129, 0.5) 106.85%, rgba(9, 66, 34, 0.5) 106.85%)" src="{{Storage::url($data->photo)}}" class="destinasiImage"> --}}
        <a style="position:absolute; transform: translate(-50%, -50%); top:50%; left:50%; ;border: 1px solid white; color: white; background-color: transparent; ; font-size: 100%; padding: 4%; padding-left: 10%; padding-right: 10%; border-radius: 10px" href="{{route('destinationDetail', $data->id)}}">
            View Detail
        </a>
        <label style="background-color: green; padding: 2%; padding-left: 5%; padding-right: 5%;">Hot Offer</label>
        <div class="testt" style="width: 80%; display: flex; justify-content: space-between; position: absolute; bottom: 10px;">
            <label style=""><i class="fa fa-map-marker" style="font-size: 150%"></i>&nbsp;&nbsp;&nbsp;Jakarta</label>
            <label style=""><i class="fa fa-arrows-alt" style="font-size: 150%"></i>&nbsp;&nbsp;&nbsp;10 pax</label>
        </div>
    </div>
    @endforeach
    {{---------------- LOOPING SPECIAL EVENT LIST END ----------------}}

</div>

<div style="text-align:center; font-weight: bold">
    <p style="color: green; font-size: 250%; margin-top: 5%">Open Trip <u>KEPULAUAN SERIBU</u></p>
    <p style="color: rgb(0, 59, 0); font-size: 200%">Lestari Liveboard, Your second home at sea</p>
</div>

<div style="padding: 5%; padding-left: 7%">
    {{---------------- LOOPING OPEN TRIP LIST ----------------}}
    @foreach ($des as $data)

    <div style="width: 30%; box-shadow: 1px 8px 8px 4px gray; padding: 1%; display: inline-block; margin: 1%">
        <p style="text-align: center; font-weight: bold; color: green">{{$data->name}}</p>
        <img src="{{Storage::url($data->photo)}}" style="width: 100%">
        <p style="text-align: justify; padding: 3%; padding-top: 7%">{{$data->description}}</p>
        <a href="{{route('destinationDetail', $data->id)}}"><button class="destinasiCheckDetail">Check Detail</button></a>
    </div>
    @endforeach
    {{---------------- LOOPING OPEN TRIP LIST END ----------------}}

</div>

<script>
const carousel = document.querySelector('#carousel');
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
    const walk = (x - startX) * 2;
    carousel.scrollLeft = scrollLeft - walk;
});
</script>

@endsection
