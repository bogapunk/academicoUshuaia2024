<?php
class ConfiguracionListados
{
	private $id;
	private $id2;
	private $listado;
	private $modalidades;
	private $ciudad;


	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}