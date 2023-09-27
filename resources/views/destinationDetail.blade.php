@extends('template.template')

@section('title', 'Destination Detail - Rumah Hijau')

@section('content')

<div class="destinationDetailContainer">
    <div class="destinationDetailContent">
        <p style="text-align:center; font-size: 150%; font-weight: bold; color: green">{{$destination->name}}</p>
        <img class="destinationDetailImg" src="{{Storage::url($destination->photo)}}">
        <div class="ets">
            <button id="DescriptionButton" class="buttonDestinationDetail"
                onclick="document.getElementById('Description').style.display='block'; document.getElementById('Rundown').style.display='none'; document.getElementById('Location').style.display='none'; document.getElementById('Price').style.display='none'">Description</button>
            <button class="buttonDestinationDetail"
                onclick="document.getElementById('Rundown').style.display='block'; document.getElementById('Description').style.display='none'; document.getElementById('Location').style.display='none'; document.getElementById('Price').style.display='none'">Rundown</button>
            <button class="buttonDestinationDetail"
                onclick="document.getElementById('Location').style.display='block'; document.getElementById('Description').style.display='none'; document.getElementById('Rundown').style.display='none'; document.getElementById('Price').style.display='none'">Location</button>
            <button class="buttonDestinationDetail"
                onclick="document.getElementById('Price').style.display='block'; document.getElementById('Description').style.display='none'; document.getElementById('Location').style.display='none'; document.getElementById('Rundown').style.display='none'">Price</button>

        </div>
        <div id="Description" style="display:none">
            <p>{{$destination->description}}</p>
            <p>Price : Rp. {{$destination->price}} / person</p>
        </div>
        <div id="Rundown" style="display:none">
            {{$destination->rundown}}
        </div>
        <div id="Location" style="display:none">
            <div class="mapouter">
                <div class="gmap_canvas"><iframe width="100%" height="510" id="gmap_canvas"
                        src="https://maps.google.com/maps?q={{$destination->maps}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
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
        <div id="Price" style="display:none">
            <table>
                <tr>
                    <td>Jumlah Peserta Tour</td>
                    <td>Harga/pax</td>
                </tr>
                @foreach ($destination->destinationPrice as $data)
                <tr>
                    <td>{{$data->min_person}}-{{$data->max_person}}</td>
                    <td>Rp. {{$data->price}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <style>
        table {
            width: 100%;
        }

        th,
        td {
            border: 1px solid gray;
            padding: 1%;
        }

        td {
            text-align: center;
        }

        tr:nth-child(odd) {
            background-color: #dddddd;
        }

    </style>
    <div class="destinationDetailForm">
        <p class="destinationDetailSubTittle">Form Reserve Destination</p>
        <p style="margin-bottom: 1%">Full Name</p>
        <input type="text" id="name">
        <p style="margin-bottom: 1%">Contact WA</p>
        <input type="number" id="number">
        <p style="margin-bottom: 1%">Number of Participants</p>
        <input type="number" id="participant">
        <p style="margin-bottom: 1%">Choice of Tour Packages</p>
        <input type="text" id="package">
        <p style="margin-bottom: 1%">Date Choice</p>
        <input type="date" id="date">
        <p style="margin-bottom: 1%">Note</p>
        <input type="text" id="note">
        <a href="#" id="reverse-button" style="background: linear-gradient(to bottom, red, orange); border: none; padding: 3%; padding-left: 10%; padding-right: 10%; float: right; border-radius: 15px; margin-top: 20%; margin-bottom: 75%; color: white">Reserve Now</a>
    </div>
</div>

<script>
    // Supaya saat halaman pertama dibuka, button deskripsi aktif
    document.getElementById('DescriptionButton').click();

     // Ambil referensi ke masing-masing elemen input dan tombol "Reverse Now"
    const nameInput = document.getElementById("name");
    const numberInput = document.getElementById("number");
    const participantInput = document.getElementById("participant");
    const packageInput = document.getElementById("package");
    const dateInput = document.getElementById("date");
    const noteInput = document.getElementById("note");
    const reverseButton = document.getElementById("reverse-button");

    // Tambahkan event listener ke tombol "Reverse Now"
    reverseButton.addEventListener("click", function(event) {
        event.preventDefault();
        const nameValue = nameInput.value;
        const numberValue = numberInput.value;
        const participantValue = participantInput.value;
        const packageValue = packageInput.value;
        const dateValue = dateInput.value;
        const noteValue = noteInput.value;

        // Buat link WhatsApp dengan data yang diambil dari input
        const message = `Ingin Destinasi dengan keterangan\nNama: ${nameValue}\nNomor Kontak: ${numberValue}\nJumlah Peserta: ${participantValue}\nPaket Wisata: ${packageValue}\nTanggal: ${dateValue}\nCatatan: ${noteValue}`;
        const link = `https://api.whatsapp.com/send?phone=6285155488011&text=${encodeURIComponent(message)}`;

        // Buka link WhatsApp
        window.open(link);
    });
</script>

@endsection
