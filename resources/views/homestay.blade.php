@extends('template.template')

@section('title', 'Homestay - Rumah Hijau')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<!-- Kotak 1 Start -->
<div class="mainMenu">
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
                    <form>
                        <input type="date" id="birthday" name="birthday" style="border: solid 0px;">
                    </form>
                </li>
            </ul>

            <ul style="width : 20%; border-color: #25b448; margin: 1%">
                <li style="list-style: none; color: #25b448;">
                    Check Out:
                </li>

                <li style="list-style: none">
                    <form>
                        <input type="date" id="birthday" name="birthday" style="border: solid 0px;">
                    </form>
                </li>
            </ul>

            <ul style="width : 25%">
                <li style="list-style: none; margin-left: -60px; color: #25b448; display: flex;">
                    <div class="searchWrap-2">
                        <div class="searchBox-2">
                            <input type="text" class="input" placeholder="Search Culinary.." id="searchBox">
                            <div class="btn">
                                <button onclick="search()">Search</button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Kotak 1 End -->

<!-- Price Range Start -->
<div class="homestayContainer sectionContainer" id="homeStay">
    <ul>
        <li style="list-style: none">
            <P style="color: #25b448">
                <b>
                    Price Range
                </b>
            </P>

            <div style="width: 100%; display: flex">
                <input type="text" class="query form-control" name="min_price" id="inputPrice1" placeholder="min"
                    style="width: 100px; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
                <input type="text" class="query form-control" name="max_price" id="inputPrice2" placeholder="max"
                    style="margin-left: 20px; width: 100px; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
            </div>

            <p style="margin-top: 5%; color: #25b448">
                <b>
                    Sort by
                </b>
            </p>

            <div style="width: 100%; margin-top: -5%; display: flex;">
                <input type="radio" class="query form-control" name="sort" {{ $sort == "price_asc" ? "checked" : ""}} value="price_asc" id="1" placeholder="min"
                    style="width: 15px;" value="1">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Lowest Price
                </p>
            </div>

            <div style="width: 100%; margin-top: -5%; display: flex;">
                <input type="radio" class="query form-control" name="sort" {{ $sort == "price" ? "checked" : ""}} value="price" id="2" placeholder="min"
                    style="width: 15px;" value="2">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Highest Price
                </p>
            </div>


            <div style="width: 100%; margin-top: -5%; display: flex;">
                <input type="radio" class="query form-control" name="sort" {{ $sort == "rating" ? "checked" : ""}} value="rating" id="3" placeholder="min"
                    style="width: 15px;" value="3">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Highest Rating
                </p>
            </div>

            <p style="margin-top: 2%; color: #25b448">
                <b>
                    Facilities
                </b>
            </p>

            <div style="width: 100%; margin-top: -5%; display: flex;">
                <input type="checkbox" class="query form-control" {{ in_array("wifi", $filters) ? "checked" : ""}} name="filter" value="wifi" id="1" placeholder="min"
                    style="width: 15px;" value="1">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Wifi
                </p>
            </div>

            <div style="width: 100%; margin-top: -5%; display: flex;">
                <input type="checkbox" class="query form-control" {{ in_array("parking", $filters) ? "checked" : ""}} name="filter" value="parking" id="2" placeholder="min"
                    style="width: 15px;" value="2">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    Parking
                </p>
            </div>

            <div style="width: 100%; margin-top: -5%; display: flex;">
                <input type="checkbox" class="query form-control" {{ in_array("ac", $filters) ? "checked" : ""}} name="filter" value="ac" id="3" placeholder="min"
                    style="width: 15px;" value="3">
                <p style="margin-top: 2.2%; margin-left: 3%">
                    AC
                </p>
            </div>
            <div style="width: 100%; margin-top: -5%; display: flex;">
                <input type="checkbox" class="query form-control" {{ in_array("restaurant", $filters) ? "checked" : ""}} name="filter" value="restaurant" id="4" placeholder="min"
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
        <li class="homestayListContainer">
            <div style="width: 100%; height: 100%;">
                <div class="listContentContainer">
                    <ul class="homestayImg">
                        <li style="list-style: none; width: 100%;">
                            <div style="max-width: 100%; height: auto; text-align: center;">
                                <img src="{{ Storage::url($data->homestayPhoto[0]->path) }}" alt="Thumbnail" style="max-width: 100%; height: 280px; width: 400px; border-radius: 10px; object-fit: cover;">
                            </div>
                        </li>
                    </ul>
                    <ul class="homestayName">
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
                                @if ($data->has_wifi==1)
                                <i class="fa fa-wifi"></i>
                                @endif
                                @if ($data->has_restaurant==1)
                                <i class="fa fa-cutlery"></i>
                                @endif
                                @if ($data->has_parking==1)
                                <i class="fa fa-product-hunt"></i>
                                @endif
                                @if ($data->has_ac==1)
                                <img width="18px" src="/gambar/Vector.svg" alt="">
                                @endif
                            </h5>
                        </li>
                    </ul>

                    {{-- harga dan detail homestay --}}
                    <ul class="homestayPrice">
                        <li style="list-style: none;">
                            <h5>
                                IDR {{$data->price}}/night
                            </h5>
                        </li>

                        <li style="list-style: none;">
                            <a href="{{route('homestayDetailPage', $data->id)}}">
                                <button type="submit"
                                    class="btn btn-primary"
                                    style="width: 80%; background: linear-gradient(to right, #27b448, #72b426); border-radius: 10px">
                                    Details</button>
                            </a>
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

<script>
function search() {
    var searchBox = document.getElementById('searchBox');
    var searchParams = new URLSearchParams(window.location.search);

    if (searchBox.value) {
        searchParams.set("q", searchBox.value);
    }
    else {
        searchParams.delete("q");
    }

    window.location.search = searchParams;
}

function updateQuery(c) {
    var searchParams = new URLSearchParams(window.location.search);

    switch (c.target.name) {
    case "min_price":
        searchParams.set("min_price", c.target.value);
        break;
    case "max_price":
        searchParams.set("max_price", c.target.value);
        break;
    case "sort":
        searchParams.set("sort", c.target.value);
        break;
    case "filter":
        const filters = document.getElementsByName("filter");
        let fs = [];
        for (let i = 0; i < filters.length; i++) {
            if (filters[i].checked) {
                fs.push(filters[i].value);
            }
        }
        if (fs.length > 0) {
            searchParams.set("filter", fs.toString());
        }
        else {
            searchParams.delete("filter");
        }
        break;
    default:
        break;
    }

    window.location.search = searchParams;
}

var controls = document.getElementsByClassName("query");
for (var i = 0; i < controls.length; i++) {
    controls[i].onchange = updateQuery;
}
</script>

@endsection
