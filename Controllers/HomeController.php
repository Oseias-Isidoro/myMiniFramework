<?php

require_once __DIR__.'/../Models/Product.php';

class HomeController
{
    public function index(Request $request)
    {
        View::show('home.phtml', [
            'title' => (new Product())->find(1)
        ]);
    }
}