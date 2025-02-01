<?php


Route::middleware('web')->group( function() {

    Route::get('/bible/test/{ref}', function($ref) {
        $parser = new \AscentCreative\BibleRef\Parser();
        dump($parser->parseBibleRef($ref));
    });

    Route::get('/bibleref/parse/{term}', [AscentCreative\BibleRef\Controllers\BibleRefController::class, 'parse']);

}); //->middleware('web');

