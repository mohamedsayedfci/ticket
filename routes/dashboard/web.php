<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'WelcomeController@index')->name('welcome');

            //category routes
            Route::resource('tickets', 'TicketController')->except(['show']);
            Route::get('tickets/changeStatus/{Status}', 'TicketController@changeStatus')->name('tickets.changeStatus');

            //product routes

            //user routes
            Route::resource('users', 'UserController')->except(['show']);

        });//end of dashboard routes
    });


