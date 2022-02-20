<?php

namespace controller\home;

use core\{Controller, Functions, Html};
use controller\login\LoginController;

class HomeController extends Controller{
	private $view = 'home/index';

	public function __construct() { $this->view = Functions::view($this->view); }

	public function index():string{
		Html::addVariables([
			'body' => Functions::view('home/dashboard')
		]);
		// Session::destroyUser();
		return $this->view;
	}

	public function logout(){ (new LoginController())->logout(); }
}