<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imagenes
 *
 * @ORM\Table(name="imagenes")
 * @ORM\Entity
 */
class Imagenes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=500, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="string", length=30, nullable=false)
     */
    private $texto;

    /**
     * @var int
     *
     * @ORM\Column(name="alto", type="integer", nullable=false)
     */
    private $alto;

    /**
     * @var int
     *
     * @ORM\Column(name="ancho", type="integer", nullable=false)
     */
    private $ancho;

    /**
     * @var string
     *
     * @ORM\Column(name="colores", type="text", length=65535, nullable=false)
     */
    private $colores;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

        return $this;
    }

    public function getAlto(): ?int
    {
        return $this->alto;
    }

    public function setAlto(int $alto): self
    {
        $this->alto = $alto;

        return $this;
    }

    public function getAncho(): ?int
    {
        return $this->ancho;
    }

    public function setAncho(int $ancho): self
    {
        $this->ancho = $ancho;

        return $this;
    }

    public function getColores(): ?string
    {
        return $this->colores;
    }

    public function setColores(string $colores): self
    {
        $this->colores = $colores;

        return $this;
    }


}
