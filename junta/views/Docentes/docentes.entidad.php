<?php
class Docente
{
	private $id2;
	private $legajo;
	private $apellidoynombre;
	private $nacionalidad;
	private $fechanacim;
	private $dni;
	private $domicilio;
	private $telefonos;
	private $titulobas;
	private $otorgadopor;
	private $fechatit;
    private $promediot;
    private $otrostit;
    private $cargosdocentes;
    private $obsdoc;
    private $fingreso;
    private $finicio;
    private $faperturaleg;
    private $lugarinsc;
  
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}