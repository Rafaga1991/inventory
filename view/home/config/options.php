<?php

namespace core; ?>

<div class="conatiner-fluid px-4">
    <h1 class="mt-4">Perfil</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Informaci&oacute;n de Perfil</li>
    </ol>
    <form action="<?=Route::get('user.change')?>" method="post">
        <div class="text-end">
            <button class="btn btn-outline-primary">Actualizar</button>
        </div>
        
        <div class="row pb-5">
            <div class="col">
                <label for="" class="form-label"><i class="fas fa-user"></i> Usuario</label>
                <input type="text" class="form-control" name="username" value="<?= Session::getUser('username') ?>" required>
                <span class="text-muted">Nombre de usuario.</span>
            </div>
            <div class="col">
                <label for="" class="form-label"><i class="fa-solid fa-address-card"></i> Nombre Compledo</label>
                <input type="text" class="form-control" name="fullname" value="<?= Session::getUser('fullname') ?>" required>
                <span class="text-muted">Nombre completo de usuario.</span>
            </div>
        </div>

        <div class="row pb-5">
            <div class="col">
                <label for="" class="form-label"><i class="fas fa-key"></i> Contrase&ntilde;a</label>
                <input type="password" class="form-control" name="password[]">
                <span class="text-muted">Nueva contrase&ntilde;a de usuario.</span>
            </div>
            <div class="col">
                <label for="" class="form-label"><i class="fa-solid fa-key"></i> Repetir Contrase&ntilde;a</label>
                <input type="password" class="form-control" name="password[]">
                <span class="text-muted">Repetir Contrase&ntilde;a Ingresada Anteriormente.</span>
            </div>
        </div>

        <div class="form-group pb-5">
            <label for="" class="form-label"><i class="fa-solid fa-at"></i> Email</label>
            <input type="email" class="form-control" name="email" value="<?= Session::getUser('email') ?>" required>
            <span class="text-muted">Correo electronico de usuario.</span>
        </div>
    </form>
</div>