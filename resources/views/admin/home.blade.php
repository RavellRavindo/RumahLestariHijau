@extends('template.admintemplate')
@section('title', 'Admin Home')

@section('content2')
    <link rel="stylesheet" href="/css/adminhome.css">
    <div class="kontainer">
        <a href="{{ route('homePage') }}">Home</a>
        <a href="{{ route('adminTablePage', 'homestay') }}">Homestay</a>
        <a href="{{ route('adminTablePage', 'culinary') }}">Culinary</a>
        <a href="{{ route('adminTablePage', 'destination') }}">Destination</a>
        <a href="{{ route('adminTablePage', 'promo') }}">Promo</a>
        <a href="{{ route('adminTablePage', 'souvenir') }}">Souvenirs</a>
    </div>
@endsection
