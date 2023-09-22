@extends('template.template')

@section('title', 'Culinary - Rumah Hijau')

@section('content')
<style>
    .culinaryBtn {
        border-radius: 30px;
        padding: 8px;
    }
</style>

<!-------------------------- Sort-Start -------------------------------->
<div class="sectionContainer" style="display: grid; grid-template-columns: 20% 80%; gap: 10%; margin-top: 80px;">
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
                        Type
                    </b>
                </p>

                <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                    <input type="radio" class="form-control" name="facilities" id="1" placeholder="min"
                        style="width: 15px;" value="1">
                    <p style="margin-top: 2.2%; margin-left: 3%">
                        Side dishes
                    </p>
                </div>

                <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                    <input type="radio" class="form-control" name="facilities" id="2" placeholder="min"
                        style="width: 15px;" value="2">
                    <p style="margin-top: 2.2%; margin-left: 3%">
                        Dessert
                    </p>
                </div>

                <div style="width: 100%; margin-top: -5%; display: flex; align-items:center;">
                    <input type="radio" class="form-control" name="facilities" id="3" placeholder="min"
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
            <h3>
                <div style="width: 50%; float: left;">
                    <b style="color: #25b448; font-size: 40px;">
                        What's
                    </b>
                    <b style="color: #094222; font-size: 40px;">
                        NEW!
                    </b>
                </div>
                <div class="culinarySearch" style="width: 50%; float: left;">
                    <form class="example" action="/action_page.php" style="margin:auto;">
                        <input type="text" placeholder="What you looking for.." name="search2" style="width: 250px; padding:8px; border-radius:30px; ">
                        <button class="culinaryBtn" type="submit">Search</button>
                    </form>
                </div>
            </h3>
            <div class="imgContainer">
                <img src="/gambar/cul.svg" width="100%" style="border-radius: 10px; margin-top:20px; margin-bottom:20px; object-fit: cover;">
            </div>

            <div id="list-item" style="display:inline-block; width: 100%;">
                @foreach ($culinaries as $data)
                <div style="width:30%; margin-left:2.5%; margin-bottom: 5%; display:inline-block;">
                    <td><img src="{{Storage::url($data->photo)}}" alt="" style="border-radius:5%; width: 95%; height: 200px; object-fit: cover;"></td>
                    <p style="font-weight: bold; margin-top: 2%;">{{$data->name}}</p>
                    <button class="openbtnCulinary" onclick="openForm('{{ $data->id }}')">More</button>
                </div>
                @endforeach
                {!! $culinaries->links('pagination::bootstrap-5') !!}
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
        <div class="rates">
            {{$data->like/1000}}K <i class="fa fa-thumbs-up"></i>
        </div>
        <div style="text-align: center">
            <b style="color:black; font-size: 200%">Menu Description</b>
        </div>
        <div class="cons">
        <td><img src="{{Storage::url($data->photo)}}" alt="" style="border-radius:5%; width: 45%; height: 230px; object-fit: cover; margin-top:4%;"></td>
            <div style="text-align: center; width: 400px">
                <h3>{{$data->name}}</h3>
                <p style="text-align: justify">
                    {{$data->description}}
                </p>
            </div>
        </div>
        <form>
            <div class="con2">
                <div>
                    Rp. {{$data->price}}
                    <a href="https://api.whatsapp.com/send?phone=6285155488011&text=Saya%20Ingin%20Memesan%20Makanan%20{{ $data->name }}" target="_blank"><button style="cursor: pointer;" type="button">Order Food</button></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
{{-- <div style="margin-top: 5%; margin-left: 10%"><b>Annonymous</b></div>
            <i style="margin-left: 10%" class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
            <div style="margin-top: 1%; margin-left: 10%; margin-right: 50%; text-align: justify">Lorem ipsum dolor
                sit amet consectetur adipisicing elit. Ducimus harum quasi cupiditate eveniet eos dicta officia qui
                nemo nostrum, soluta facere sapiente, veniam ipsam consectetur laudantium iste blanditiis at. Eum!
</div> --}}


<script>
    function openForm(id) {
        console.log(id);
        namess = "myOverlay" + id;
        document.getElementById(namess).style.display = "block";
    }

    function closeForm(id) {
        namess = "myOverlay" + id;
        document.getElementById(namess).style.display = "none";
    }
</script>
<!------------------------------------- Popup-Gambar-End -------------------------->
@endsection
