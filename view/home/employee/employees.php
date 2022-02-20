<?php namespace core; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Empleados</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">empleados</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Correo</th>
                        <th>Departamento</th>
                        <th>N&uacute;mero</th>
                        <th>Fecha de Ingreso</th>
                        <?php if(Functions::isAdmin()): ?>
                            <th>Acciones</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Empleado</th>
                        <th>Correo</th>
                        <th>Departamento</th>
                        <th>N&uacute;mero</th>
                        <th>Fecha de Ingreso</th>
                        <?php if(Functions::isAdmin()): ?>
                            <th></th>
                        <?php endif;?>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($employees as $employee):?>
                    <tr>
                        <td><i class="fa-solid fa-user-tie"></i> <?=$employee['fullname']?></td>
                        <td><a href="mailto:<?=$employee['email']?>"><?=$employee['email']?></a></td>
                        <td><span class="badge bg-primary"><?=$employee['department']?></span></td>
                        <td><?=$employee['extentionnumber']?></td>
                        <td><?=date('d M Y', $employee['date_add'])?></td>
                        <?php if(Functions::isAdmin()): ?>
                            <th class="text-center">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-outline-danger" title="Dar de baja."><i class="fa-solid fa-trash-can"></i></a>
                                    <a href="#" class="btn btn-outline-primary" title="Actualizar empleado."><i class="fa-solid fa-pen-to-square"></i></a>
                                </div>
                            </th>
                        <?php endif;?>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>