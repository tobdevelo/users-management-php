<?php

declare(strict_types=1);

/**
 * Command DTO inmutable para la creación de una nueva Noticia.
 */
final class CreateNoticiaCommand
{
    private string $id;
    private string $categoria;
    private string $fecha;
    private string $pais;
    private string $departamento;
    private string $ciudad;
    private string $periodista;
    private string $programaEmite;
    private string $fechaEmision;
    private string $descripcion;
    private string $nivelPublico;

    public function __construct(
        string $id,
        string $categoria,
        string $fecha,
        string $pais,
        string $departamento,
        string $ciudad,
        string $periodista,
        string $programaEmite,
        string $fechaEmision,
        string $descripcion,
        string $nivelPublico
    ) {
        $this->id = trim($id);
        $this->categoria = trim($categoria);
        $this->fecha = trim($fecha);
        $this->pais = trim($pais);
        $this->departamento = trim($departamento);
        $this->ciudad = trim($ciudad);
        $this->periodista = trim($periodista);
        $this->programaEmite = trim($programaEmite);
        $this->fechaEmision = trim($fechaEmision);
        $this->descripcion = trim($descripcion);
        $this->nivelPublico = trim($nivelPublico);
    }

    public function getId(): string { return $this->id; }
    public function getCategoria(): string { return $this->categoria; }
    public function getFecha(): string { return $this->fecha; }
    public function getPais(): string { return $this->pais; }
    public function getDepartamento(): string { return $this->departamento; }
    public function getCiudad(): string { return $this->ciudad; }
    public function getPeriodista(): string { return $this->periodista; }
    public function getProgramaEmite(): string { return $this->programaEmite; }
    public function getFechaEmision(): string { return $this->fechaEmision; }
    public function getDescripcion(): string { return $this->descripcion; }
    public function getNivelPublico(): string { return $this->nivelPublico; }
}