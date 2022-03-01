<?php

namespace controller\home;

use core\{Functions,Html,Request,Controller, Message, Route, Session};
use model\User;

class UserController extends Controller{
	private $view = 'home/index';

	public function __construct() { $this->view = Functions::view($this->view); }

	public function index():string{
		Html::addVariable('body', Functions::view(
			'home/user/index', 
			[
				'user' => (new User())->get()
			]
		));
		return $this->view;
	}

	public function show($id):string{
		return Functions::view('');
	}

	public function update(Request $request){
		$data = [];
		if($request->tokenIsValid()){
			$data = $request->getData();
			unset($data['id'], $data['__token']);
			(new User())->where(['id' => $request->id])->update($data);
		}
		return $request->response($data);
	}

	public function destroy(Request $request):string{
		return Functions::view('');
	}

	public function change(Request $request){
		if($request->tokenIsValid()){
			$data = $request->getData();
			$validation = $request->validate([
				'username' => [
					'empty' => false
				],'email' => [
					'empty' => false
				],'fullname' => [
					'empty' => false
				]
			]);

			
			if($validation['validation']){
				unset($data['__token']);
				if(isset($data['password'])){
					if(is_array($data['password'])){
						if($data['password'][0] == $data['password'][1]){
							if(!empty($data['password'][0]) && !empty($data['password'][1])) $data['password'] = md5($data['password']);
							else unset($data['password']);
						}else{
							Message::add('Las claves no coinciden.');
						}
					}else{
						unset($data['password']);
					}
				}
			}else{
				Message::add(join('<br>', $validation['error']));
			}

			if(!Message::exist()){
				(new User())->where(['delete' => 0, 'id' => Session::getUser('id')])->update($data);
				Session::updateUser((new User())->find(Session::getUser('id')));
				Message::add('Usuario actualizado con exito!', 'success');
			}
		}
		Route::reload('config.option');
	}

	public function newUser(Request $request){
		Functions::vdump($request->getData());
	}
}