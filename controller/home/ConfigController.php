<?php

namespace controller\home;

use core\{Controller,Functions, Html, Request};

class ConfigController extends Controller{
    private $view = 'home/index';

    public function __construct()
    {
        $this->view = Functions::view($this->view);
    }

    public function options(){
        Html::addVariable('body', Functions::view('home/config/options'));
        return $this->view;
    }

    public function activity(){
        Html::addVariable('body', Functions::view('home/config/options'));
        return $this->view;
    }
}