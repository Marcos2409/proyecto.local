<?php
namespace proyecto\app\entity;
use proyecto\app\entity\IEntity;

class Receta implements IEntity
{
    /**
     * @var string
     */
    private $id;
    private string $nombreArchivo; // Nombre del archivo subido
    private $nombre;
    private $descripcion;
    private $categoria;
    private $numVisualizaciones;
    private $numLikes;
    private $numDownloads;

    const RUTA_IMAGENES_SUBIDAS = '/public/images/galeria/';

    public function __construct(string $nombreArchivo = "", $nombre = "", $descripcion = "", $categoria = 0, $numVisualizaciones = 0, $numLikes = 0, $numDownloads = 0)
    {
        $this->id = null;
        $this->nombreArchivo = $nombreArchivo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDownloads = $numDownloads;
    }


    public function getNombreArchivo()
    {
        return $this->nombreArchivo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getNumVisualizaciones()
    {
        return $this->numVisualizaciones;
    }

    public function getNumLikes()
    {
        return $this->numLikes;
    }

    public function getNumDownloads()
    {
        return $this->numDownloads;
    }

    public function setNombreArchivo(string $nombreArchivo): Receta
    {
        $this->nombreArchivo = $nombreArchivo;
        return $this;
    }

    public function setNombre($nombre): Receta
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function setDescripcion($descripcion): Receta
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setCategoria($categoria): Receta
    {
        $this->categoria = $categoria;
        return $this;
    }

    public function setNumVisualizaciones($numVisualizaciones): Receta
    {
        $this->numVisualizaciones = $numVisualizaciones;
        return $this;
    }

    public function setNumLikes($numLikes): Receta
    {
        $this->numLikes = $numLikes;
        return $this;
    }

    public function setNumDownloads($numDownloads): Receta
    {
        $this->numDownloads = $numDownloads;
        return $this;
    }

    public function __toString()
    {
        return $this->descripcion;
    }


    public function getUrlImagenes()
    {
        return self::RUTA_IMAGENES_SUBIDAS . $this->getNombre();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombreArchivo' => $this->getNombreArchivo(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'numVisualizaciones' => $this->getNumVisualizaciones(),
            'numLikes' => $this->getNumLikes(),
            'numDownloads' => $this->getNumDownloads(),
            'categoria' => $this->getCategoria()
        ];
    }
}
