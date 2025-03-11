<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;

Route::post('/process-domains', [DomainController::class, 'processDomains']);
Route::post('/fetch-domains', [DomainController::class, 'fetchDomains']);
