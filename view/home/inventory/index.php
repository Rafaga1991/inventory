<?php namespace core; ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Inventario</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Inventario de Medios</li>
    </ol>

    <table class="table table-striped" data-table>
        <caption>
            <div class="modal fade" tabindex="-1" id="newEmployee">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar Medios a Inventario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= Route::get('inventory.new') ?>" method="post">
                            <div class="modal-body">
                                <div id="container_row">
                                    <div class="row" id="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label">Dispositivo <span class="text-danger">*</span></label>
                                                <select name="inventory[unit][]" class="form-control" required>
                                                    <option value="">-- Selecciona el Dispositivo --</option>
                                                    <?php foreach ($units as $unit) : ?>
                                                        <option value="<?= $unit->id ?>"><?= $unit->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label">Marca <span class="text-danger">*</span></label>
                                                <select name="inventory[brand][]" class="form-control" required>
                                                    <option value="">-- Selecciona la Marca --</option>
                                                    <?php foreach ($brands as $brand) : ?>
                                                        <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label">Modelo <span class="text-danger">*</span></label>
                                                <input type="text" name="inventory[model][]" class="form-control" maxlength="20" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label">N&uacute;mero de Serie <span class="text-danger">*</span></label>
                                                <input type="text" name="inventory[serial][]" class="form-control" maxlength="30" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end pt-3" id="btn_container">
                                    <button onclick="createRow()" type="button" class="btn btn-primary" title="Nueva Fila"><i class="fas fa-plus"></i></button>
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
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newEmployee">Llenar Inventario</button>
        </caption>
        <thead>
            <tr>
                <th>Dispositivo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serial</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventory as $key => $value) : ?>
                <tr>
                    <td>
                        <?= $key + 1 ?>.
                        <a href="<?= Route::get('inventory.show') ?>/<?= $value['id'] ?>">
                            <?= $value['unitname'] ?>
                        </a>
                    </td>
                    <td><img src="<?= Functions::asset('image/brand/' . strtolower($value['brandname']) . '.png') ?>" width="50" alt="<?= $value['brandname'] ?>" title="<?= $value['brandname'] ?>"></td>
                    <td><?= $value['model'] ?></td>
                    <td><input type="text" value="<?= $value['serial'] ?>" class="form-control" disabled></td>
                    <td>
                        <span class="badge bg-<?= ($value['state'] == 'available') ? 'success' : 'secondary' ?>"><?= Functions::traslate($value['state']) ?></span>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$inventory) : ?>
                <tr>
                    <td colspan="5" class="text-center">No hay datos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    let position = 1;

    function createRow() {
        var element = row.cloneNode(true);
        var buttom_remove = document.createElement('buttom');

        element.id = `row${position}`;

        buttom_remove.className = 'btn btn-outline-danger'
        buttom_remove.innerHTML = '<i class="fa-solid fa-minus"></i>';
        buttom_remove.title = 'Remover Fila';
        buttom_remove.onclick = () => {
            document.getElementById(`row${--position}`).remove();
            if (position == 1) buttom_remove.remove();
        }

        $('#container_row').append(element);
        position = document.getElementById('container_row').querySelectorAll('[class~=row]').length;

        if (position == 2) $('#btn_container').append(buttom_remove);
        else if (position == 1) buttom_remove.remove();
    }
</script>