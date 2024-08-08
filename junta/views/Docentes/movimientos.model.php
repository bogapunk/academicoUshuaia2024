<?php
/*class MovimientosModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=junta;charset=utf8', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListaroMovimientos()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM _junta_movimientos order by  legdoc asc");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$mod = new Movimiento();

				$mod->__SET('anodoc', $r->anodoc);
				$mod->__SET('legdoc', $r->legdoc);
				$mod->__SET('codmod', $r->codmod);
			    $mod->__SET('establecimiento', $r->establecimiento);
			    $mod->__SET('titulo', $r->titulo);
			    $mod->__SET('promedio', $r->promedio);							
				$mod->__SET('antiguedadgestion', $r->antiguedadgestion);
				$mod->__SET('antiguedadtitulo', $r->antiguedadtitulo);
				$mod->__SET('serviciosprovincia', $r->serviciosprovincia);
				$mod->__SET('titulobas', $r->titulobas);
				$mod->__SET('otrosservicios', $r->otrosservicios);
				$mod->__SET('residencia', $r->residencia);
                $mod->__SET('publicaciones', $r->publicaciones);
                $mod->__SET('otrosantecedentes', $r->otrosantecedentes);
                $mod->__SET('puntajetotal', $r->puntajetotal);
                $mod->__SET('codloc', $r->codloc);
                $mod->__SET('tipo', $r->tipo);
                $mod->__SET('id2', $r->id2);
                $mod->__SET('t_m_seccion', $r->t_m_seccion);
                $mod->__SET('t_m_anio', $r->t_m_anio);
                $mod->__SET('t_m_grupo', $r->t_m_grupo);
                $mod->__SET('t_m_ciclo', $r->t_m_ciclo);
                $mod->__SET('t_m_recupera', $r->t_m_recupera);
                $mod->__SET('t_d_pu', $r->t_d_pu);
                $mod->__SET('t_d_3', $r->t_d_3);
                $mod->__SET('t_d_2', $r->t_d_2);
                $mod->__SET('t_d_1', $r->t_d_1);
                $mod->__SET('t_d_biblio', $r->t_d_biblio);
                $mod->__SET('t_d_gabi', $r->t_d_gabi);
                $mod->__SET('t_d_seccoortec', $r->t_d_seccoortec);
                $mod->__SET('t_d_supsectec', $r->t_d_supsectec);
                $mod->__SET('t_d_supesc', $r->t_d_supesc);
                $mod->__SET('t_d_supgral', $r->t_d_supgral);
                $mod->__SET('t_d_adic', $r->t_d_adic);
                $mod->__SET('o_g_a', $r->o_g_a);
                $mod->__SET('o_g_b', $r->o_g_b);
                $mod->__SET('o_g_c', $r->o_g_c);
                $mod->__SET('o_g_d', $r->o_g_d);
                $mod->__SET('concepto', $r->concepto);
                $mod->__SET('otitulo', $r->otitulo);
                $mod->__SET('t_m_biblio', $r->t_m_biblio);
                $mod->__SET('t_m_sec1', $r->t_m_sec1);
                $mod->__SET('t_m_sec2', $r->t_m_sec2);
                $mod->__SET('t_m_viced', $r->t_m_viced);
                $mod->__SET('t_m_gabinete', $r->t_m_gabinete);
                $mod->__SET('obs', $r->obs);
                $mod->__SET('horas', $r->horas);
                $mod->__SET('legvinc', $r->legvinc);
                $mod->__SET('hijos', $r->hijos);
                $mod->__SET('excluido', $r->excluido);
                $mod->__SET('fecha', $r->fecha);
                $mod->__SET('trial513', $r->trial513);




				$result[] = $mod;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

public function Listar_movimientos($offset = 0, $limit = 100)
{
    try
    {
        $result = array();

        // Consulta SQL modificada con los parámetros de límite y desplazamiento
        $sql = "SELECT * FROM _junta_movimientos ORDER BY legdoc ASC LIMIT :limit OFFSET :offset";
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stm->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stm->execute();

        foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
        {
            $mod = new Movimiento();
            $mod->__SET('id2', $r->id2);
            $mod->__SET('anodoc', $r->anodoc);
            $mod->__SET('legdoc', $r->legdoc);
            $mod->__SET('codmod', $r->codmod);
            $mod->__SET('establecimiento', $r->establecimiento);
            $mod->__SET('titulo', $r->titulo);
            $mod->__SET('promedio', $r->promedio);							
            $mod->__SET('antiguedadgestion', $r->antiguedadgestion);
            $mod->__SET('antiguedadtitulo', $r->antiguedadtitulo);
            $mod->__SET('serviciosprovincia', $r->serviciosprovincia);
            $mod->__SET('titulobas', $r->titulobas);
            $mod->__SET('otrosservicios', $r->otrosservicios);
            $mod->__SET('residencia', $r->residencia);
            $mod->__SET('publicaciones', $r->publicaciones);
            $mod->__SET('otrosantecedentes', $r->otrosantecedentes);
            $mod->__SET('puntajetotal', $r->puntajetotal);
            $mod->__SET('codloc', $r->codloc);
            $mod->__SET('tipo', $r->tipo);
            $mod->__SET('tipocarga', $r->tipocarga);
            $mod->__SET('t_m_seccion', $r->t_m_seccion);
            $mod->__SET('t_m_anio', $r->t_m_anio);
            $mod->__SET('t_m_grupo', $r->t_m_grupo);
            $mod->__SET('t_m_ciclo', $r->t_m_ciclo);
            $mod->__SET('t_m_recupera', $r->t_m_recupera);
            $mod->__SET('t_d_pu', $r->t_d_pu);
            $mod->__SET('t_d_3', $r->t_d_3);
            $mod->__SET('t_d_2', $r->t_d_2);
            $mod->__SET('t_d_1', $r->t_d_1);
            $mod->__SET('t_d_biblio', $r->t_d_biblio);
            $mod->__SET('t_d_gabi', $r->t_d_gabi);
            $mod->__SET('t_d_seccoortec', $r->t_d_seccoortec);
            $mod->__SET('t_d_supsectec', $r->t_d_supsectec);
            $mod->__SET('t_d_supesc', $r->t_d_supesc);
            $mod->__SET('t_d_supgral', $r->t_d_supgral);
            $mod->__SET('t_d_adic', $r->t_d_adic);
            $mod->__SET('o_g_a', $r->o_g_a);
            $mod->__SET('o_g_b', $r->o_g_b);
            $mod->__SET('o_g_c', $r->o_g_c);
            $mod->__SET('o_g_d', $r->o_g_d);
            $mod->__SET('concepto', $r->concepto);
            $mod->__SET('otitulo', $r->otitulo);
            $mod->__SET('t_m_comple', $r->t_m_comple);
            $mod->__SET('t_m_biblio', $r->t_m_biblio);
            $mod->__SET('t_m_sec1', $r->t_m_sec1);
            $mod->__SET('t_m_sec2', $r->t_m_sec2);
            $mod->__SET('t_m_viced', $r->t_m_viced);
            $mod->__SET('t_m_gabinete', $r->t_m_gabinete);
            $mod->__SET('obs', $r->obs);
            $mod->__SET('horas', $r->horas);
            $mod->__SET('legvinc', $r->legvinc);
            $mod->__SET('hijos', $r->hijos);
            $mod->__SET('excluido', $r->excluido);
            $mod->__SET('fecha', $r->fecha);
            $mod->__SET('trial513', $r->trial513);

            $result[] = $mod;
        }

        return $result;
    }
    catch(Exception $e)
    {
        die($e->getMessage());
    }
}



	public function ObtenerMovimiento($id2)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM _junta_movimientos WHERE id2 = ?");
			          

			$stm->execute(array($id2));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$mod = new Movimiento();

			    $mod->__SET('id2', $r->id2);
				$mod->__SET('anodoc', $r->anodoc);
				$mod->__SET('legdoc', $r->legdoc);
				$mod->__SET('codmod', $r->codmod);
			    $mod->__SET('establecimiento', $r->establecimiento);
			    $mod->__SET('titulo', $r->titulo);
			    $mod->__SET('promedio', $r->promedio);							
				$mod->__SET('antiguedadgestion', $r->antiguedadgestion);
				$mod->__SET('antiguedadtitulo', $r->antiguedadtitulo);
				$mod->__SET('serviciosprovincia', $r->serviciosprovincia);
				$mod->__SET('titulobas', $r->titulobas);
				$mod->__SET('otrosservicios', $r->otrosservicios);
				$mod->__SET('residencia', $r->residencia);
                $mod->__SET('publicaciones', $r->publicaciones);
                $mod->__SET('otrosantecedentes', $r->otrosantecedentes);
                $mod->__SET('puntajetotal', $r->puntajetotal);
                $mod->__SET('codloc', $r->codloc);
                $mod->__SET('tipo', $r->tipo);
                $mod->__SET('tipocarga', $r->tipocarga);
                $mod->__SET('t_m_seccion', $r->t_m_seccion);
                $mod->__SET('t_m_anio', $r->t_m_anio);
                $mod->__SET('t_m_grupo', $r->t_m_grupo);
                $mod->__SET('t_m_ciclo', $r->t_m_ciclo);
                $mod->__SET('t_m_recupera', $r->t_m_recupera);
                $mod->__SET('t_d_pu', $r->t_d_pu);
                $mod->__SET('t_d_3', $r->t_d_3);
                $mod->__SET('t_d_2', $r->t_d_2);
                $mod->__SET('t_d_1', $r->t_d_1);
                $mod->__SET('t_d_biblio', $r->t_d_biblio);
                $mod->__SET('t_d_gabi', $r->t_d_gabi);
                $mod->__SET('t_d_seccoortec', $r->t_d_seccoortec);
                $mod->__SET('t_d_supsectec', $r->t_d_supsectec);
                $mod->__SET('t_d_supesc', $r->t_d_supesc);
                $mod->__SET('t_d_supgral', $r->t_d_supgral);
                $mod->__SET('t_d_adic', $r->t_d_adic);
                $mod->__SET('o_g_a', $r->o_g_a);
                $mod->__SET('o_g_b', $r->o_g_b);
                $mod->__SET('o_g_c', $r->o_g_c);
                $mod->__SET('o_g_d', $r->o_g_d);
                $mod->__SET('concepto', $r->concepto);
                $mod->__SET('otitulo', $r->otitulo);
                $mod->__SET('t_m_comple', $r->t_m_comple);
                $mod->__SET('t_m_biblio', $r->t_m_biblio);
                $mod->__SET('t_m_sec1', $r->t_m_sec1);
                $mod->__SET('t_m_sec2', $r->t_m_sec2);
                $mod->__SET('t_m_viced', $r->t_m_viced);
                $mod->__SET('t_m_gabinete', $r->t_m_gabinete);
                $mod->__SET('obs', $r->obs);
                $mod->__SET('horas', $r->horas);
                $mod->__SET('legvinc', $r->legvinc);
                $mod->__SET('hijos', $r->hijos);
                $mod->__SET('excluido', $r->excluido);
                $mod->__SET('fecha', $r->fecha);
                $mod->__SET('trial513', $r->trial513);


			return $mod;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerLegajo($legajo)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM _junta_movimientos WHERE id2 = ?");
			          

			$stm->execute(array($id2));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$mod = new Movimiento();

			    $mod->__SET('id2', $r->id2);
				$mod->__SET('anodoc', $r->anodoc);
				$mod->__SET('legdoc', $r->legdoc);
				$mod->__SET('codmod', $r->codmod);
			    $mod->__SET('establecimiento', $r->establecimiento);
			    $mod->__SET('titulo', $r->titulo);
			    $mod->__SET('promedio', $r->promedio);							
				$mod->__SET('antiguedadgestion', $r->antiguedadgestion);
				$mod->__SET('antiguedadtitulo', $r->antiguedadtitulo);
				$mod->__SET('serviciosprovincia', $r->serviciosprovincia);
				$mod->__SET('titulobas', $r->titulobas);
				$mod->__SET('otrosservicios', $r->otrosservicios);
				$mod->__SET('residencia', $r->residencia);
                $mod->__SET('publicaciones', $r->publicaciones);
                $mod->__SET('otrosantecedentes', $r->otrosantecedentes);
                $mod->__SET('puntajetotal', $r->puntajetotal);
                $mod->__SET('codloc', $r->codloc);
                $mod->__SET('tipo', $r->tipo);
                $mod->__SET('tipocarga', $r->tipocarga);
                $mod->__SET('t_m_seccion', $r->t_m_seccion);
                $mod->__SET('t_m_anio', $r->t_m_anio);
                $mod->__SET('t_m_grupo', $r->t_m_grupo);
                $mod->__SET('t_m_ciclo', $r->t_m_ciclo);
                $mod->__SET('t_m_recupera', $r->t_m_recupera);
                $mod->__SET('t_d_pu', $r->t_d_pu);
                $mod->__SET('t_d_3', $r->t_d_3);
                $mod->__SET('t_d_2', $r->t_d_2);
                $mod->__SET('t_d_1', $r->t_d_1);
                $mod->__SET('t_d_biblio', $r->t_d_biblio);
                $mod->__SET('t_d_gabi', $r->t_d_gabi);
                $mod->__SET('t_d_seccoortec', $r->t_d_seccoortec);
                $mod->__SET('t_d_supsectec', $r->t_d_supsectec);
                $mod->__SET('t_d_supesc', $r->t_d_supesc);
                $mod->__SET('t_d_supgral', $r->t_d_supgral);
                $mod->__SET('t_d_adic', $r->t_d_adic);
                $mod->__SET('o_g_a', $r->o_g_a);
                $mod->__SET('o_g_b', $r->o_g_b);
                $mod->__SET('o_g_c', $r->o_g_c);
                $mod->__SET('o_g_d', $r->o_g_d);
                $mod->__SET('concepto', $r->concepto);
                $mod->__SET('otitulo', $r->otitulo);
                $mod->__SET('t_m_comple', $r->t_m_comple);
                $mod->__SET('t_m_biblio', $r->t_m_biblio);
                $mod->__SET('t_m_sec1', $r->t_m_sec1);
                $mod->__SET('t_m_sec2', $r->t_m_sec2);
                $mod->__SET('t_m_viced', $r->t_m_viced);
                $mod->__SET('t_m_gabinete', $r->t_m_gabinete);
                $mod->__SET('obs', $r->obs);
                $mod->__SET('horas', $r->horas);
                $mod->__SET('legvinc', $r->legvinc);
                $mod->__SET('hijos', $r->hijos);
                $mod->__SET('excluido', $r->excluido);
                $mod->__SET('fecha', $r->fecha);
                $mod->__SET('trial513', $r->trial513);


			return $mod;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarMovimiento($id2)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM _junta_movimientos WHERE id2 = ?");			          

			$stm->execute(array($id2));
            
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
  



	public function ActualizarMovimiento(Movimiento $mod)
	{
		try 
		{
			$sql = "UPDATE _junta_movimientos SET 

                    anodoc= ?,
	                legdoc= ?,
                    codmod= ?,
                    establecimiento= ?,
                    titulo= ?,
                    promedio= ?,
	                antiguedadgestion= ?,
	                antiguedadtitulo= ?,
	                serviciosprovincia= ?,
	                otrosservicios= ?,
	                residencia= ?,
                    publicaciones= ?,
                    otrosantecedentes= ?,
                    puntajetotal= ?,
                    codloc= ?,
                    tipo= ?,
                    tipocarga=?,
                    t_m_seccion= ?,
                    t_m_anio= ?,
                    t_m_grupo= ?,
                    t_m_ciclo= ?,
                    t_m_recupera= ?,
                    t_d_pu= ?,
                    t_d_3= ?,
                    t_d_2= ?,
                    t_d_1= ?,
                    t_d_biblio= ?,
                    t_d_gabi= ?,
                    t_d_seccoortec= ?,
                    t_d_supsectec= ?,
                    t_d_supesc= ?,
                    t_d_supgral= ?,
                    t_d_adic= ?,
                    o_g_a= ?,
                    o_g_b= ?,
                    o_g_c= ?,
                    o_g_d= ?,
                    concepto= ?,
                    otitulo= ?,
                    t_m_comple=?
                    t_m_biblio= ?,
                    t_m_sec1= ?,
                    t_m_sec2= ?,
                    t_m_viced= ?,
                    t_m_gabinete= ?,
                    obs= ?,
                    horas= ?,
                    legvinc= ?,
                    hijos= ?,
                    excluido= ?,
                    fecha= ?,
                    trial513= ?,  		
				    WHERE id2 = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$mod->__GET('anodoc'),
                    $mod->__GET('legdoc'),
                    $mod->__GET('codmod'),
                    $mod->__GET('establecimiento'),
                    $mod->__GET('titulo'),
                    $mod->__GET('promedio'),
                    $mod->__GET('antiguedadgestion'),
                    $mod->__GET('antiguedadtitulo'),
                    $mod->__GET('serviciosprovincia'),
                    $mod->__GET('otrosservicios'),
                    $mod->__GET('residencia'),
                    $mod->__GET('publicaciones'),
                    $mod->__GET('otrosantecedentes'),
                    $mod->__GET('puntajetotal'),
                    $mod->__GET('codloc'),
                    $mod->__GET('tipo'),
                    $mod->__get('tipocarga'),
                    $mod->__GET('id2'),
                    $mod->__GET('t_m_seccion'),
                    $mod->__GET('t_m_anio'),
                    $mod->__GET('t_m_grupo'),
                    $mod->__GET('t_m_ciclo'),
                    $mod->__GET('t_m_recupera'),
                    $mod->__GET('t_d_pu'),
                    $mod->__GET('t_d_3'),
                    $mod->__GET('t_d_2'),
                    $mod->__GET('t_d_1'),
                    $mod->__GET('t_d_biblio'),
                    $mod->__GET('t_d_gabi'),
                    $mod->__GET('t_d_seccoortec'),
                    $mod->__GET('t_d_supsectec'),
                    $mod->__GET('t_d_supesc'),
                    $mod->__GET('t_d_supgral'),
                    $mod->__GET('t_d_adic'),
                    $mod->__GET('o_g_a'),
                    $mod->__GET('o_g_b'),
                    $mod->__GET('o_g_c'),
                    $mod->__GET('o_g_d'),
                    $mod->__GET('concepto'),
                    $mod->__GET('otitulo'),
                    $mod->__GET('t_m_comple'),
                    $mod->__GET('t_m_biblio'),
                    $mod->__GET('t_m_sec1'),
                    $mod->__GET('t_m_sec2'),
                    $mod->__GET('t_m_viced'),
                    $mod->__GET('t_m_gabinete'),
                    $mod->__GET('obs'),
                    $mod->__GET('horas'),
                    $mod->__GET('legvinc'),
                    $mod->__GET('hijos'),
                    $mod->__GET('excluido'),
                    $mod->__GET('fecha'),
                    $mod->__GET('trial513'),
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
 
	public function RegistrarMovimiento(Movimiento $mod)
	{
         // Ejecutar la consulta SQL para insertar el registro en la base de datos
		try 
		{
		 $sql = "INSERT INTO _junta_movimientos (anodoc, legdoc, codmod, establecimiento, titulo, promedio, antiguedadgestion, antiguedadtitulo, serviciosprovincia, otrosservicios, residencia, publicaciones, otrosantecedentes, puntajetotal, codloc, tipo,tipocarga, id2, t_m_seccion, t_m_anio, t_m_grupo, t_m_ciclo, t_m_recupera, t_d_pu, t_d_3, t_d_2, t_d_1, t_d_biblio, t_d_gabi, t_d_seccoortec, t_d_supsectec, t_d_supesc, t_d_supgral, t_d_adic, o_g_a, o_g_b, o_g_c, o_g_d, concepto, otitulo,t_m_comple, t_m_biblio, t_m_sec1, t_m_sec2, t_m_viced, t_m_gabinete, obs, horas, legvinc, hijos, excluido, fecha, trial513) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $mod->__GET('anodoc'),
                        $mod->__GET('legdoc'),
                        $mod->__GET('codmod'),
                        $mod->__GET('establecimiento'),
                        $mod->__GET('titulo'),
                        $mod->__GET('promedio'),
                        $mod->__GET('antiguedadgestion'),
                        $mod->__GET('antiguedadtitulo'),
                        $mod->__GET('serviciosprovincia'),
                        $mod->__GET('otrosservicios'),
                        $mod->__GET('residencia'),
                        $mod->__GET('publicaciones'),
                        $mod->__GET('otrosantecedentes'),
                        $mod->__GET('puntajetotal'),
                        $mod->__GET('codloc'),
                        $mod->__GET('tipo'),
                        $mod->__GET('tipocarga'),
                        $mod->__GET('id2'),
                        $mod->__GET('t_m_seccion'),
                        $mod->__GET('t_m_anio'),
                        $mod->__GET('t_m_grupo'),
                        $mod->__GET('t_m_ciclo'),
                        $mod->__GET('t_m_recupera'),
                        $mod->__GET('t_d_pu'),
                        $mod->__GET('t_d_3'),
                        $mod->__GET('t_d_2'),
                        $mod->__GET('t_d_1'),
                        $mod->__GET('t_d_biblio'),
                        $mod->__GET('t_d_gabi'),
                        $mod->__GET('t_d_seccoortec'),
                        $mod->__GET('t_d_supsectec'),
                        $mod->__GET('t_d_supesc'),
                        $mod->__GET('t_d_supgral'),
                        $mod->__GET('t_d_adic'),
                        $mod->__GET('o_g_a'),
                        $mod->__GET('o_g_b'),
                        $mod->__GET('o_g_c'),
                        $mod->__GET('o_g_d'),
                        $mod->__GET('concepto'),
                        $mod->__GET('otitulo'),
                        $mod->__GET('t_m_comple'),
                        $mod->__GET('t_m_biblio'),
                        $mod->__GET('t_m_sec1'),
                        $mod->__GET('t_m_sec2'),
                        $mod->__GET('t_m_viced'),
                        $mod->__GET('t_m_gabinete'),
                        $mod->__GET('obs'),
                        $mod->__GET('horas'),
                        $mod->__GET('legvinc'),
                        $mod->__GET('hijos'),
                        $mod->__GET('excluido'),
                        $mod->__GET('fecha'),
                        $mod->__GET('trial513'),
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}


			   		 function ListarMovimientos()
				   {
					try
					{
						$result = array();

						$stm = $this->pdo->prepare("SELECT * FROM _junta_movimientos order by legajo asc");
						$stm->execute();

						foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
						{
							$mod = new Movimiento();

							$mod->__SET('legajo', $r->legajo);
							$mod->__SET('legdoc', $r->legdoc);
							$mod->__SET('codmod', $r->codmod);
                            $mod->__SET('codmod');
                            $mod->__SET('establecimiento');
                            $mod->__SET('titulo');
                            $mod->__SET('promedio');
                            $mod->__SET('antiguedadgestion');
                            $mod->__SET('antiguedadtitulo');
                            $mod->__SET('serviciosprovincia');
                            $mod->__SET('otrosservicios');
                            $mod->__SET('residencia');
                            $mod->__GET('publicaciones');
                            $mod->__SET('otrosantecedentes');
                            $mod->__SET('puntajetotal');
                            $mod->__SET('codloc');
                            $mod->__SET('tipo');
                            $mod->__SET('tipocarga');
                            $mod->__SET('id2');
                            $mod->__SET('t_m_seccion');
                            $mod->__SET('t_m_anio');
                            $mod->__SET('t_m_grupo');
                            $mod->__SET('t_m_ciclo');
                            $mod->__SET('t_m_recupera');
                            $mod->__SET('t_d_pu');
                            $mod->__SET('t_d_3');
                            $mod->__SET('t_d_2');
                            $mod->__SET('t_d_1');
                            $mod->__SET('t_d_biblio');
                            $mod->__SET('t_d_gabi');
                            $mod->__SET('t_d_seccoortec');
                            $mod->__SET('t_d_supsectec');
                            $mod->__SET('t_d_supesc');
                            $mod->__SET('t_d_supgral');
                            $mod->__SET('t_d_adic');
                            $mod->__SET('o_g_a');
                            $mod->__SET('o_g_b');
                            $mod->__SET('o_g_c');
                            $mod->__SET('o_g_d');
                            $mod->__SET('concepto');
                            $mod->__SET('otitulo');
                            $mod->__SET('t_m_comple');
                            $mod->__SET('t_m_biblio');
                            $mod->__SET('t_m_sec1');
                            $mod->__SET('t_m_sec2');
                            $mod->__SET('t_m_viced');
                            $mod->__SET('t_m_gabinete');
                            $mod->__SET('obs');
                            $mod->__SET('horas');
                            $mod->__SET('legvinc');
                            $mod->__SET('hijos');
                            $mod->__SET('excluido');
                            $mod->__SET('fecha');
                            $mod->__SET('trial513');
						    
			              

							$result[] = $mod;
						}

						return $result;
					}
					catch(Exception $e)
					{
						die($e->getMessage());
					}
	        }







	}


							

}
 codigo anterior con mysql 
*/



class MovimientosModel
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try
        {
            $serverName = "db";
            $database = "junta";
            $username = "SA";
            $password = '"asd123"';

            $this->pdo = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ListaroMovimientos()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM _junta_movimientos ORDER BY legdoc ASC");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $mod = new Movimiento();

                $mod->__SET('anodoc', $r->anodoc);
                $mod->__SET('legdoc', $r->legdoc);
                $mod->__SET('codmod', $r->codmod);
                $mod->__SET('establecimiento', $r->establecimiento);
                $mod->__SET('titulo', $r->titulo);
                $mod->__SET('promedio', $r->promedio);
                $mod->__SET('antiguedadgestion', $r->antiguedadgestion);
                $mod->__SET('antiguedadtitulo', $r->antiguedadtitulo);
                $mod->__SET('serviciosprovincia', $r->serviciosprovincia);
                $mod->__SET('titulobas', $r->titulobas);
                $mod->__SET('otrosservicios', $r->otrosservicios);
                $mod->__SET('residencia', $r->residencia);
                $mod->__SET('publicaciones', $r->publicaciones);
                $mod->__SET('otrosantecedentes', $r->otrosantecedentes);
                $mod->__SET('puntajetotal', $r->puntajetotal);
                $mod->__SET('codloc', $r->codloc);
                $mod->__SET('tipo', $r->tipo);
                $mod->__SET('id2', $r->id2);
                $mod->__SET('t_m_seccion', $r->t_m_seccion);
                $mod->__SET('t_m_anio', $r->t_m_anio);
                $mod->__SET('t_m_grupo', $r->t_m_grupo);
                $mod->__SET('t_m_ciclo', $r->t_m_ciclo);
                $mod->__SET('t_m_recupera', $r->t_m_recupera);
                $mod->__SET('t_d_pu', $r->t_d_pu);
                $mod->__SET('t_d_3', $r->t_d_3);
                $mod->__SET('t_d_2', $r->t_d_2);
                $mod->__SET('t_d_1', $r->t_d_1);
                $mod->__SET('t_d_biblio', $r->t_d_biblio);
                $mod->__SET('t_d_gabi', $r->t_d_gabi);
                $mod->__SET('t_d_seccoortec', $r->t_d_seccoortec);
                $mod->__SET('t_d_supsectec', $r->t_d_supsectec);
                $mod->__SET('t_d_supesc', $r->t_d_supesc);
                $mod->__SET('t_d_supgral', $r->t_d_supgral);
                $mod->__SET('t_d_adic', $r->t_d_adic);
                $mod->__SET('o_g_a', $r->o_g_a);
                $mod->__SET('o_g_b', $r->o_g_b);
                $mod->__SET('o_g_c', $r->o_g_c);
                $mod->__SET('o_g_d', $r->o_g_d);
                $mod->__SET('concepto', $r->concepto);
                $mod->__SET('otitulo', $r->otitulo);
                $mod->__SET('t_m_biblio', $r->t_m_biblio);
                $mod->__SET('t_m_sec1', $r->t_m_sec1);
                $mod->__SET('t_m_sec2', $r->t_m_sec2);
                $mod->__SET('t_m_viced', $r->t_m_viced);
                $mod->__SET('t_m_gabinete', $r->t_m_gabinete);
                $mod->__SET('obs', $r->obs);
                $mod->__SET('horas', $r->horas);
                $mod->__SET('legvinc', $r->legvinc);
                $mod->__SET('hijos', $r->hijos);
                $mod->__SET('excluido', $r->excluido);
                $mod->__SET('fecha', $r->fecha);
                $mod->__SET('trial513', $r->trial513);

                $result[] = $mod;
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Listar_movimientos($offset = 0, $limit = 100)
    {
        try
        {
            $result = array();

            $sql = "SELECT * FROM _junta_movimientos ORDER BY legdoc ASC OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stm->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $mod = new Movimiento();
                $mod->__SET('id2', $r->id2);
                $mod->__SET('anodoc', $r->anodoc);
                $mod->__SET('legdoc', $r->legdoc);
                $mod->__SET('codmod', $r->codmod);
                $mod->__SET('establecimiento', $r->establecimiento);
                $mod->__SET('titulo', $r->titulo);
                $mod->__SET('promedio', $r->promedio);
                $mod->__SET('antiguedadgestion', $r->antiguedadgestion);
                $mod->__SET('antiguedadtitulo', $r->antiguedadtitulo);
                $mod->__SET('serviciosprovincia', $r->serviciosprovincia);
                $mod->__SET('titulobas', $r->titulobas);
                $mod->__SET('otrosservicios', $r->otrosservicios);
                $mod->__SET('residencia', $r->residencia);
                $mod->__SET('publicaciones', $r->publicaciones);
                $mod->__SET('otrosantecedentes', $r->otrosantecedentes);
                $mod->__SET('puntajetotal', $r->puntajetotal);
                $mod->__SET('codloc', $r->codloc);
                $mod->__SET('tipo', $r->tipo);
                $mod->__SET('tipocarga', $r->tipocarga);
                $mod->__SET('t_m_seccion', $r->t_m_seccion);
                $mod->__SET('t_m_anio', $r->t_m_anio);
                $mod->__SET('t_m_grupo', $r->t_m_grupo);
                $mod->__SET('t_m_ciclo', $r->t_m_ciclo);
                $mod->__SET('t_m_recupera', $r->t_m_recupera);
                $mod->__SET('t_d_pu', $r->t_d_pu);
                $mod->__SET('t_d_3', $r->t_d_3);
                $mod->__SET('t_d_2', $r->t_d_2);
                $mod->__SET('t_d_1', $r->t_d_1);
                $mod->__SET('t_d_biblio', $r->t_d_biblio);
                $mod->__SET('t_d_gabi', $r->t_d_gabi);
                $mod->__SET('t_d_seccoortec', $r->t_d_seccoortec);
                $mod->__SET('t_d_supsectec', $r->t_d_supsectec);
                $mod->__SET('t_d_supesc', $r->t_d_supesc);
                $mod->__SET('t_d_supgral', $r->t_d_supgral);
                $mod->__SET('t_d_adic', $r->t_d_adic);
                $mod->__SET('o_g_a', $r->o_g_a);
                $mod->__SET('o_g_b', $r->o_g_b);
                $mod->__SET('o_g_c', $r->o_g_c);
                $mod->__SET('o_g_d', $r->o_g_d);
                $mod->__SET('concepto', $r->concepto);
                $mod->__SET('otitulo', $r->otitulo);
                $mod->__SET('t_m_biblio', $r->t_m_biblio);
                $mod->__SET('t_m_sec1', $r->t_m_sec1);
                $mod->__SET('t_m_sec2', $r->t_m_sec2);
                $mod->__SET('t_m_viced', $r->t_m_viced);
                $mod->__SET('t_m_gabinete', $r->t_m_gabinete);
                $mod->__SET('obs', $r->obs);
                $mod->__SET('horas', $r->horas);
                $mod->__SET('legvinc', $r->legvinc);
                $mod->__SET('hijos', $r->hijos);
                $mod->__SET('excluido', $r->excluido);
                $mod->__SET('fecha', $r->fecha);
                $mod->__SET('trial513', $r->trial513);

                $result[] = $mod;
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function TotalMovimientos()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT COUNT(*) as total FROM _junta_movimientos");
            $stm->execute();

            $total = $stm->fetch(PDO::FETCH_OBJ)->total;

            return $total;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
     
    public function ActualizarMovimiento(Movimiento $mod)
	{
		try 
		{
			$sql = "UPDATE _junta_movimientos SET 

                    anodoc= ?,
	                legdoc= ?,
                    codmod= ?,
                    establecimiento= ?,
                    titulo= ?,
                    promedio= ?,
	                antiguedadgestion= ?,
	                antiguedadtitulo= ?,
	                serviciosprovincia= ?,
	                otrosservicios= ?,
	                residencia= ?,
                    publicaciones= ?,
                    otrosantecedentes= ?,
                    puntajetotal= ?,
                    codloc= ?,
                    tipo= ?,
                    tipocarga=?,
                    t_m_seccion= ?,
                    t_m_anio= ?,
                    t_m_grupo= ?,
                    t_m_ciclo= ?,
                    t_m_recupera= ?,
                    t_d_pu= ?,
                    t_d_3= ?,
                    t_d_2= ?,
                    t_d_1= ?,
                    t_d_biblio= ?,
                    t_d_gabi= ?,
                    t_d_seccoortec= ?,
                    t_d_supsectec= ?,
                    t_d_supesc= ?,
                    t_d_supgral= ?,
                    t_d_adic= ?,
                    o_g_a= ?,
                    o_g_b= ?,
                    o_g_c= ?,
                    o_g_d= ?,
                    concepto= ?,
                    otitulo= ?,
                    t_m_comple=?
                    t_m_biblio= ?,
                    t_m_sec1= ?,
                    t_m_sec2= ?,
                    t_m_viced= ?,
                    t_m_gabinete= ?,
                    obs= ?,
                    horas= ?,
                    legvinc= ?,
                    hijos= ?,
                    excluido= ?,
                    fecha= ?
                    	
				    WHERE id2 = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$mod->__GET('anodoc'),
                    $mod->__GET('legdoc'),
                    $mod->__GET('codmod'),
                    $mod->__GET('establecimiento'),
                    $mod->__GET('titulo'),
                    $mod->__GET('promedio'),
                    $mod->__GET('antiguedadgestion'),
                    $mod->__GET('antiguedadtitulo'),
                    $mod->__GET('serviciosprovincia'),
                    $mod->__GET('otrosservicios'),
                    $mod->__GET('residencia'),
                    $mod->__GET('publicaciones'),
                    $mod->__GET('otrosantecedentes'),
                    $mod->__GET('puntajetotal'),
                    $mod->__GET('codloc'),
                    $mod->__GET('tipo'),
                    $mod->__get('tipocarga'),
                    $mod->__GET('id2'),
                    $mod->__GET('t_m_seccion'),
                    $mod->__GET('t_m_anio'),
                    $mod->__GET('t_m_grupo'),
                    $mod->__GET('t_m_ciclo'),
                    $mod->__GET('t_m_recupera'),
                    $mod->__GET('t_d_pu'),
                    $mod->__GET('t_d_3'),
                    $mod->__GET('t_d_2'),
                    $mod->__GET('t_d_1'),
                    $mod->__GET('t_d_biblio'),
                    $mod->__GET('t_d_gabi'),
                    $mod->__GET('t_d_seccoortec'),
                    $mod->__GET('t_d_supsectec'),
                    $mod->__GET('t_d_supesc'),
                    $mod->__GET('t_d_supgral'),
                    $mod->__GET('t_d_adic'),
                    $mod->__GET('o_g_a'),
                    $mod->__GET('o_g_b'),
                    $mod->__GET('o_g_c'),
                    $mod->__GET('o_g_d'),
                    $mod->__GET('concepto'),
                    $mod->__GET('otitulo'),
                    $mod->__GET('t_m_comple'),
                    $mod->__GET('t_m_biblio'),
                    $mod->__GET('t_m_sec1'),
                    $mod->__GET('t_m_sec2'),
                    $mod->__GET('t_m_viced'),
                    $mod->__GET('t_m_gabinete'),
                    $mod->__GET('obs'),
                    $mod->__GET('horas'),
                    $mod->__GET('legvinc'),
                    $mod->__GET('hijos'),
                    $mod->__GET('excluido'),
                    $mod->__GET('fecha'),
                    
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}






}
