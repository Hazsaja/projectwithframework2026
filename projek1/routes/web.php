<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


Route::get('/user/{id}', function($id){
    if ($id > 50) {
        return 'i Like yes';
    } else{
        return 'Id = '. $id;
    }
})-> where('id', '[0-9]+');

Route::get('/profile', function(){
    return 'Halaman Profile';
})->name('biodata');

Route::get('/home', function(){
    return '<a href="'. route('biodata'). '">Profile</a>';
});

Route::get('/about', function(){
    return '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About</title>
        <style>

            th{
                text-align: center;
            }

            td{
                text-align: left;
            }

            #gambar{
                width: 180px; 
                height: 220px;
                border-radius: 50%;
            }

            .margin{
                margin-bottom: 30px;
            }

            #wawancara.margin{
                margin-top: 30px;
            }

        </style>
    </head>
    <body background="img/background.jpg">
        <h1>About Me</h1>

        <img src="img/foto1.jpeg" alt="myPicture" id="gambar">

        
        <table border="1" style="width: 30%;">
            <tr>
                <th>Nama</th>
                <td>Hazel Muhammad Naufal Ribawa</td>
            </tr>
            <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td>Kota Bekasi, 24 Oktober 2005</td>
            </tr>
            <tr>
                <th>Pendidikan</th>
                <td>S1 Informatika</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>hazel.ribawa@gmail.com</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>0787-5501-4341</td>
            </tr>
        </table><br>

    </body>
    </html>';
});