<?php

namespace app\controllers;

use flight\Engine;
use app\repositories\CaisseRepository;

class CaisseController
{
    protected Engine $app;
    protected CaisseRepository $caisseRepository;

    public function __construct(Engine $app, CaisseRepository $caisseRepository)
    {
        $this->app = $app;
        $this->caisseRepository = $caisseRepository;
    }

    public function showAllCaisse()
    {
        $caisses = $this->caisseRepository->findAll();

        $this->app->render('layout.php', [
            'caisses' => $caisses,
            'errors'  => [],
            'page' => 'list-caisses.php'
        ]);
    }
}