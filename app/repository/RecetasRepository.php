<?php

namespace proyecto\app\repository;

use proyecto\core\database\QueryBuilder;
use proyecto\app\repository\CategoriaRepository;
use proyecto\app\entity\Categoria;
use proyecto\app\entity\Receta;
use proyecto\core\App;

class RecetasRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'recetas', string $classEntity = Receta::class)
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * @return Categoria
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getCategoria(Receta $imagenGaleria): Categoria
    {
        $categoriaRepository = App::getRepository(CategoriaRepository::class);
        return $categoriaRepository->find($imagenGaleria->getCategoria());
    }
    public function guarda(Receta $imagenGaleria)
    {
        $fnGuardaImagen = function () use ($imagenGaleria) { // Creamos una función anónima que se llama como callable
            $categoria = $this->getCategoria($imagenGaleria);
            $categoriaRepository = App::getRepository(CategoriaRepository::class);
            $categoriaRepository->nuevaImagen($categoria);
            $this->save($imagenGaleria);
        };
        $this->executeTransaction($fnGuardaImagen); // Se pasa un callable
    }
}
