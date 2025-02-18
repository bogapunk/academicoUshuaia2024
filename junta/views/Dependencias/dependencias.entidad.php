<?php
class Dependencia
{
    private $codniv;
    private $coddep;
    private $nomdep;
    private $domicilio;
    private $directo;
    private $interno;
    private $codloc;
    private $CUISE;  // Agregar esta propiedad si es necesaria

    public function __GET($k) { return $this->$k; }
    public function __SET($k, $v) { return $this->$k = $v; }
}