<?php

namespace core; ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Inventario Detallado</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= Route::get('inventory.index') ?>">Inventario de Medios</a></li>
        <li class="breadcrumb-item active">Dispositivos</li>
    </ol>
    <div class="text-muted fs-3">Detalles</div>
    <?php foreach ($inventory as $item) : ?>
        <div class="row p-2">
            <div class="col border border-bottom-white">
                <div class="row">
                    <div class="col">
                        <div class="">Dispositivo: <span class="badge bg-success text-white"><?= $item['unitname'] ?></span></div>
                        <div>Marca: <span class="text-warning"><?= $item['brandname'] ?></span></div>
                        <div>Modelo: <span class="badge bg-dark text-white"><?= $item['model'] ?></span></div>
                        <div>Serial: <span class="fw-bold"><?= $item['serial'] ?></span></div>
                        <div>Estado: <span class="text-<?= $item['state'] == 'available' ? 'success' : 'secondary' ?>"><?= Functions::traslate($item['state']) ?></span></div>
                    </div>
                    <div class="col text-end pt-2">
                        <div>
                            <a href="<?= Route::get('inventory.destroy') ?>/<?= $item['id'] ?>" title="Eliminar <?= $item['unitname'] ?>(<?= $item['serial'] ?>)" class="badge bg-danger text-white"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <div class="text-center">
                            <img src="<?= Functions::asset('image/brand/' . strtolower($item['brandname']) . '.png') ?>" width="50" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col border">
                <div class="border px-2">
                    <div>Asignado a: </div>
                </div>
                <div>
                    <?php if (isset($item['assigned'][0]['fullname'])) : ?>
                        <a href="<?= Route::get('employee.show') ?>/<?= $item['assigned'][0]['idEmployee'] ?>">
                            <span class="fw-bold fs-5">
                                <?= $item['assigned'][0]['fullname'] ?>
                            </span>
                        </a>
                    <?php else : ?>
                        <span class="text-muted">
                            <?= str_repeat('*', 10) ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="row p-2">
        <div class="col border">
            <div class="fs-3">Historial de Empleados (<span class="text-success"><?=count($assigned)?></span>)</div>
            <hr class="dropdown-divider">

            <div class="row fw-bold">
                <div class="col-5">Empleado</div>
                <div class="col">Entregado</div>
                <div class="col">Recivido</div>
                <div class="col">Estado</div>
            </div>
            
            <?php foreach ($assigned as $key => $item) : ?>
                <hr class="dropdown-divider">
                <div class="row py-1">
                    <div class="col-5"><?= $key + 1 ?>. <a href="<?=Route::get('employee.show')?>/<?=$item['idEmployee']?>"><?= $item['fullname'] ?></a></div>
                    <div class="col"><?= date('d M Y', strtotime($item['assigned_at'])) ?></div>
                    <div class="col">
                        <?php if ($item['received_at']) : ?>
                            <?= date('d M Y', strtotime($item['received_at'])) ?>
                        <?php else:?>
                            <?=str_repeat('-', 10)?>
                        <?php endif; ?>
                    </div>
                    <div class="col">
                        <span class="badge bg-<?=$item['assignedState']=='new'?'primary':'secondary'?>"><?=Functions::traslate($item['assignedState'])?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>