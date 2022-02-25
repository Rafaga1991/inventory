<?php

namespace controller\home;

use core\{Controller, Request, Functions, Html};
use model\Assigned;

class LetterController extends Controller{
    private $view = 'home/index';

    public function __construct(){ $this->view = Functions::view($this->view); }

    public function index(){
        Functions::vdump((new Assigned())->getLastAssignedDischarge());
        Html::addVariable('body', Functions::view('home/letter/index', [
            'discharge' => []
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

    public function discharge($id){

    }
}