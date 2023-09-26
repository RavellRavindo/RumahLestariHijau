
@extends('template.template')

@section('title', 'Homestay - Rumah Hijau')

@section('content')


<div id="homeStayDetail{{$data->id}}" style="width:100%; box-sizing: border-box; padding: 5%;">
    <a href="{{route('homestayPage')}}">
        <button type="submit"
            class="btn btn-primary mb-2"
            style="width: 10%; background: linear-gradient(to right, #27b448, #72b426); border-radius: 15px"> Go Back
        </button>
    </a>

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
    </div>
</div>

@endsection