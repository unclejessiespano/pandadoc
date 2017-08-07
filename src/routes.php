<?php

Route::get('panda', function(){
    echo 'panda panda panda';
});
Route::get('add/{a}/{b}', 'Bigandbrown\Pandadoc\PandadocController@add');
Route::get('subtract/{a}/{b}', 'Bigandbrown\Pandadoc\PandadocController@subtract');