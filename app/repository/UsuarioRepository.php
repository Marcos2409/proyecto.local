<?php

namespace proyecto\app\repository;

use proyecto\core\database\QueryBuilder;
use proyecto\app\entity\Usuario;
use proyecto\core\App;

class UsuarioRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'usuarios', string $classEntity = Usuario::class)
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * @param Usuario $usuario
     * @return Usuario
     * @throws NotFoundException
     * @throws QueryException
     */
    public function guarda(Usuario $usuario): Usuario
    {
        $fnGuardaUsuario = function () use ($usuario) {
            $this->save($usuario);
        };
        $this->executeTransaction($fnGuardaUsuario);

        return $usuario;
    }
}
