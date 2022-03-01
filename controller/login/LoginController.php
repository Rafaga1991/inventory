<?php

namespace controller\login;

use core\{Html,Controller,Route,Session,Message,Request,Functions};
use model\User;

class LoginController extends Controller{
	public function index():string{
		Html::addVariables([
			'FOOTER' => Functions::view('footer'),
			'PROYECT_NAME' => PROYECT_NAME,
			'ACCESS' => Route::get('login.access')
		]);
		return Functions::view('login/index');
	}

	public function access(Request $request){
		$validation = $request->validate([
			'password' => [
				'empty' => false,
			],
			'username' => [
				'empty' => false
			]
		]);
		if($validation['validation']){
			if($request->tokenIsValid()){
				if($credentials = (new User())->where(['username' => $request->username, 'password' => md5($request->password), 'delete' => 0])->get()){
					Session::setUser($credentials[0], 'admin');
					Route::reload('home.index');
				}else{
					Message::add('Usuario y/o clave incorrecto.');
				}
			}else{
				Message::add('Token de formulario no valido.');
			}
		}else{
			foreach($validation['error'] as $error) Message::add($error);
		}
		Route::reload('login.index');
		return;
	}

	public function logout(){
		Session::destroyUser();
		Route::reload('login.index');
	}
}