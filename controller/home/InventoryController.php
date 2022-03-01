<?php

namespace controller\home;

use core\{Controller, Functions, Html, Message, Request, Route, Session};
use model\{Assigned, Brand, Department, UnitType, Inventory};

class InventoryController extends Controller{
    private $view = 'home/index';

    public function __construct()
    {
        $this->view = Functions::view($this->view);
    }

    public function index(){
        Html::addVariables([
            'body' => Functions::view('home/inventory/index', [
                'units' => (new UnitType())->where(['delete' => false])->get(),
                'inventory' => (new Inventory())->getInventory(),
                'brands' => (new Brand())->where(['delete' => false])->get()
            ])
        ]);
        return $this->view;
    }

    public function insert(Request $request){
        if($request->tokenIsValid()){
            foreach($request->inventory['unit'] as $key => $value){
                (new Inventory())->insert([
                    'userid' => Session::getUser('id'),
                    'idUnitType' => $request->inventory['unit'][$key],
                    'idBrand' => $request->inventory['brand'][$key],
                    'model' => $request->inventory['model'][$key],
                    'serial' => $request->inventory['serial'][$key],
                ]);
            }
            Message::add('Medios Agregados a Inventario con exito!', 'success');
        }else{
            Message::add('Token de formulario no valido!', 'danger');
        }
        
        Route::reload('inventory.index');
    }

    public function destroy($id){
        if($inventory = (new Inventory())->where(['delete'=>false])->find($id)){
            $name = (new UnitType())->find($inventory->idUnitType)->name;
            (new Inventory())->where(['id' => $id])->update(['delete' => true, 'delete_at' => date('Y-m-d', time())]);
            Message::add("Dispositivo <<b>$name</b>> Eliminado con Exito!", 'success');
        }else{
            Message::add("El id <$id> no es existe.");
        }
        Route::reload('inventory.index');
    }

    public function show($id){
        if($inventory = (new Inventory())->getInventoryById($id)){
            $assigned = (new Assigned())->getLastAssigned($inventory[0]['id']);
            foreach($inventory as &$item) $item['assigned'] = (new Assigned())->getAssignedById($item['id']);
            Html::addVariables([
                'body' => Functions::view('home/inventory/show', [
                    'inventory' => $inventory,
                    'assigned' => $assigned
                ])
            ]);
        }
        return $this->view;
    }
}