<?php namespace core; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Descargo</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Cartas de Descargo</li>
    </ol>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Fecha de Descargo</th>
                <th>Carta</th>
            </tr>
        <tbody>
            <?php foreach ($discharge as $key => $item) : ?>
                <tr>
                    <td>
                        <a href="<?= Route::get('employee.show') ?>/<?= $item['idEmployee'] ?>">
                            <?= $item['fullname'] ?>
                        </a>
                    </td>
                    <td><?= date('d/m/Y', $item['discharge_at']) ?></td>
                    <td>
                        <div class="row">
                            <div class="col text-end">
                                <form action="<?=Route::get('letter.load')?>/<?=$item['idEmployee']?>" method="post" enctype="multipart/form-data">
                                    <input type="file" name="discharge" onchange="onChange(this)" hidden>
                                </form>
                                <button class="btn btn-outline-primary" onclick="onClick(this)" title="Cargar carta de descargo firmada de <?= $item['fullname'] ?>">
                                    <i class="fa-solid fa-upload"></i>
                                </button>
                            </div>
                            <div class="col text-end">
                                <?php if ($item['exists']) : ?>
                                    <a href="<?=Functions::asset($item['url_discharge'])?>" title="Carta de Descargo Firmada" target="_bank">
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="col text-start">
                                <iframe src="<?=Route::get('letter.discharge')?>/<?=$item['idEmployee']?>" frameborder="0" hidden></iframe>
                                <a href="#" title="Carta de Descargo" onclick="idownload(this)">
                                    <i class="fa-solid fa-envelope-open"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </thead>
    </table>
</div>

<script>
    function onChange(event){
        $(event).parent().submit();
    }

    function onClick(event){
        $(event).parent().find('form').find('input[hidden]').click();
    }

    function idownload(event){
        $(event).parent().find('iframe[hidden]')[0].contentWindow.print();
    }
</script>