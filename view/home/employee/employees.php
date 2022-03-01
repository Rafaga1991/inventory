<?php

namespace core; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Empleados</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Informaci&oacute;n de Empleados</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Empleados Registrados
        </div>
        <div class="card-body">
            <table class="table table-striped" data-table>
                <caption>
                    <div class="modal fade" tabindex="-1" id="newEmployee">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Registrar Nuevo Empledo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?=Route::get('employee.add')?>" method="post">
                                    <div class="modal-body">

                                        <div class="form-group pb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="" class="form-label"><i class="fa-solid fa-user-tie"></i> Nombre</label>
                                                    <input type="text" name="employee[name]" class="form-control" placeholder="nombre de empleado" required>
                                                </div>
                                                <div class="col">
                                                    <label for="" class="form-label"><i class="fa-solid fa-user-tie"></i> Apellido</label>
                                                    <input type="text" name="employee[lastname]" class="form-control" placeholder="apellido de empleado" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group pb-3">
                                            <label for="" class="form-label"><i class="fa-solid fa-at"></i> Correo</label>
                                            <input type="email" name="employee[email]" class="form-control" placeholder="correo electronico" required>
                                        </div>

                                        <div class="form-group pb-3">
                                            <label for="" class="form-label"><i class="fa-solid fa-building"></i> Departamento</label>
                                            <select name="employee[idDepartment]" class="form-control" required>
                                                <option value="">-- Selecciona un Departamento --</option>
                                                <?php foreach($departments as $department):?>
                                                    <option value="<?=$department->id?>"><?=$department->name?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="" class="form-label"><i class="fa-solid fa-hashtag"></i> N&uacute;mero de Extensi&oacute;n</label>
                                                    <input type="number" name="employee[extensionnumber]" class="form-control" min="4" placeholder="extensión" required>
                                                </div>
                                                <div class="col">
                                                    <label for="" class="form-label">Fecha de Ingreso</label>
                                                    <input type="date" name="employee[date_add]" class="form-control" required>
                                                </div>
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
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newEmployee">Nuevo Empleado</button>
                </caption>
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Correo</th>
                        <th>Fecha de Ingreso</th>
                        <?php if (Functions::isAdmin()) : ?>
                            <th>Acciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Empleado</th>
                        <th>Correo</th>
                        <th>Departamento</th>
                        <th>N&uacute;mero de Extensi&oacute;n</th>
                        <th>Fecha de Ingreso</th>
                        <?php if (Functions::isAdmin()) : ?>
                            <th></th>
                        <?php endif; ?>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($employees as $employee) : ?>
                        <tr>
                            <td>
                                <a href="<?=Route::get('employee.show')?>/<?=$employee['id']?>" title="Dispositivos Asignados">
                                    <i class="fa-solid fa-user-tie"></i> <?= $employee['fullname'] ?>
                                </a>
                            </td>
                            <td><a href="mailto:<?= $employee['email'] ?>"><?= $employee['email'] ?></a></td>
                            <td><?= date('d M Y', strtotime($employee['date_add'])) ?></td>
                            <?php if (Functions::isAdmin()) : ?>
                                <th class="text-center">
                                    <div class="btn-group">
                                        <a href="<?=Route::get('employee.destroy')?>/<?=$employee['id']?>" class="btn btn-outline-danger" title="Dar de baja."><i class="fa-solid fa-trash-can"></i></a>
                                        <a href="<?=Route::get('employee.change')?>/<?=$employee['id']?>" class="btn btn-outline-primary" title="Actualizar empleado."><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </th>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>