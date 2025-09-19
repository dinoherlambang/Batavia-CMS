<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// All admin functionality is now handled by Filament Admin Panel
// Access at: http://localhost:8000/admin
