<?php

use proyecto\app\repository\UsuarioRepository;
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <!-- Agrega aquí tus enlaces a CSS, como Bootstrap o tus propios estilos -->
</head>

<body>
    <!-- Barra de navegación o menú aquí -->
    <br><br><br><br><br><br>
    <div class="container">
        <h1>Perfil de Usuario</h1>

        <?php

        use proyecto\app\entity\Usuario; ?>
        <div class="profile-info">
            <!-- Mostrar avatar del usuario -->
            <div class="profile-avatar">
                <img src="<?= Usuario::RUTA_IMAGENES_PERFIL . $avatar ?>"
                    alt="Avatar de <?= $usuario->getUsername() ?>"
                    class="img-fluid rounded-circle">

            </div>
            <?php
            echo $usuario->getNombreArchivo();
            ?>

            <!-- Mostrar nombre del usuario -->
            <h2><?= $usuario->getUsername() ?></h2>
            <a href="editar_perfil.php" class="btn btn-primary">Editar Perfil</a>
        </div>
    </div>

    <!-- Pie de página o scripts aquí -->

</body>

</html>