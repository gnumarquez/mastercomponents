<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web','auth','can:manage users'])->group(function()
{
	Route::get('/users',\Gnumarquez\Http\Livewire\UsersComponent::class);
});
	