<?php

declare(strict_types=1);

/**
 * Entidad de persistencia que representa una fila exacta de la tabla `noticias`.
 */
final class NoticiaEntity
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
    private ?string $createdAt;
    private ?string $updatedAt;

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
        string $nivelPublico,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ) {
        $this->id = $id;
        $this->categoria = $categoria;
        $this->fecha = $fecha;
        $this->pais = $pais;
        $this->departamento = $departamento;
        $this->ciudad = $ciudad;
        $this->periodista = $periodista;
        $this->programaEmite = $programaEmite;
        $this->fechaEmision = $fechaEmision;
        $this->descripcion = $descripcion;
        $this->nivelPublico = $nivelPublico;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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
    public function createdAt(): ?string { return $this->createdAt; }
    public function updatedAt(): ?string { return $this->updatedAt; }
}