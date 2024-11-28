<?php
use proyecto\app\entity\Receta;
?>
<!-- Principal Content Start -->
 <br><br><br><br><br>
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1><?= htmlspecialchars(explode('.', $imagen->getNombre())[0], ENT_QUOTES, 'UTF-8') ?></h1>
            <hr>
            <div class="imagenes_galeria">
            <img src="<?= Receta::RUTA_IMAGENES_SUBIDAS . $imagen->getNombreArchivo(); ?>"
                            alt="<?= htmlspecialchars($imagen->getDescripcion(), ENT_QUOTES, 'UTF-8') ?>"
                                    title="<?= htmlspecialchars($imagen->getNombre(), ENT_QUOTES, 'UTF-8') ?>"
                                    width="400px">
                <br>Descripción:<?= htmlspecialchars($imagen->getDescripcion(), ENT_QUOTES, 'UTF-8') ?>
                <br>Categoria:<?= htmlspecialchars($imagen->getCategoria(), ENT_QUOTES, 'UTF-8') ?>
            </div>
        </div>
    </div>
</div>