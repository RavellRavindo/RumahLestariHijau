@extends('template.logintemplate')

@section('title', 'Homestay - Rumah Hijau')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" type="text/css" href="boostrap.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="loginContainer">
        <img class="loginImg" src="gambar/logo_white.jpeg">
        <form method="POST" action="/login">
            @csrf

            <input type="email" id="email" name="email" placeholder="Enter your email"
                style="width: 90%; height: 40px; margin: 3%">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div style="text-align: right; padding-right: 4%; font-size: 75%; font-weight: bold"><a href="/forgot"
                    style="text-decoration: none">Forgot Password?</a></div>
            <input type="password" id="password" placeholder="Enter your password" name="password"
                style="width: 90%; height: 40px; margin-bottom: 10%">
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <button type="submit"
                style="padding: 3%; padding-right: 10%; padding-left: 10%; border: none; background-color: rgb(37, 209, 37); color: white; border-radius: 5px; box-shadow: 2px 4px 6px black">
                Login</button>
            <p style="text-align: right; font-size: 75%; padding: 2%">Don't have an Account? <a href="/register"
                    class="signUpHere">Sign up here</a></p>
        </form>
    </div>
</body>

</html>
