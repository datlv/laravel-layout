<?php
Route::group(
    [ 'prefix' => 'backend', 'as' => 'backend.', 'namespace' => 'Datlv\Layout', 'middleware' => config( 'layout.middleware' ) ],
    function () {
        Route::group( [ 'prefix' => 'sidebar', 'as' => 'sidebar.' ], function () {
            Route::get( '{sidebar}', [ 'as' => 'edit', 'uses' => 'SidebarController@edit' ] );
            Route::match( [ 'PUT', 'PATCH' ], '{sidebar}', [ 'as' => 'update', 'uses' => 'SidebarController@update' ] );
            Route::get( '{sidebar}/collapse', [ 'as' => 'collapse', 'uses' => 'SidebarController@collapse' ] );
        } );
        Route::group( [ 'prefix' => 'widget', 'as' => 'widget.' ], function () {
            Route::post( 'sync', [ 'as' => 'sync', 'uses' => 'WidgetController@sync' ] );
            Route::get( 'index/{group}', [ 'as' => 'index', 'uses' => 'WidgetController@index' ] );
        } );
        Route::resource( 'widget', 'WidgetController', [ 'only' => [ 'store', 'edit', 'update', 'destroy' ] ] );
    }
);
