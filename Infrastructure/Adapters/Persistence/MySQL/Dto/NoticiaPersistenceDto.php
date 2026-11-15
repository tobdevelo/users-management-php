<?php

declare(strict_types=1);

/**
 * DTO de persistencia que transporta los datos planos de Noticia hacia la capa de base de datos.
 */
final class NoticiaPersistenceDto
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

    public function id(): string { return $this->id; }
    public function categoria(): string { return $this->categoria; }
    public function fecha(): string { return $this->fecha; }
    public function pais(): string { return $this->pais; }
    public function departamento(): string { return $this->departamento; }
    public function ciudad(): string { return $this->ciudad; }
    public function periodista(): string { return $this->periodista; }
    public function programaEmite(): string { return $this->programaEmite; }
    public function fechaEmision(): string { return $this->fechaEmision; }
    public function descripcion(): string { return $this->descripcion; }
    public function nivelPublico(): string { return $this->nivelPublico; }
}