@extends('template.template')

@section('title', 'Homestay - Rumah Hijau')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<style>

@media only screen and (max-width: 600px){
    .row .column img{
        border-radius: 15px;
    }
}
</style>

<!-- Kotak 1 Start -->
<div style="margin-top: 2%; margin-bottom: 4%; padding-left: 10%; padding-right: 10%; display: flex">
    <div style="width : 100%; height: 100%; border: groove 2px; border-radius:50px">
        <div style="display: flex; margin: 1%;">
            <ul style="width : 25%; border-right: 1px solid; border-color: #25b448; margin: 1%;">
                <li style="list-style: none; color: #25b448;">
                    Location
                </li>

                <li style="list-style: none">
                    Jakarta, Indonesia
                </li>
            </ul>

            <ul style="width : 25%; border-right: 1px solid; border-color: #25b448; margin: 1%;">
                <li style="list-style: none; color: #25b448;">
                    Check In:
                </li>

                <li style="list-style: none">
                    <form action="/action_page.php">
                        <input type="date" id="birthday" name="birthday" style="border: solid 0px;">
                    </form>
                </li>
            </ul>

            <ul style="width : 20%; border-color: #25b448; margin: 1%">
                <li style="list-style: none; color: #25b448;">
                    Check Out:
                </li>

                <li style="list-style: none">
                    <form action="/action_page.php">
                        <input type="date" id="birthday" name="birthday" style="border: solid 0px;">
                    </form>
                </li>
            </ul>

            <ul style="width : 25%">
                <li style="list-style: none; margin-left: -60px; color: #25b448; display: flex;">
                    <button type="submit" class="btn btn-primary mb-2"
                        style="width : 200px; margin-top: 20px; margin-left: 50px; background: linear-gradient(to right, #f0572e, #f0312e); border-top-left-radius: 15px; border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-bottom-left-radius: 15px">
                        Search </button>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Kotak 1 End -->

<!-- Price Range Start -->
<div class="sectionContainer"style="display: grid; grid-template-columns: 20% 90%; gap: 10%; margin-top: 50px;" id="homeStay">
    <ul>
        <li style="list-style: none">
            <P style="color: #25b448">
                <b>
                    Price Range
                </b>
            </P>

            <div style="width: 100%; display: flex">
                <input type="text" class="form-control" id="inputPrice1" placeholder="min"
                    style="width: 100px; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
                <input type="text" class="form-control" id="inputPrice2" placeholder="max"
                    style="margin-left: 20px; width: 100px; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
            </div>

            <p style="margin-top: 5%; color: #25b448">
                <b>
                    Sort by
                </b>
            </p>

            <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                <input type="radio" class="form-control" name="sort_by" id="1" placeholder="min"
                    style="width: 15px;" value="1">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Lower Price
                </p>
            </div>

            <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                <input type="radio" class="form-control" name="sort_by" id="2" placeholder="min"
                    style="width: 15px;" value="2">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    High Price
                </p>
            </div>


            <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                <input type="radio" class="form-control" name="sort_by" id="3" placeholder="min"
                    style="width: 15px;" value="3">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Most Likes
                </p>
            </div>

            <p style="margin-top: 2%; color: #25b448">
                <b>
                    Facilities
                </b>
            </p>

            <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                <input type="radio" class="form-control" name="facilities" id="1" placeholder="min"
                    style="width: 15px;" value="1">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Wifi
                </p>
            </div>

            <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                <input type="radio" class="form-control" name="facilities" id="2" placeholder="min"
                    style="width: 15px;" value="2">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Parking
                </p>
            </div>

            <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                <input type="radio" class="form-control" name="facilities" id="3" placeholder="min"
                    style="width: 15px;" value="3">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    AC
                </p>
            </div>
            <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                <input type="radio" class="form-control" name="facilities" id="4" placeholder="min"
                    style="width: 15px;" value="4">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Restaurant
                </p>
            </div>
        </li>
    </ul>

    <ul id="list-item" style="width : 75%">
        {{---------------- LOOPING HOMESTAY LIST ----------------}}
        @foreach ($homestays as $data)
        <li style="list-style: none; width: 100%; border: outset 4px; border-radius: 20px; margin-bottom: 5%">
            <div style="width: 100%; height: 100%">
                <div style="display: flex">
                    <ul style="width: 45%; padding: 2%;">
                        <li style="list-style: none; width: 100%;">
                            <div style="max-width: 100%; height: auto; text-align: center;">
                                <img src="{{ Storage::url($data->homestayPhoto[0]->path) }}" alt="Thumbnail" style="max-width: 100%; height: 280px; width: 400px; border-radius: 10px; object-fit: cover;">
                            </div>
                        </li>
                    </ul>
                    <ul style="width: 35%; padding-left: 2%; padding-top: 2%">
                        <li style="list-style: none;">
                            <h5>
                                {{$data->name}}
                            </h5>
                        </li>
                        <li style="list-style: none;">
                            @php
                            $idx = 5-$data->rating;
                            @endphp

                            @for ($i=1; $i<=$data->rating; $i++)
                                <i style="color:#ffdf00" class="bi bi-star-fill"></i>
                                @if(fmod($data->rating, 1) !== 0.00 && $i+0.5==$data->rating)
                                <i style="color:#ffdf00" class="bi bi-star-half"></i>
                                @endif
                                @endfor
                                @for ($i=1; $i<=$idx; $i++) <i style="color:#ffdf00" class="bi bi-star"></i>
                                    @endfor
                        </li>
                        <li style="list-style: none;">
                            <h5>
                                @if ($data->wifi==1)
                                <i class="fa fa-wifi"></i>
                                @endif
                                @if ($data->restaurant==1)
                                <i class="fa fa-cutlery"></i>
                                @endif
                                @if ($data->parking==1)
                                <i class="fa fa-product-hunt"></i>
                                @endif
                                @if ($data->ac==1)
                                <img width="18px" src="/gambar/Vector.svg" alt="">
                                @endif
                            </h5>
                        </li>
                    </ul>

                    {{-- harga dan detail homestay --}}
                    <ul style="width: 20%; margin-right: 2%; padding-top: 17%">
                        <li style="list-style: none;">
                            <h5>
                                IDR {{$data->price}}/night
                            </h5>
                        </li>

                        <li style="list-style: none; display: flex;">
                            <button type="submit"
                                onclick="document.getElementById('homeStayDetail{{$data->id}}').style.display='block'; document.getElementById('homeStay').style.display='none'"
                                class="btn btn-primary"
                                style="width: 100%; background: linear-gradient(to right, #27b448, #72b426); border-radius: 10px">
                                Details </button>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        @endforeach
        {!! $homestays->links('pagination::bootstrap-5') !!}
        {{---------------- LOOPING HOMESTAY LIST END ----------------}}
    </ul>
</div>

@foreach ($homestays as $data)
<div id="homeStayDetail{{$data->id}}" style="width:100%; box-sizing: border-box; padding: 5%; display: none">
    <button type="submit"
        onclick="document.getElementById('homeStayDetail{{$data->id}}').style.display='none'; document.getElementById('homeStay').style.display='flex'"
        class="btn btn-primary mb-2"
        style="width: 10%; background: linear-gradient(to right, #27b448, #72b426); border-radius: 15px"> Go Back
    </button>

    <p style="font-size: 150%; font-weight: bold">{{$data->name}}</p>
    <p style="font-weight: bold"><i class="fa fa-map-marker"></i> {{$data->location}}</p>
    <div style="font-weight: bold">
        @php
        $idx = 5-$data->rating;
        @endphp
        @for ($i=1; $i<=$data->rating; $i++)
            <i style="color:#ffdf00" class="bi bi-star-fill"></i>
            @if(fmod($data->rating, 1) !== 0.00 && $i+0.5==$data->rating)
            <i style="color:#ffdf00" class="bi bi-star-half"></i>
            @endif
            @endfor
            @for ($i=1; $i<=$idx; $i++) <i style="color:#ffdf00" class="bi bi-star"></i>
                @endfor
                {{-- &nbsp;&nbsp;&nbsp;8,9 --}}
                {{$data->like/1000}}K
                <i class="fa fa-thumbs-up"></i>
                <div style="text-align: right; translate: 0% -110%">
                    <a href="https://api.whatsapp.com/send?phone=6285155488011&text=Saya%20Ingin%20Booking%20Tempat%20{{ $data->name }}" target="_blank"
                        class="btn btn-success"
                        style="background: linear-gradient(to right, #27b448, #72b426); border-radius: 15px; padding: 1%; padding-right: 5%; padding-left: 5%; font-weight: bold; font-size: 125%">
                        Reserve
                    </a>
                </div>
    </div>


    <div class = "row mb-5">
        <div class="column">
            <img style="width: 800px; height:500px" src="{{Storage::url($data->homestayPhoto[0]->path)}}">
        </div>

        <div class="column">
            @isset ($data->homestayPhoto[1])
            <div class = "row">
                <div class="column">
                    <img src="{{Storage::url($data->homestayPhoto[1]->path)}}" style="width: 380px; height:250px">
                </div>

                @isset ($data->homestayPhoto[2])
                <div class="column">
                    <img src="{{Storage::url($data->homestayPhoto[2]->path)}}" style="width: 380px; height:250px">
                </div>
                @endisset
            </div>
            @endisset

            @isset ($data->homestayPhoto[3])
            <div class = "row">
                <div class="column">
                    <img src="{{Storage::url($data->homestayPhoto[3]->path)}}" style="width: 380px; height:250px">
                </div>
            @endisset

            @isset ($data->homestayPhoto[4])
                <div class="column">
                    <img src="{{Storage::url($data->homestayPhoto[4]->path)}}" style="width: 380px; height:250px">
                </div>
            </div>
            @endisset

        </div>
    </div>

    <script>
        function grid() {
            for (i = 0; i < elements.length; i++) {
                elements[i].style.msFlex = "50%";
                elements[i].style.flex = "50%";
            }
        }
    </script>

    <div style="display: flex;">
        <ul style="list-style: none; width: 40%">
            <li>
                <b>
                    <p style="margin: 1%; font-size: 125%">Entire hotel hosted by {{$data->owner}}</p>
                    <p style="margin-bottom: 7%">{{$data->guest}} guest - {{$data->bedroom}} bedrooms - {{$data->bed}}
                        beds - {{$data->bath}} baths</p>
                    <p style="font-size: 125%">What this places offers</p>
                    <div style="display: flex; width: 100%; translate: -5% 0%">
                        @if ($data->wifi==1)
                        <div style="width: 20%; text-align:center">
                            <i class="fa fa-wifi" style="font-size: 250%"></i>
                            <p>Wifi</p>
                        </div>
                        @endif
                        @if ($data->parking==1)
                        <div style="width: 20%; text-align:center">
                            <i style="font-size: 250%" class="fa fa-product-hunt"></i>
                            <p>Parking</p>
                        </div>
                        @endif
                        @if ($data->restaurant==1)
                        <div style="width: 20%; text-align:center">
                            <i style="font-size: 250%" class="fa fa-cutlery"></i>
                            <p>Restaurant</p>
                        </div>
                        @endif
                        @if ($data->ac==1)
                        <div style="width: 20%; text-align:center">

                            <img width="27%" src="/gambar/Vector.svg" alt="">
                            <p>AC</p>
                        </div>
                        @endif
                    </div>
                </b>
            </li>
        </ul>
        <ul style="list-style: none; width: 60%">
            <table style="width: 100%" cellpadding="10">
                <tr style="font-size: 150%">
                    <th class="NearbyPlace">Nearby Place</th>
                    <th></th>
                    <th class="PopularPlace">Popular in the Area</th>
                    <th></th>
                </tr>

                @php
                $np_count = $data->nearbyPlace->count();
                $pp_count = $data->popularPlace->count();
                $count = max($np_count, $pp_count);

                // sort by distance. jika distance sama, sort by name
                $tnp = $data->nearbyPlace->sortBy('name')->sortBy('distance')->toArray();
                $snp_name = array_column($tnp, 'name');
                $snp_distance = array_column($tnp, 'distance');

                $tpp = $data->popularPlace->sortBy('name')->sortBy('distance')->toArray();
                $spp_name = array_column($tpp, 'name');
                $spp_distance = array_column($tpp, 'distance');
                @endphp

                @for ($i = 0; $i < $count; $i++)
                    <tr>
                    @if( $i < $np_count )
                        <td>{{ $snp_name[$i] }}</td>
                        <td style="color: gray">{{ $snp_distance[$i] }} Km</td>
                    @else
                        <td></td>
                        <td></td>
                    @endif

                    @if( $i < $pp_count )
                        <td>{{ $spp_name[$i] }}</td>
                        <td style="color: gray">{{ $spp_distance[$i] }} Km</td>
                    @else
                        <td></td>
                        <td></td>
                    @endif
                    </tr>
                @endfor
            </table>
        </ul>


    </div>
    <div style="width: 100%">
        <p style="font-weight: bold; font-size: 150%">Location info</p>
        <p style="font-weight: bold"><i class="fa fa-map-marker"></i> {{$data->location}}</p>
        <div class="mapouter">
            <div class="gmap_canvas"><iframe width="100%" height="510" id="gmap_canvas"
                    src="https://maps.google.com/maps?q={{$data->address}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                    href="https://2yu.co">2yu</a><br>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                        height: 510px;
                        width: 100%;
                    }

                </style><a href="https://embedgooglemap.2yu.co">html embed google map</a>
                <style>
                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        height: 510px;
                        width: 100%;
                    }

                </style>
            </div>
        </div>
        {{-- <img src="gambar/contohgambar.png" style="width: 100%"> --}}
    </div>
</div>
@endforeach

@endsection
