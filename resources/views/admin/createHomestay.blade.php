@extends('template.admintemplate')

@section('title', 'Create Homestay - Rumah Hijau')

@section('content2')


<style>
    form {
        box-sizing: border-box;
        padding: 30px 50px;
    }

</style>

<form method='POST' action="{{ route('adminAddTable', 'homestay') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Homestay Name</label>
        <input id="name" type="text" class="form-control" name='name' placeholder="Homestay">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="host">Homestay Host</label>
        <input id="host" type="text" class="form-control" name='host' placeholder="host">
        @error('host')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="location">Homestay Location</label>
        <input id="location" type="text" class="form-control" name='location' placeholder="Jakarta">
        @error('location')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="address">Homestay Address</label>
        <input id="address" type="text" class="form-control" name='address' placeholder="Jl. Pulomas Jaya Via, Jl. Kayu Putih Raya, RW.16, Kayu Putih, Pulo Gadung, East Jakarta City, Jakarta 13210">
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="price">Homestay Price / Night</label>
        <input id="price" type="text" class="form-control" name='price' placeholder="300000">
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="guest">Guest Room Capacity</label>
        <input id="guest" type="number" class="form-control" name='guest' placeholder="5">
        @error('guest')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="bedroom">Bedroom Capacity</label>
        <input id="bedroom" type="number" class="form-control" name='bedroom' placeholder="2">
        @error('bedroom')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="bed">Bed/room</label>
        <input id="bed" type="number" class="form-control" name='bed' placeholder="2">
        @error('bed')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="bath">Bath/room</label>
        <input id="bath" type="number" class="form-control" name='bath' placeholder="2">
        @error('bath')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <p>Resource</p>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="wifi" name="wifi" value="1">
            <label class="form-check-label" for="wifi">Wifi</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="parking" name="parking" value="1">
            <label class="form-check-label" for="parking">Parking</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="restaurant" name="restaurant" value="1">
            <label class="form-check-label" for="restaurant">Restaurant</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="ac" name="ac" value="1">
            <label class="form-check-label" for="ac">AC</label>
        </div>
    </div>


    <div class="form-group">
        <label for="thumbnail">Upload Thumbnail Homestay</label>
        <input id="thumbnail" type="file" class="form-control" name='thumbnail' placeholder="Example input"
            accept=".png,.jpg,.jpeg">
        @error('thumbnail')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="upload">Upload Foto Homestay</label>
        <input id="upload" type="file" multiple class="form-control" name='upload' placeholder="Example input"
            accept=".png,.jpg,.jpeg">
        @error('upload')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Add Homestay') }}</button>
</form>

{{-- <div class="mapouter">
    <div class="gmap_canvas">
        <iframe width="770" height="510" id="gmap_canvas" src="https://maps.google.com/maps?q=Jalan Asia Afrika Senayan, RT.1/RW.3, Gelora, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        <a href="https://2yu.co">2yu</a><br>
        <style>.mapouter{position:relative;text-align:right;height:510px;width:770px;}</style>
        <a href="https://embedgooglemap.2yu.co">html embed google map</a>
        <style>.gmap_canvas {overflow:hidden;background:none!important;height:510px;width:770px;}</style>
    </div>
</div> --}}

@endsection
