<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('test-verify-email', function ()  {
//     $user = 'Fake user';
//     $url = 'http://localhost:3000/verify?token=fake-token';

//     return view('emails.verify-email', [
//         'user'=> $user,
//         "url"=> $url
//     ]);
// });
