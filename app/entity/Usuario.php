<?php

namespace proyecto\app\entity;

use proyecto\app\entity\IEntity;

class Usuario implements IEntity
{
    private $id;
    private $username;
    private $password;
    private $role;
    private $nombreArchivo;
    private $avatar;


    const RUTA_IMAGENES_PERFIL = '/public/images/avatares/';

    public function __construct($nombreArchivo = "", $username = "", $password = "", $role = "")
    {
        $this->id = null;
        $this->nombreArchivo = $nombreArchivo;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function getNombreArchivo()
    {
        return $this->nombreArchivo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
    public function setNombreArchivo(string $nombreArchivo)
    {
        $this->nombreArchivo = $nombreArchivo;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $password;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $role;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'role' => $this->getRole(),
            'avatar' => $this->getNombreArchivo()
        ];
    }
}
