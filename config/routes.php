<?php

use Slim\App;

return function (App $app) {
    //login
    $app->get('/', \App\Action\LoginAction::class)->setName('login');
    $app->get('/authentication/{username}/{password}', \App\Action\UserReadAction::class . ':authentication');

    //pages
    $app->get('/home', \App\Action\PageAction::class)->setName('home');
    $app->get('/page_kelurahan', \App\Action\PageAction::class . ':page_kelurahan')->setName('kelurahan');
    $app->get('/page_pasien', \App\Action\PageAction::class . ':page_pasien')->setName('pasien');

    //kelurahan
    $app->get('/kelurahan', \App\Action\KelurahanReadAction::class);
    $app->get('/kelurahan_dropdown', \App\Action\KelurahanReadAction::class . ':kelurahan_dropdown');
    $app->post('/insert_kelurahan', \App\Action\KelurahanCreateAction::class);
    $app->put('/update_kelurahan', \App\Action\KelurahanUpdateAction::class);

    //pasien
    $app->get('/pasien', \App\Action\PasienReadAction::class);
    $app->post('/insert_pasien', \App\Action\PasienCreateAction::class);
    $app->put('/update_pasien', \App\Action\PasienUpdateAction::class);
};
