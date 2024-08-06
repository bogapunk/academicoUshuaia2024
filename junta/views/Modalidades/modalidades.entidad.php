<?php
class Modalidad
{
	private $id;
	private $codmod;
	private $nommod;
	private $titulo;
	private $tope;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}