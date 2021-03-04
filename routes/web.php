<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
################## Dashboard
    Route::resource('/','DashboardController');

################## Secteurs
    Route::resource('secteurs','SecteurController');

################## Indicateurs
    Route::resource('indicateurs','IndicateurController');

################## Unites
    Route::resource('unites','UniteController');

################## Objectifs
    Route::resource('objectifs','ObjectifController');

################## type credit
    Route::resource('typeCredit','TypeCreditController');

################## Actions
    Route::resource('actions','ActionController');

################## Regions
    Route::resource('regions','DRController');

################## qualites
    Route::resource('qualites','QualiteController');

################## Attributions
    Route::resource('attributions','AttributionController');

################## Dpci
    Route::resource('dpci','DpciController');

################## Axes
    Route::resource('axes','AxeController');

});



