<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/NoticiaId.php';
require_once __DIR__ . '/../ValueObjects/NoticiaCategoria.php';
require_once __DIR__ . '/../ValueObjects/NoticiaFecha.php';
require_once __DIR__ . '/../ValueObjects/NoticiaPais.php';
require_once __DIR__ . '/../ValueObjects/NoticiaDepartamento.php';
require_once __DIR__ . '/../ValueObjects/NoticiaCiudad.php';
require_once __DIR__ . '/../ValueObjects/NoticiaPeriodista.php';
require_once __DIR__ . '/../ValueObjects/NoticiaProgramaEmite.php';
require_once __DIR__ . '/../ValueObjects/NoticiaFechaEmision.php';
require_once __DIR__ . '/../ValueObjects/NoticiaDescripcion.php';
require_once __DIR__ . '/../Enums/NivelPublicoEnum.php';

/**
 * Modelo de Dominio Rico e inmutable para la entidad Noticia (Ejercicio 29).
 */
final class NoticiaModel
{
    private NoticiaId $id;
    private NoticiaCategoria $categoria;
    private NoticiaFecha $fecha;
    private NoticiaPais $pais;
    private NoticiaDepartamento $departamento;
    private NoticiaCiudad $ciudad;
    private NoticiaPeriodista $periodista;
    private NoticiaProgramaEmite $programaEmite;
    private NoticiaFechaEmision $fechaEmision;
    private NoticiaDescripcion $descripcion;
    private string $nivelPublico;

    public function __construct(
        NoticiaId $id,
        NoticiaCategoria $categoria,
        NoticiaFecha $fecha,
        NoticiaPais $pais,
        NoticiaDepartamento $departamento,
        NoticiaCiudad $ciudad,
        NoticiaPeriodista $periodista,
        NoticiaProgramaEmite $programaEmite,
        NoticiaFechaEmision $fechaEmision,
        NoticiaDescripcion $descripcion,
        string $nivelPublico
    ) {
        $normalizedNivel = strtoupper(trim($nivelPublico));
        NivelPublicoEnum::ensureIsValid($normalizedNivel);

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
        $this->nivelPublico = $normalizedNivel;
    }

    /**
     * Named Constructor para crear una nueva Noticia.
     */
    public static function create(
        NoticiaId $id,
        NoticiaCategoria $categoria,
        NoticiaFecha $fecha,
        NoticiaPais $pais,
        NoticiaDepartamento $departamento,
        NoticiaCiudad $ciudad,
        NoticiaPeriodista $periodista,
        NoticiaProgramaEmite $programaEmite,
        NoticiaFechaEmision $fechaEmision,
        NoticiaDescripcion $descripcion,
        string $nivelPublico
    ): self {
        return new self(
            $id,
            $categoria,
            $fecha,
            $pais,
            $departamento,
            $ciudad,
            $periodista,
            $programaEmite,
            $fechaEmision,
            $descripcion,
            $nivelPublico
        );
    }

    public function id(): NoticiaId
    {
        return $this->id;
    }

    public function categoria(): NoticiaCategoria
    {
        return $this->categoria;
    }

    public function fecha(): NoticiaFecha
    {
        return $this->fecha;
    }

    public function pais(): NoticiaPais
    {
        return $this->pais;
    }

    public function departamento(): NoticiaDepartamento
    {
        return $this->departamento;
    }

    public function ciudad(): NoticiaCiudad
    {
        return $this->ciudad;
    }

    public function periodista(): NoticiaPeriodista
    {
        return $this->periodista;
    }

    public function programaEmite(): NoticiaProgramaEmite
    {
        return $this->programaEmite;
    }

    public function fechaEmision(): NoticiaFechaEmision
    {
        return $this->fechaEmision;
    }

    public function descripcion(): NoticiaDescripcion
    {
        return $this->descripcion;
    }

    public function nivelPublico(): string
    {
        return $this->nivelPublico;
    }

    /**
     * Devuelve una nueva instancia inmutable con los datos actualizados.
     */
    public function update(
        NoticiaCategoria $categoria,
        NoticiaFecha $fecha,
        NoticiaPais $pais,
        NoticiaDepartamento $departamento,
        NoticiaCiudad $ciudad,
        NoticiaPeriodista $periodista,
        NoticiaProgramaEmite $programaEmite,
        NoticiaFechaEmision $fechaEmision,
        NoticiaDescripcion $descripcion,
        string $nivelPublico
    ): self {
        return new self(
            $this->id,
            $categoria,
            $fecha,
            $pais,
            $departamento,
            $ciudad,
            $periodista,
            $programaEmite,
            $fechaEmision,
            $descripcion,
            $nivelPublico
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'categoria' => $this->categoria->value(),
            'fecha' => $this->fecha->value(),
            'pais' => $this->pais->value(),
            'departamento' => $this->departamento->value(),
            'ciudad' => $this->ciudad->value(),
            'periodista' => $this->periodista->value(),
            'programaEmite' => $this->programaEmite->value(),
            'fechaEmision' => $this->fechaEmision->value(),
            'descripcion' => $this->descripcion->value(),
            'nivelPublico' => $this->nivelPublico,
        ];
    }
}