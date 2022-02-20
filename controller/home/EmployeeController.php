<?php

namespace controller\home;

use core\{Functions,Html,Request,Controller};
use model\{Employee,Department};

class EmployeeController extends Controller{
	private $view = 'home/index';

	public function __construct() { $this->view = Functions::view($this->view); }

	public function index():string{
		$employees = (new Employee())->getEmployees();
		$departments = (new Department())->where(['delete' => false])->get();

		Html::addVariables([
			'body' => Functions::view('home/employee/employees', 
				[
					'employees' => $employees, 
					'departments' => $departments
				]
			)
		]);
		return $this->view;
	}

	public function show($id):string{
		return Functions::view('');
	}

	public function update(Request $request):string{
		return Functions::view('');
	}

	public function destroy(Request $request):string{
		return Functions::view('');
	}
}