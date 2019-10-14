<?php

Route::get('/',function (){

return redirect()->route('.home');
});

Route::middleware('accounting')->group(function () {


});

