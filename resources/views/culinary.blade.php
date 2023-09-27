@extends('template.template')

@section('title', 'Culinary - Rumah Hijau')

@section('content')
<!-------------------------- Sort-Start -------------------------------->
<div class="culinaryContainer sectionContainer">
    <ul>
            <li style="list-style: none">
                <P style="color: #25b448">
                    <b>
                        Price Range
                    </b>
                </P>

                <div style="width: 100%; display: flex">
                    <input type="text" class="query form-control" id="inputPrice1" placeholder="min"
                        style="width: 100px; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
                    <input type="text" class="query form-control" id="inputPrice2" placeholder="max"
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
                        Type
                    </b>
                </p>

                <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                    <input type="checkbox" class="query form-control" {{ in_array("side_dish", $filters) ? "checked" : "" }} id="1" name="filter" value="side_dish" placeholder="min"
                        style="width: 15px;" value="1">
                    <p style="margin-top: 2.2%; margin-left: 3%">
                        Side dishes
                    </p>
                </div>

                <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                    <input type="checkbox" class="query form-control" {{ in_array("dessert", $filters) ? "checked" : "" }} name="filter" value="dessert" id="2" placeholder="min"
                        style="width: 15px;" value="2">
                    <p style="margin-top: 2.2%; margin-left: 3%">
                        Dessert
                    </p>
                </div>

                <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                    <input type="checkbox" class="query form-control" {{ in_array("main_course", $filters) ? "checked" : "" }} name="filter" value="main_course" id="3" placeholder="min"
                        style="width: 15px;" value="3">
                    <p style="margin-top: 2.2%; margin-left: 3%">
                        Main Course
                    </p>
                </div>
            </li>
        </ul>

        <!-------------------------- Sort-End -------------------------------->

        <!-------------------------- Menu-Start -------------------------------->
        <li style="list-style: none; width:75%;">
            <div style="display:flex; justify-content:space-between">
                <div class="culinarySubTittle">
                    <strong>
                        What's
                    </strong>
                    <span>
                        NEW!
                    </span>
                </div>
                <div class="searchWrap">
                    <div class="searchBox">
                        <input type="text" class="input" placeholder="Search Culinary.." id="searchBox">
                        <div class="btn">
                            <button onclick="search()">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="imgContainer">
                <img src="/gambar/cul.svg" width="100%" style="border-radius: 10px; margin-top:20px; margin-bottom:20px; object-fit: cover;">
            </div>

            <div class="culinaryFoodContainer" id="list-item">
                @foreach ($culinaries as $data)
                <div class="culinaryImgContainer">
                    <td><img class="culinaryImg" src="{{Storage::url($data->photo)}}" alt=""></td>
                    <p>{{$data->name}}</p>
                    <div class="culBtn">
                        <button class="openBtnCulinary" onclick="openForm('{{ $data->id }}')">More</button>
                        <p class="culinaryPrice">Rp.{{$data->price}}</p>
                    </div>
                </div>
                @endforeach
                {!! $culinaries->links('pagination::bootstrap-5') !!}
            </div>
        </li>
    </ul>
</div>
    <!------------------------------------- Popup-Gambar-Start -------------------------->


@foreach ($culinaries as $data)
<div id="myOverlay{{$data->id}}" class="overlayCulinary">
    <div class="wrapCulinary">
        <span class="ratingCulinary" title="Rating">
        </span>

        <span class="closebtnCulinary" onclick="closeForm('{{$data->id}}')" title="Close"> X </span>
        <div id="likeBtn"  class="rates" onclick="likeIncrease()">
            <!-- <form action="" method="post"> -->
                {{$data->like/1000}}K <i class="fa fa-thumbs-up"></i>
            <!-- </form> -->
        </div>
        <div style="text-align: center">
            <b style="color:black; font-size: 200%">Menu Description</b>
        </div>
        <div class="culOverlayImgContainer">
        <td><img class="culOverlayImg" src="{{Storage::url($data->photo)}}" alt=""></td>
            <div class="culMenu" >
                <h3>{{$data->name}}</h3>
                <p style="text-align: justify">
                    {{$data->description}}
                </p>
            </div>
        </div>
        <form>
            <div class="culOverlayBtn">
                <div>
                    Rp. {{$data->price}}
                    <a href="https://api.whatsapp.com/send?phone=6285155488011&text=Saya%20Ingin%20Memesan%20Makanan%20{{ $data->name }}" target="_blank"><button style="cursor: pointer;" type="button">Order Food</button></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>

// const likeBtn = document.getElementById('likeBtn');

// likeBtn.setAttribute('style','background-color: black;');

// likeBtn.addEventListener('click', function(){
//     document.querySelector('rates').style.backgroundColor = 'red';
// })

// likeBtn.addEventListener('click', function() {
//     setAttribute('style','color: red;');
// })

// function likeIncrease(){
//   console.log('ke click');
//   counter.textContent = Number(counter.textContent) + 1;
// }


function openForm(id) {
    console.log(id);
    namess = "myOverlay" + id;
    document.getElementById(namess).style.display = "block";
}

function closeForm(id) {
    namess = "myOverlay" + id;
    document.getElementById(namess).style.display = "none";
}

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
</script>
<!------------------------------------- Popup-Gambar-End -------------------------->
@endsection