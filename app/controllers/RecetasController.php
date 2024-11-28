<?php

namespace proyecto\app\controllers;

use proyecto\core\App;
use proyecto\app\repository\RecetasRepository;
use proyecto\app\repository\CategoriaRepository;
use proyecto\core\Response;
use proyecto\app\exceptions\QueryException;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\CategoriaException;
use proyecto\app\exceptions\FileException;
use proyecto\app\utils\File;
use proyecto\core\helpers\FlashMessage;
use proyecto\app\entity\Receta;

class RecetasController
{
    /**
     * @throws QueryException
     */
    public function index()
    {

        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $descripcion = FlashMessage::get('descripcion');
        $categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');
        $titulo = FlashMessage::get('titulo');

        try {
            $imagenes = App::getRepository(RecetasRepository::class)->findAll();
            $categorias = App::getRepository(CategoriaRepository::class)->findAll();
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }

        Response::renderView(
            'recipes',
            'layout',
            compact('imagenes', 'categorias', 'errores', 'titulo', 'descripcion', 'mensaje', 'categoriaSeleccionada')
        );
    }
    /**
     * @throws QueryException
     */
    public function nueva()
    {

        try {
            $imagenesRepository = App::getRepository(RecetasRepository::class);

            $titulo = trim(htmlspecialchars($_POST['titulo']));
            FlashMessage::set('titulo', $titulo);

            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            FlashMessage::set('descripcion', $descripcion);

            $categoria = trim(htmlspecialchars($_POST['categoria']));
            if (empty($categoria))
                throw new CategoriaException;
                FlashMessage::set('categoriaSeleccionada', $categoria);

            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php

            $imagen->saveUploadFile(Receta::RUTA_IMAGENES_SUBIDAS);

            $imagenGaleria = new Receta(
                $imagen->getFileName(),
                $titulo,               
                $descripcion,          
                $categoria              
            );

            $imagenesRepository->guarda($imagenGaleria);

            $mensaje = "Se ha guardado una imagen: " . $imagenGaleria->getNombre();

            App::get('logger')->add($mensaje);
            FlashMessage::set('mensaje', $mensaje);

            FlashMessage::unset('descripcion');
            FlashMessage::unset('categoriaSeleccionada');
            FlashMessage::unset('titulo');

        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        } catch (CategoriaException) {
            FlashMessage::set('errores', ["No se ha seleccionado una categoría válida"]);
        }

        App::get('router')->redirect('recipes');
    }

    public function show($id)
    {
        $imagenesRepository = App::getRepository(RecetasRepository::class);
        $imagen = $imagenesRepository->find($id);
        Response::renderView(
            'receta-show',
            'layout',
            compact('imagen', 'imagenesRepository')
        );
    }
}
