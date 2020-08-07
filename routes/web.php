<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * Login/Register/Home Routes
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
});

/**
 * Dashboard Routes
 */
Route::group([
    'middleware' => 'auth',
    'namespace' => 'Dashboard'
], function() {

    /**
     * Contracts Routes
     */
    Route::resource('contracts', 'ContractController');
    Route::any('home/contract/search', 'ContractController@search')->name('contracts.search');

    /**
     * Units Routes
     */
    Route::resource('units', 'UnitController');
    Route::any('home/units/search', 'UnitController@search')->name('units.search');

    /**
     * Members Routes
     */
    Route::resource('members', 'MemberController');
    Route::any('home/members/search', 'MemberController@search')->name('members.search');

    /**
     * Attestation Routes
     */
    Route::resource('attestations', 'AttestationController');
    Route::any('home/attestations/search', 'AttestationController@search')->name('attestations.search');
});