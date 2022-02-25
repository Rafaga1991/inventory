<?php

namespace controller\home;

use core\{Functions,Html,Request,Controller, Message, Route, Session};
use model\{Assigned, Employee,Department, File, Inventory};

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

	public function add(Request $request){
		if($request->tokenIsValid()){
			(new Employee())->insert($request->employee);
			Message::add("Empleado <b>{$request->employee['name']}</b> creado con exito!", 'success');
		}
		Route::reload('employee.index');
	}

	public function show($id):string{
		if($employee = (new Employee())->find($id)){
			$inventory = (new Inventory())->getInventory("AND i.`state`='available'");
			
			$employee->department = (new Department())->find($employee->idDepartment);
			$employee->unitAssigned = (new Assigned())->getAssignedById($employee->id, 'idEmployee');
			$employee->unitLastAssigned = (new Assigned())->getLastAssigned($employee->id, 'a.idEmployee', 'a.update_at,a.create_at ASC');

			$file = (new File())->find($id);

			$employee->letterEntryExists = $file != null;

			Html::addVariables([
				'body' => Functions::view('home/employee/show', [
					'employee' => $employee, 'inventory' => $inventory
				]),
				'URL_ENTRY' => Functions::asset("doc/$file->filename.$file->extension")
			]);
		}else{
			Route::reload('employee.index');
		}
		return $this->view;
	}

	public function assigned(Request $request){
		if($request->tokenIsValid()){
			foreach($request->assigned['idInventory'] as $key => $id){
				(new Assigned())->insert([
					'idInventory' => $id,
					'state' => $request->assigned['state'][$key],
					'idEmployee' => $request->assigned['idEmployee']
				]);
				(new Inventory())->find($id)->state = 'assigned';
			}
			// Message::add('Inventario asigando a empleado con exito!', 'success');
			Route::reload('employee.show', $request->assigned['idEmployee']);
		}else{
			Route::reload('employee.index');
		}
	}

	public function assignedDestroy($id){
		if($assigned = (new Assigned())->find($id)){
			$assigned->delete = true;
			$assigned->update_at = date('Y-m-d', time());
			(new Inventory())->find($assigned->idInventory)->state = 'available';
			// Message::add('Dispositivo eliminado del empleado con exito.', 'success');
			Route::reload('employee.show', $assigned->idEmployee);
		}else{
			Route::reload('employee.index');
		}
	}

	public function update(Request $request, $id):void{
		if($request->tokenIsValid()){
			(new Employee())->where(['id' => $id])->update($request->employee);
			Message::add('Empleado Actualizado con Exito!', 'success');
		}else{
			Message::add('Token no valido!');
		}
		Route::reload('employee.index');
	}

	public function destroy($id):void{
		(new Employee())->where(['id' => $id])->update(['delete' => true, 'delete_at' => time()]);
		$employee = (new Employee())->find($id);
		if($assigned = (new Assigned())->where(['idEmployee' => $id, 'delete' => 0])->get()){
			foreach($assigned as $item){
				if($inventory = (new Inventory())->find($item->idInventory)){
					$inventory->state = 'available';
					$item->update_at = date('Y-m-d', time());
				}
			}
		}
		Message::add("Empleado {$employee->name} eliminado con exito!", 'success');
		Route::reload('employee.index');
	}

	public function change($id){
		if($employee = (new Employee())->find($id)){
			Html::addVariables([
				'body' => Functions::view('home/employee/update', ['employee' => $employee, 'departments' => (new Department())->where(['delete' => false])->get()])
			]);
		}else{
			Route::reload('employee.index');
		}
		return $this->view;
	}

	public function loadLetter(Request $request, $id){
		if($request->tokenIsValid()){
			$filename = md5($id);
			$data = pathinfo($request->letterEntry->name);
			$path = "doc/$filename.{$data['extension']}";
			if(file_exists($path)) unlink($path); 
			$request->letterEntry->moveFileToAsset($filename, 'doc');
			if(!$file = (new File())->find($id)){
				(new File())->insert([
					'idEmployee' => $id,
					'filename' => $filename,
					'extension' => $data['extension']
				]);
			}
		}
		Route::reload('employee.show', $id);
	}
}