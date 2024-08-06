<?php
class Movimiento
{
	private $anodoc;
	private $legdoc;
	private $codmod;
	private $establecimiento;
	private $titulo;
	private $promedio;
	private $antiguedadgestion;
	private $antiguedadtitulo;
	private $serviciosprovincia;
	private $otrosservicios;
	private $residencia;
    private $publicaciones;
    private $otrosantecedentes;
    private $puntajetotal;
    private $codloc;
    private $tipo ;
    private $tipocarga;
    private $id2;
    private $t_m_seccion;
    private $t_m_anio;
    private $t_m_grupo;
    private $t_m_ciclo;
    private $t_m_recupera;
    private $t_d_pu;
    private $t_d_3;
    private $t_d_2;
    private $t_d_1;
    private $t_d_biblio;
    private $t_d_gabi;
    private $t_d_seccoortec;
    private $t_d_supsectec;
    private $t_d_supesc;
    private $t_d_supgral;
    private $t_d_adic;
    private $o_g_a;
    private $o_g_b;
    private $o_g_c;
    private $o_g_d;
    private $concepto;
    private $otitulo;
    private $t_m_biblio;
    private $t_m_sec1;
    private $t_m_sec2;
    private $t_m_viced;
    private $t_m_gabinete;
    private $obs;
    private $horas;
    private $legvinc;
    private $hijos;
    private $excluido;
    private $fecha;
    private $trial513;  
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}