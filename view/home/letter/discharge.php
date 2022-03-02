<?php namespace core;?>
<div class="container-fluid p-4">
    <div class="row">
        <div class="col">
            <div class="py-2">
                <div class="text-muted">Empleado: <span class="text-secondary fw-bold">{!!EMPLOYEE!!}</span></div>
            </div>
            <div class="py-2">
                <div class="text-muted">Fecha: <span class="fw-bold text-secondary">{!!DATE!!}</span></div>
            </div>
        </div>
        <div class="col text-end">
            <img src="<?=Functions::asset('image/logo.png')?>" width="40%" alt="">
        </div>
    </div>
    <h3 class="text-center text-muted text-decoration-underline text-uppercase">Carta de Descargo de Equipo</h3>
    <div class="my-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Equipo</th>
                    <th>Cant.</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Serial #</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($assigned as $unit):?>
                    <tr>
                        <td><?=date('d/m/Y', strtotime($unit['assigned_at']))?></td>
                        <td><?=$unit['unitname']?></td>
                        <td>1</td>
                        <td><img src="<?=Functions::asset("/image/brand/" . strtolower($unit['brandname']) . ".png")?>" width="50" alt=""></td>
                        <td><?=$unit['model']?></td>
                        <td><?=$unit['serial']?></td>
                        <td><span class="fw-bold text-<?=$unit['assignedState']=='new'?'primary':'secondary'?>"><?=Functions::traslate($unit['assignedState'])?></span></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="px-4">
        <div class="py-2">
            El trabajador manifiesta que:
        </div>
        <div class="py-2">
            Yo, <span class="fw-bold">{!!EMPLOYEE!!}</span>, hago el descargo de los equipos que la empresa 
            <span class="fw-bold">{!!BUSINESS!!}</span>, me entregó en condiciones 
            óptimas y de los cuales me comprometí de que en el caso de que 
            hubieran sufrido algún tipo de daño, notificaría a la empresa, 
            conforme los protocolos establecidos y que se me descontaría de mis salarios 
            o de mi liquidación de prestaciones, los valores de la dotación, cuando el 
            daño o la pérdida de esta, haya sido mi exclusiva responsabilidad.
        </div>
        <div class="mt-5">
            <div class="row">
                <div class="col border-bottom pb-4">Entregado por:</div>
                <div class="col"></div>
                <div class="col border-bottom pb-4">Recibido por:</div>
            </div>
        </div>
        <div class="row">
            <div class="col fw-bold pt-1">Empelado</div>
            <div class="col"></div>
            <div class="col fw-bold pt-1">Soporte T&eacute;cnico</div>
        </div>
    </div>
</div>