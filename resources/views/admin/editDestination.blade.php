@extends('template.admintemplate')

@section('title', 'Create Destination - Rumah Hijau')

@section('content2')
<style>
    form {
        box-sizing: border-box;
        padding: 30px 50px;
    }

</style>

<form method='POST' enctype="multipart/form-data" action="{{ route('adminEditTable', ['destination', $destination->id]) }}">
    @csrf
    <div class="form-group">
        <label for="name">Name Destination</label>
        <input id="name" type="text" value="{{$destination->name}}"class="form-control" name='name' placeholder="Outbond Kuta Bali">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description Destination</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$destination->description}}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="rundown">Rundown Destination</label>
        <textarea class="form-control" name="rundown" id="rundown" cols="30" rows="10">{{$destination->rundown}}</textarea>
        @error('rundown')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="address">Address Destination</label>
        <input class="form-control" name="address" value="{{$destination->address}}" id="address" placeholder="Jl. Anggrek No. 21">
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="address">Price Destination</label>
        <input id="price" type="number" class="form-control" name='price' value="{{$destination->price}}" placeholder="100000">
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Image Destination</label>
        <input id="image" type="file" class="form-control" name='image'  accept=".png,.jpg,.jpeg">
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Edit Destination') }}</button>
</form>


@endsection
