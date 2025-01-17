@extends('template.admintemplate')

@section('title', 'Create Souvenir - Rumah Hijau')

@section('content2')
<style>
    form {
        box-sizing: border-box;
        padding: 30px 50px;
    }

</style>

<form method='POST' enctype="multipart/form-data" action="{{ route('adminAddTable', 'souvenir') }}">
    @csrf
    <div class="form-group">
        <label for="name">Name Souvenir</label>
        <input id="name" type="text" class="form-control" name='name' placeholder="Parfume Peony">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description Souvenir</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Price Souvenir</label>
        <input id="price" type="number" class="form-control" name='price' placeholder="10000">
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Image Souvenir</label>
        <input id="image" type="file" class="form-control" name='image'  accept=".png,.jpg,.jpeg">
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Add Souvenir') }}</button>
</form>

@endsection
