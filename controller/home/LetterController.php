<?php

namespace controller\home;

use core\{Controller, Request, Functions, Html, Route};
use model\Assigned;

class LetterController extends Controller{
    private $view = 'home/index';

    public function __construct(){ $this->view = Functions::view($this->view); }

    public function index(){
        if($discharge = (new Assigned())->getLastAssignedDischarge()){
            foreach($discharge as &$value){
                $value['exists'] = file_exists('asset/doc/' . md5($value['idEmployee']) . '_discharge.pdf');
            }
        }

        Html::addVariable('body', Functions::view('home/letter/index', [
            'discharge' => $discharge
        ]));
        return $this->view;
    }

    public function entry($id){
        if($assigned = (new Assigned())->getAssignedById($id, 'idEmployee')){
            Html::addVariables([
                'EMPLOYEE'=>($assigned[0]['fullname'] ?? ''),
                'DATE' => date('d/m/Y', time()),
                'BUSINESS' => 'Grupo VOPM'
            ]);

            return Functions::view(
                'home/letter/entry', 
                [
                    'assigned' => $assigned
                ]
            );
        }
    }

    public function loadDischarge(Request $request, $id){
        if($request->tokenIsValid()){
            $filename = md5($id) . '_discharge';
            $request->discharge->moveFileToAsset("doc/$filename");
        }
        Route::reload('letter.index');
    }

    public function discharge($id){
        if($assigned = (new Assigned())->getAssignedById($id, 'idEmployee')){
            Html::addVariables([
                'EMPLOYEE'=>($assigned[0]['fullname'] ?? ''),
                'DATE' => date('d/m/Y', time()),
                'BUSINESS' => 'Grupo VOPM'
            ]);

            return Functions::view(
                'home/letter/discharge', 
                [
                    'assigned' => $assigned
                ]
            );
        }
    }
}