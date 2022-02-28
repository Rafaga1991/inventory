<?php namespace core; ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Empleado (<span class="text-muted"><?= "$employee->name $employee->lastname" ?></span>)</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= Route::get('employee.index') ?>">Empleados</a></li>
        <li class="breadcrumb-item active">Actualizar Datos</li>
    </ol>
    <form action="<?= Route::get('employee.update') ?>/<?=$employee->id?>" method="post">
        <div class="form-group pb-3">
            <div class="row">
                <div class="col">
                    <label for="" class="form-label"><i class="fa-solid fa-user-tie"></i> Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="employee[name]" value="<?=$employee->name?>" class="form-control" required>
                    <span class="text-muted">Nombre del empleado.</span>
                </div>
                <div class="col">
                    <label for="" class="form-label"><i class="fa-solid fa-user-tie"></i> Apellido <span class="text-danger">*</span></label>
                    <input type="text" name="employee[lastname]" value="<?=$employee->lastname?>" class="form-control" required>
                    <span class="text-muted">Apellido del empleado.</span>
                </div>
            </div>
        </div>

        <div class="form-group pb-3">
            <div class="row">
                <div class="col">
                    <label for="" class="form-label"><i class="fa-solid fa-at"></i> Correo <span class="text-danger">*</span></label>
                    <input type="text" name="employee[email]" value="<?=$employee->email?>" class="form-control" required>
                    <span class="text-muted">Correo del empleado.</span>
                </div>
                <div class="col">
                    <label for="" class="form-label"><i class="fa-solid fa-building"></i> Departamento <span class="text-danger">*</span></label>
                    <select name="employee[idDepartment]" class="form-control">
                        <option value="">-- Selecciona un Departamento --</option>
                        <?php foreach($departments as $department):?>
                            <option value="<?=$department->id?>" <?=$department->id==$employee->idDepartment?'selected':''?>><?=$department->name?></option>
                        <?php endforeach;?>
                    </select>
                    <span class="text-muted">Departamento asignado a empleado.</span>
                </div>
            </div>
        </div>

        <div class="form-group pb-3">
            <div class="row">
                <div class="col">
                    <label for="" class="form-label"><i class="fa-solid fa-hashtag"></i> N&uacute;mero de Extensi&oacute;n <span class="text-danger">*</span></label>
                    <input type="number" name="employee[extensionnumber]" value="<?=$employee->extensionnumber?>" class="form-control" min='4' required>
                    <span class="text-muted">N&uacute;mero de extensi&oacute;n del empleado.</span>
                </div>
                <div class="col">
                    <label for="" class="form-label"><i class="fa-solid fa-calendar-check"></i> Fecha de Ingreso <span class="text-danger">*</span></label>
                    <input type="date" name="employee[date_add]" value="<?=$employee->date_add?>" class="form-control" required>
                    <span class="text-muted">Fecha de ingreso del empleado.</span>
                </div>
            </div>
        </div>
        <div class="form-group py-3">
            <div class="row">
                <div class="col text-start">
                    <a href="<?=Route::get('employee.index')?>" class="btn btn-outline-secondary" title="Cancelar Actualización">Cancelar</a>
                </div>
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary" title="Actualizar Empleado.">Actualizar</button>
                </div>
                <div class="col text-end">
                    <a href="<?=Route::get('employee.destroy')?>/<?=$employee->id?>" class="btn btn-outline-danger" title="Eliminar Empleado">Dar de Baja</a>
                </div>
            </div>
        </div>
    </form>
</div>