<?php

namespace core; ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Empleado</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= Route::get('employee.index') ?>">Empleados</a></li>
        <li class="breadcrumb-item active">Informaci&oacute;n del Empleado</li>
    </ol>

    <div class="row pb-3">
        <div class="col">
            <div class="modal fade" tabindex="-1" id="addDevice">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Asignar Dispositivos a <?= $employee->name ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= Route::get('employee.assigned') ?>" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="assigned[idEmployee]" value="<?= $employee->id ?>">
                                <div id="containerDevice">
                                    <div id="row" class="py-1">
                                        <div class="row">
                                            <div class="col">
                                                <label for="" class="form-label">Selecciona el Dispositivo</label>
                                                <select name="assigned[idInventory][]" class="form-control" required>
                                                    <option value="">-- selecciona un dispositivo --</option>
                                                    <?php foreach ($inventory as $item) : ?>
                                                        <option value="<?= $item['id'] ?>"><?= $item['unitname'] ?>: <?= $item['brandname'] ?>(<?= $item['serial'] ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Estado del dispositivo</label>
                                                    <select name="assigned[state][]" class="form-control">
                                                        <option value="new">Nuevo</option>
                                                        <option value="used">Usado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-3 text-end" id="btnContainer">
                                    <div class="btn-group">
                                        <button type="button" id="addRow" class="btn btn-primary" title="Agregar fila"><i class="fas fa-plus"></i></button>
                                        <button type="button" id="removeRow" class="btn btn-danger" title="Quitar fila" hidden><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addDevice">Asignar Dispositivos</button>
        </div>
        <div class="col">
            <div class="text-end pb-2">
                <?php if ($employee->unitAssigned) : ?>
                    <iframe src="<?= Route::get('letter.entry') ?>/<?= $employee->id ?>" id="employeeDocumentEntry" frameborder="0" hidden></iframe>
                    <?php if ($employee->letterEntryExists) : ?>
                        <a href="{!!URL_ENTRY!!}" target="_blank" title="Carta de Entrega" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></a>
                    <?php endif; ?>
                    <button title="Imprimir Documento de Entrega" class="btn btn-outline-primary" id="printDocEntry"><i class="fa-solid fa-print"></i></button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col border">
            <h3 class="text-muted">Detalle del Empleado</h3>
            <hr class="dropdown-divider">

            <div class="row p-2">
                <div class="col-5">
                    <span class="fw-bold"><i class="fa-solid fa-user-tie"></i> Nombre:</span>
                </div>
                <div class="col"><?= "$employee->name $employee->lastname" ?></div>
            </div>

            <div class="row p-2">
                <div class="col-5">
                    <span class="fw-bold"><i class="fa-solid fa-envelope"></i> Correo:</span>
                </div>
                <div class="col"><a href="mailto:<?= $employee->email ?>"><?= $employee->email ?></a></div>
            </div>

            <div class="row p-2">
                <div class="col-5">
                    <span class="fw-bold"><i class="fa-solid fa-hashtag"></i> Extensi&oacute;n:</span>
                </div>
                <div class="col"><span class="fw-bold"><?= $employee->extensionnumber ?></span></div>
            </div>

            <div class="row p-2">
                <div class="col-5">
                    <span class="fw-bold"><i class="fa-solid fa-calendar-day"></i> Fecha de Ingreso:</span>
                </div>
                <div class="col"><span class="fw-bold text-muted"><?= date('d M Y', strtotime($employee->date_add)) ?></span></div>
            </div>

            <div class="row p-2">
                <div class="col-5">
                    <span class="fw-bold"><i class="fa-solid fa-building"></i> Departamento:</span>
                </div>
                <div class="col"><span class="badge bg-primary" title="<?= $employee->department->description ?>"><?= $employee->department->name ?></span></div>
            </div>

            <div class="py-4">
                <?php if ($employee->unitAssigned) : ?>
                    <form action="<?= Route::get('employee.load.letter') ?>/<?= $employee->id ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="form-label">Cargar Carta de Entrega Firmada</label>
                            <div class="input-group">
                                <input type="file" name="letterEntry" class="form-control" required>
                                <button class="btn btn-outline-primary">Cargar</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="col border">
            <h3 class="text-muted">Dispositivos Asignados</h3>
            <hr class="dropdown-divider">
            <?php foreach ($employee->unitAssigned as $unit) : ?>
                <div class="row border py-3">
                    <div class="col">
                        <div>
                            Unidad:
                            <a href="<?= Route::get('inventory.show') ?>/<?= $unit['idBrand'] ?>/<?= $unit['idUnitType'] ?>">
                                <span><?= $unit['unitname'] ?></span>
                            </a>
                        </div>
                        <div>
                            Estado: <span class="badge bg-<?= $unit['assignedState'] == 'new' ? 'success' : 'secondary' ?>"><?= Functions::traslate($unit['assignedState']) ?></span>
                        </div>
                        <div>
                            Fecha: <?= date('d M Y', strtotime($unit['assigned_at'])) ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <img src="<?= Functions::asset('image/brand/' . strtolower($unit['brandname']) . '.png') ?>" width="50%" alt="<?= $unit['brandname'] ?>">
                        <div class="text-end pt-3">
                            <div class="btn-group">
                                <a href="<?= Route::get('employee.assigned.destroy') ?>/<?= $unit['idAssigned'] ?>" class="btn btn-danger" title="Borrar asignación"><i class="fas fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="mt-4">
                <h3 class="text-muted">Historial de Dispositivos (<span class="text-success"><?= count($employee->unitLastAssigned) ?></span>)</h3>
                <hr class="dropdown-divider">
                <table class="table table-striped" data-table>
                    <thead>
                        <tr>
                            <th>Dispositivo</th>
                            <th>Entregado</th>
                            <th>Recibido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employee->unitLastAssigned as $key => $lastUnit) : ?>
                            <tr>
                                <td>
                                    <?=$key+1?>. <a href="<?=Route::get('inventory.show')?>/<?=$lastUnit['id']?>/"><?= $lastUnit['unitname'] ?></a>
                                </td>
                                <td><?= date('d/m/Y', strtotime($lastUnit['assigned_at'])) ?></td>
                                <td>
                                    <?php if ($lastUnit['received_at']) : ?>
                                        <?= date('d/m/Y', strtotime($lastUnit['received_at'])) ?>
                                    <?php else : ?>
                                        <?= str_repeat('-', 10) ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="mt-4">
            <h3 class="text-muted">Historial de Cartas (<span class="text-success"><?= count($employee->letterEntrySigned) ?></span>)</h3>
                <hr class="dropdown-divider">
                <table class="table table-striped" data-table>
                    <thead>
                        <tr>
                            <th>Carta</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employee->letterEntrySigned as $key => $letter) : ?>
                            <tr>
                                <td>
                                    <?=$key+1?>. <a href="<?=Functions::asset("doc/letter/entry/$letter->filename.$letter->extension")?>" target="_blank"><?=$letter->filename?></a>
                                </td>
                                <td><?=date('d M Y', strtotime($letter->create_at))?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    <?php if ($employee->unitAssigned) : ?>
        printDocEntry.onclick = () => {
            employeeDocumentEntry.contentWindow.print();
        }
    <?php endif; ?>

    addRow.onclick = () => {
        let element = row.cloneNode(true);
        element.id = `row${containerDevice.childElementCount}`;
        containerDevice.appendChild(element);
        removeRow.hidden = false;
    }

    removeRow.onclick = () => {
        if (element = document.getElementById(`row${containerDevice.childElementCount-1}`)) {
            element.remove();
            if (containerDevice.childElementCount < 2) {
                removeRow.hidden = true;
            }
        }
    }
</script>