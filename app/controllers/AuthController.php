<?php

namespace proyecto\app\controllers;

use proyecto\app\entity\Usuario;
use proyecto\app\exceptions\AppException;
use proyecto\app\repository\UsuarioRepository;
use proyecto\core\Response;
use proyecto\core\helpers\FlashMessage;
use proyecto\core\App;
use proyecto\app\exceptions\ValidationException;
use proyecto\core\Security;
use proyecto\app\utils\File;
use proyecto\app\exceptions\NotFoundException;
use proyecto\app\exceptions\QueryException;

class AuthController
{
    public function login()
    {
        $errores = FlashMessage::get('login-error', []);
        $username = FlashMessage::get('username', '');
        Response::renderView('login', 'layout', compact('errores', 'username'));
    }

    public function perfil()
    {
        try {
            if (!isset($_SESSION['loguedUser'])) {
                App::get('router')->redirect('login');
                return;
            }

            $usuarioId = $_SESSION['loguedUser'];
            $usuario = App::getRepository(UsuarioRepository::class)->find($usuarioId);

            $avatar = $usuario->getAvatar();

            Response::renderView('perfil', 'layout', compact('usuario', 'avatar'));
        } catch (NotFoundException $e) {
            FlashMessage::set('login-error', ['Usuario no encontrado']);
            App::get('router')->redirect('login');
        } catch (QueryException $e) {
            FlashMessage::set('login-error', ['Error al cargar el perfil']);
            App::get('router')->redirect('login');
        }
    }



    public function enviar()
    {
        Response::renderView('contact_enviar', 'layout');
    }

    public function checkLogin()
    {
        try {
            $this->validateLoginRequest();

            $username = $_POST['username'];
            $password = $_POST['password'];

            $usuario = App::getRepository(UsuarioRepository::class)->findOneBy(['username' => $username]);

            if ($usuario && Security::checkPassword($password, $usuario->getPassword())) {
                $_SESSION['loguedUser'] = $usuario->getId();
                FlashMessage::unset('username');
                App::get('router')->redirect('');
            }

            throw new ValidationException('El usuario y el password introducidos no existen');
        } catch (ValidationException $e) {
            FlashMessage::set('login-error', [$e->getMessage()]);
            App::get('router')->redirect('login');
        }
    }

    private function validateLoginRequest()
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            throw new ValidationException('Debes introducir el usuario y el password');
        }
        FlashMessage::set('username', $_POST['username']);
    }

    public function logout()
    {
        unset($_SESSION['loguedUser']);
        App::get('router')->redirect('login');
    }

    public function registro()
    {
        $errores = FlashMessage::get('registro-error', []);
        $mensaje = FlashMessage::get('mensaje', '');
        $username = FlashMessage::get('username', '');
        Response::renderView('registro', 'layout', compact('errores', 'mensaje', 'username'));
    }

    public function checkRegistro()
{
    try {
        $this->validateRegistroRequest();

        $username = $_POST['username'];
        $existingUser = App::getRepository(UsuarioRepository::class)->findOneBy(['username' => $username]);
        if ($existingUser) {
            throw new ValidationException("El usuario ya existe");
        }

        $password = Security::encrypt($_POST['password']);
        $imagen = $this->handleUploadedFile();

        $usuario = new Usuario();
        $usuario->setUsername($username);
        $usuario->setRole('ROLE_USER');
        $usuario->setPassword($password);
        $usuario->setNombreArchivo($imagen->getFileName());

        App::getRepository(UsuarioRepository::class)->save($usuario);

        FlashMessage::unset('username');
        $mensaje = "Se ha creado el usuario: {$usuario->getUsername()}";
        App::get('logger')->add($mensaje);
        FlashMessage::set('mensaje', $mensaje);

        App::get('router')->redirect('login');
    } catch (ValidationException $e) {
        FlashMessage::set('registro-error', [$e->getMessage()]);
        App::get('router')->redirect('registro');
    } catch (QueryException $e) {
        FlashMessage::set('registro-error', ['Error al guardar el usuario']);
        App::get('router')->redirect('registro');
    }
}


    private function validateRegistroRequest()
    {
        if (empty($_POST['username'])) {
            throw new ValidationException('El nombre de usuario no puede estar vacío');
        }
        FlashMessage::set('username', $_POST['username']);

        if (empty($_POST['password']) || empty($_POST['re-password'])) {
            throw new ValidationException('El password de usuario no puede estar vacío');
        }

        if ($_POST['password'] !== $_POST['re-password']) {
            throw new ValidationException('Los dos password deben ser iguales');
        }
    }

    private function handleUploadedFile()
    {
        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];

        $imagen = new File('imagen', $tiposAceptados);

        $imagen->saveUploadFile(Usuario::RUTA_IMAGENES_PERFIL);

        return $imagen;
    }
}
