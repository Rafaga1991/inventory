<?php

namespace core; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Usuarios Registrados</li>
    </ol>

    <table class="table table-striped" data-table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Admin</th>
                <th>Bloqueo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $item) : ?>
                <tr>
                    <td><?= $item->fullname ?></td>
                    <td class="fw-bold"><?= $item->username ?></td>
                    <td><a href="mailto:<?= $item->email ?>"><?= $item->email ?></a></td>
                    <td><input onchange="onChange(this)" value="<?= $item->id ?>" type="checkbox" name="admin" <?= $item->admin ? 'checked' : '' ?> <?= $item->id == Session::getUser('id') ? 'disabled' : '' ?>></td>
                    <td><input onchange="onChange(this)" value="<?= $item->id ?>" type="checkbox" name="delete" <?= $item->delete ? 'checked' : '' ?> <?= $item->id == Session::getUser('id') ? 'disabled' : '' ?>></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function onChange(event) {
        var data = {};
        data[event.name] = event.checked ? 1 : 0;
        data['id'] = event.value;
        data['__token'] = '{!!TOKEN!!}';
        $.post(
            '/user/update',
            data,
            (answer) => {
                answer = JSON.parse(answer);
                
                if(answer.request){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
    
                    Toast.fire({
                        icon: 'success',
                        title: 'Usuario actualizado.'
                    })
                }

            }
        );
    }
</script>