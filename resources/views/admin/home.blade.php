@extends('template.admintemplate')
@section('title', 'Admin Home')

@section('content2')
    <link rel="stylesheet" href="/css/adminhome.css">
    <div class="kontainer">
        <a href="/">Home</a>
        <a href="/homestay">Homestay</a>
        <a href="/culinary">Culinary</a>
        <a href="/destination">Destination</a>
        <a href="/promo">Promo</a>
        <a href="/souvenir">Souvenirs</a>
    </div>
@endsection
