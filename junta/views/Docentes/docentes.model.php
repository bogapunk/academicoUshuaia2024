<?php
/* codigo anterior con conexion a mysql
class DocentesModel
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

	public function Listar5()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM _junta_docentes order by  legajo asc");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$mod = new Docente();

				$mod->__SET('id2', $r->id2);
				$mod->__SET('legajo', $r->legajo);
				$mod->__SET('apellidoynombre', $r->apellidoynombre);
			    $mod->__SET('dni', $r->dni);
			    $mod->__SET('domicilio', $r->domicilio);
			    $mod->__SET('lugarinsc', $r->lugarinsc);							
				$mod->__SET('fechanacim', $r->fechanacim);
				$mod->__SET('promediot', $r->promediot);
				$mod->__SET('telefonos', $r->telefonos);
				$mod->__SET('titulobas', $r->titulobas);
				$mod->__SET('fechatit', $r->fechatit);
				$mod->__SET('otorgadopor', $r->otorgadopor);
                $mod->__SET('finicio', $r->finicio);
                $mod->__SET('otrostit', $r->otrostit);
                $mod->__SET('fingreso', $r->fingreso);
                $mod->__SET('cargosdocentes', $r->cargosdocentes);
                $mod->__SET('faperturaleg', $r->faperturaleg);
                $mod->__SET('nacionalidad', $r->nacionalidad);
                $mod->__SET('obsdoc', $r->obsdoc);
              

				$result[] = $mod;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

public function Listar_docentes($offset = 0, $limit = 100)
{
    try
    {
        $result = array();

        // Consulta SQL modificada con los parámetros de límite y desplazamiento
        $sql = "SELECT * FROM _junta_docentes ORDER BY legajo ASC LIMIT :limit OFFSET :offset";
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stm->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stm->execute();

        foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
        {
            $mod = new Docente();
            $mod->__SET('id2', $r->id2);
				$mod->__SET('legajo', $r->legajo);
				$mod->__SET('apellidoynombre', $r->apellidoynombre);
			    $mod->__SET('dni', $r->dni);
			    $mod->__SET('domicilio', $r->domicilio);
			    $mod->__SET('lugarinsc', $r->lugarinsc);							
				$mod->__SET('fechanacim', $r->fechanacim);
				$mod->__SET('promediot', $r->promediot);
				$mod->__SET('telefonos', $r->telefonos);
				$mod->__SET('titulobas', $r->titulobas);
				$mod->__SET('fechatit', $r->fechatit);
				$mod->__SET('otorgadopor', $r->otorgadopor);
                $mod->__SET('finicio', $r->finicio);
                $mod->__SET('otrostit', $r->otrostit);
                $mod->__SET('fingreso', $r->fingreso);
                $mod->__SET('cargosdocentes', $r->cargosdocentes);
                $mod->__SET('faperturaleg', $r->faperturaleg);
                $mod->__SET('nacionalidad', $r->nacionalidad);
                $mod->__SET('obsdoc', $r->obsdoc);
            $result[] = $mod;
        }

        return $result;
    }
    catch(Exception $e)
    {
        die($e->getMessage());
    }
}



	public function ObtenerDocente($id2)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM _junta_docentes WHERE id2 = ?");
			          

			$stm->execute(array($id2));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$mod = new Docente();

			    $mod->__SET('id2', $r->id2);
				$mod->__SET('legajo', $r->legajo);
				$mod->__SET('apellidoynombre', $r->apellidoynombre);
			    $mod->__SET('dni', $r->dni);
			    $mod->__SET('domicilio', $r->domicilio);	
			    $mod->__SET('lugarinsc', $r->lugarinsc);						
				$mod->__SET('fechanacim', $r->fechanacim);
				$mod->__SET('promediot', $r->promediot);
				$mod->__SET('telefonos', $r->telefonos);
				$mod->__SET('titulobas', $r->titulobas);
				$mod->__SET('fechatit', $r->fechatit);
				$mod->__SET('otorgadopor', $r->otorgadopor);
                $mod->__SET('finicio', $r->finicio);
                $mod->__SET('otrostit', $r->otrostit);
                $mod->__SET('fingreso', $r->fingreso);
                $mod->__SET('cargosdocentes', $r->cargosdocentes);
                $mod->__SET('faperturaleg', $r->faperturaleg);
                $mod->__SET('nacionalidad', $r->nacionalidad);
                $mod->__SET('obsdoc', $r->obsdoc);

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
			          ->prepare("SELECT * FROM _junta_docentes WHERE id2 = ?");
			          

			$stm->execute(array($id2));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$mod = new Docente();

			    $mod->__SET('id2', $r->id2);
				$mod->__SET('legajo', $r->legajo);
				$mod->__SET('apellidoynombre', $r->apellidoynombre);
			    $mod->__SET('dni', $r->dni);
			    $mod->__SET('domicilio', $r->domicilio);	
			    $mod->__SET('lugarinsc', $r->lugarinsc);						
				$mod->__SET('fechanacim', $r->fechanacim);
				$mod->__SET('promediot', $r->promediot);
				$mod->__SET('telefonos', $r->telefonos);
				$mod->__SET('titulobas', $r->titulobas);
				$mod->__SET('fechatit', $r->fechatit);
				$mod->__SET('otorgadopor', $r->otorgadopor);
                $mod->__SET('finicio', $r->finicio);
                $mod->__SET('otrostit', $r->otrostit);
                $mod->__SET('fingreso', $r->fingreso);
                $mod->__SET('cargosdocentes', $r->cargosdocentes);
                $mod->__SET('faperturaleg', $r->faperturaleg);
                $mod->__SET('nacionalidad', $r->nacionalidad);
                $mod->__SET('obsdoc', $r->obsdoc);

			return $mod;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarDocente($id2)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM _junta_docentes WHERE id2 = ?");			          

			$stm->execute(array($id2));
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





	public function ActualizarDocente(Docente $data)
	{
		try 
		{
			$sql = "UPDATE _junta_docentes SET 
						legajo         = ?, 
						apellidoynombre        = ?,
						dni           = ?, 
						domicilio =             ?,
						lugarinsc = ?,
						fechanacim           = ?, 
						promediot           = ?,
						telefonos = ?,
						titulobas = ?,
						fechatit = ?,
						otorgadopor = ?,
						finicio = ?,
						otrostit = ?,
						fingreso = ?,
						cargosdocentes = ?,
					    faperturaleg = ?,
						nacionalidad = ?,
						obsdoc = ?

					
						
				    WHERE id2 = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('legajo'), 
					$data->__GET('apellidoynombre'), 
					$data->__GET('dni'),
					$data->__GET('domicilio'),
					$data->__GET('lugarinsc'),
					$data->__GET('fechanacim'),
                    $data->__GET('promediot'),
                    $data->__GET('telefonos'),
                    $data->__GET('titulobas'),
                    $data->__GET('fechatit'),
                    $data->__GET('otorgadopor'),
                    $data->__GET('finicio'),
                    $data->__GET('otrostit'),
                    $data->__GET('fingreso'),
                    $data->__GET('cargosdocentes'),
                    $data->__GET('faperturaleg'),
                    $data->__GET('nacionalidad'),
                    $data->__GET('obsdoc'),
					$data->__GET('id2')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
 
	public function RegistrarDocente(Docente $data)
	{
		try 
		{
		$sql = "INSERT INTO _junta_docentes (legajo,apellidoynombre,dni,domicilio,lugarinsc,fechanacim,promediot,telefonos, titulobas,fechatit , otorgadopor, finicio,otrostit,fingreso,cargosdocentes,faperturaleg,nacionalidad,obsdoc) 
		        VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('legajo'), 
					$data->__GET('apellidoynombre'), 
					$data->__GET('dni'),
					$data->__GET('domicilio'),
					$data->__GET('lugarinsc'),
					$data->__GET('fechanacim'),
                    $data->__GET('promediot'),
                    $data->__GET('telefonos'),
                    $data->__GET('titulobas'),
                    $data->__GET('fechatit'),
                    $data->__GET('otorgadopor'),
                    $data->__GET('finicio'),
                    $data->__GET('otrostit'),
                    $data->__GET('fingreso'),
                    $data->__GET('cargosdocentes'),
                    $data->__GET('faperturaleg'),
                    $data->__GET('nacionalidad'),
                    $data->__GET('obsdoc'),
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
							$mod = new Docente();

							$mod->__SET('legajo', $r->legajo);
							$mod->__SET('legdoc', $r->legdoc);
							$mod->__SET('codmod', $r->codmod);
						    
			              

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

--- hasta aca ----------
*/
class DocentesModel
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try
        {
            // Conexión a SQL Server
            $serverName = "10.1.9.113"; // Servidor de SQL Server
            $database = "junta"; // Nombre de la base de datos
            $username = "SA"; // Usuario de la base de datos
            $password = 'Davinci2024#'; // Contraseña de la base de datos

            $dsn = "sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=True";
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Listar5()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM _junta_docentes ORDER BY legajo ASC");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $mod = new Docente();

                $mod->__SET('id2', $r->id2);
                $mod->__SET('legajo', $r->legajo);
                $mod->__SET('apellidoynombre', $r->apellidoynombre);
                $mod->__SET('dni', $r->dni);
                $mod->__SET('domicilio', $r->domicilio);
                $mod->__SET('lugarinsc', $r->lugarinsc);
                $mod->__SET('fechanacim', $r->fechanacim);
                $mod->__SET('promedioT', $r->promedioT);
                $mod->__SET('telefonos', $r->telefonos);
                $mod->__SET('Titulobas', $r->Titulobas);
                $mod->__SET('fechatit', $r->fechatit);
                $mod->__SET('otorgadopor', $r->otorgadopor);
                $mod->__SET('finicio', $r->finicio);
                $mod->__SET('otrostit', $r->otrostit);
                $mod->__SET('fingreso', $r->fingreso);
                $mod->__SET('cargosdocentes', $r->cargosdocentes);
                $mod->__SET('faperturaleg', $r->faperturaleg);
                $mod->__SET('Nacionalidad', $r->Nacionalidad);
                $mod->__SET('obsdoc', $r->obsdoc);

                $result[] = $mod;
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Listar_docentes($offset = 0, $limit = 10000)
{
    try {
        $result = array();

        // Consulta SQL con ROW_NUMBER para paginación
        $sql = "
        SELECT * FROM (
            SELECT 
                ROW_NUMBER() OVER (ORDER BY legajo) AS rownum, 
                id2, legajo, ApellidoyNombre AS apellidoynombre, CAST(dni AS INT) as dni, Domicilio as domicilio, lugarinsc, 
                CONVERT(VARCHAR, fechanacim, 103) AS fechanacim, promedioT, telefonos  as telefonos, Titulobas, 
                CONVERT(VARCHAR, fechatit, 103) AS fechatit, otorgadopor, 
                CONVERT(VARCHAR, finicio, 103) AS finicio, otrostit, 
                CONVERT(VARCHAR, fingreso, 103) AS fingreso, cargosdocentes, 
                CONVERT(VARCHAR, faperturaleg, 103) AS faperturaleg, Nacionalidad, obsdoc 
            FROM _junta_docentes
        ) AS sub
        WHERE sub.rownum BETWEEN :start AND :end
        ORDER BY sub.rownum;";
        
        $start = $offset + 1;
        $end = $offset + $limit;

        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':start', $start, PDO::PARAM_INT);
        $stm->bindParam(':end', $end, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
            $mod = new Docente();
            $mod->__SET('id2', $r->id2);
            $mod->__SET('legajo', $r->legajo);
            $mod->__SET('apellidoynombre', $r->apellidoynombre);
            $mod->__SET('domicilio', $r->domicilio);
            $mod->__SET('dni', $r->dni);
            $mod->__SET('lugarinsc', $r->lugarinsc);
            $mod->__SET('fechanacim', $r->fechanacim);
            $mod->__SET('promedioT', $r->promedioT);
            $mod->__SET('telefonos', $r->telefonos);
            $mod->__SET('Titulobas', $r->Titulobas);
            $mod->__SET('fechatit', $r->fechatit);
            $mod->__SET('otorgadopor', $r->otorgadopor);
            $mod->__SET('finicio', $r->finicio);
            $mod->__SET('otrostit', $r->otrostit);
            $mod->__SET('fingreso', $r->fingreso);
            $mod->__SET('cargosdocentes', $r->cargosdocentes);
            $mod->__SET('faperturaleg', $r->faperturaleg);
            $mod->__SET('Nacionalidad', $r->Nacionalidad);
            $mod->__SET('obsdoc', $r->obsdoc);

            $result[] = $mod;
        }

        return $result;
    } catch (PDOException $e) {
        error_log('Error en Listar_docentes: ' . $e->getMessage());
        return array('error' => 'Error en buscar docentes: ' . $e->getMessage());
    }
}
    public function ObtenerDocente($id2)
    {
        try
        {
            $stm = $this->pdo->prepare("SELECT id2,legajo, ApellidoyNombre AS apellidoynombre,Domicilio as domicilio,CAST(dni as INT) as dni,lugarinsc,fechanacim,promedioT,telefonos,Titulobas,fechatit,otorgadopor,finicio,otrostit,fingreso,cargosdocentes,faperturaleg,Nacionalidad,obsdoc FROM _junta_docentes WHERE id2 = ?");
            $stm->execute(array($id2));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $mod = new Docente();

            $mod->__SET('id2', $r->id2);
            $mod->__SET('legajo', $r->legajo);
            $mod->__SET('apellidoynombre', isset($r->apellidoynombre) ? $r->apellidoynombre : '');
            $mod->__SET('domicilio', isset($r->domicilio) ? $r->domicilio : '');
            $mod->__SET('dni', $r->dni);
            $mod->__SET('lugarinsc', $r->lugarinsc);
            $mod->__SET('fechanacim', $r->fechanacim);
            $mod->__SET('promedioT', $r->promedioT);
            $mod->__SET('telefonos', $r->telefonos);
            $mod->__SET('Titulobas', $r->Titulobas);
            $mod->__SET('fechatit', $r->fechatit);
            $mod->__SET('otorgadopor', $r->otorgadopor);
            $mod->__SET('finicio', $r->finicio);
            $mod->__SET('otrostit', $r->otrostit);
            $mod->__SET('fingreso', $r->fingreso);
            $mod->__SET('cargosdocentes', $r->cargosdocentes);
            $mod->__SET('faperturaleg', $r->faperturaleg);
            $mod->__SET('Nacionalidad', $r->Nacionalidad);
            $mod->__SET('obsdoc', $r->obsdoc);

            return $mod;
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ObtenerLegajo($legajo)
    {
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM _junta_docentes WHERE legajo = ?");
            $stm->execute(array($legajo));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $mod = new Docente();

            $mod->__SET('id2', $r->id2);
            $mod->__SET('legajo', $r->legajo);
            $mod->__SET('apellidoynombre', $r->apellidoynombre);
            $mod->__SET('dni', $r->dni);
            $mod->__SET('domicilio', $r->domicilio);
            $mod->__SET('lugarinsc', $r->lugarinsc);
            $mod->__SET('fechanacim', $r->fechanacim);
            $mod->__SET('promedioT', $r->promedioT);
            $mod->__SET('telefonos', $r->telefonos);
            $mod->__SET('Titulobas', $r->Titulobas);
            $mod->__SET('fechatit', $r->fechatit);
            $mod->__SET('otorgadopor', $r->otorgadopor);
            $mod->__SET('finicio', $r->finicio);
            $mod->__SET('otrostit', $r->otrostit);
            $mod->__SET('fingreso', $r->fingreso);
            $mod->__SET('cargosdocentes', $r->cargosdocentes);
            $mod->__SET('faperturaleg', $r->faperturaleg);
            $mod->__SET('Nacionalidad', $r->Nacionalidad);
            $mod->__SET('obsdoc', $r->obsdoc);

            return $mod;
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function EliminarDocente($id2)
    {
        try
        {
            $stm = $this->pdo->prepare("DELETE FROM _junta_docentes WHERE id2 = ?");
            $stm->execute(array($id2));
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function EliminarMovimiento($id2)
    {
        try
        {
            $stm = $this->pdo->prepare("DELETE FROM _junta_movimientos WHERE id2 = ?");
            $stm->execute(array($id2));
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    
    public function ActualizarDocente(Docente $data)
    {
        try {
            // Convertir las fechas al formato adecuado para SQL Server
            $fechanacim_sql = $data->__GET('fechanacim') ? date('Y-m-d', strtotime($data->__GET('fechanacim'))) : null;
            $fechatit_sql = $data->__GET('fechatit') ? date('Y-m-d', strtotime($data->__GET('fechatit'))) : null;
            $finicio_sql = $data->__GET('finicio') ? date('Y-m-d', strtotime($data->__GET('finicio'))) : null;
            $fingreso_sql = $data->__GET('fingreso') ? date('Y-m-d', strtotime($data->__GET('fingreso'))) : null;
            $faperturaleg_sql = $data->__GET('faperturaleg') ? date('Y-m-d', strtotime($data->__GET('faperturaleg'))) : null;
    
            // Preparar la consulta SQL
            $sql = "UPDATE _junta_docentes SET 
                        legajo = ?, 
                        apellidoynombre = ?, 
                        dni = ?, 
                        domicilio = ?, 
                        lugarinsc = ?, 
                        fechanacim = ?,
                        promedioT = ?, 
                        telefonos = ?, 
                        Titulobas = ?, 
                        fechatit = ?, 
                        otorgadopor = ?, 
                        finicio = ?, 
                        otrostit = ?, 
                        fingreso = ?, 
                        cargosdocentes = ?, 
                        faperturaleg = ?, 
                        Nacionalidad = ?, 
                        obsdoc = ? 
                    WHERE id2 = ?";
    
            // Preparar y ejecutar la consulta
            $stmt = $this->pdo->prepare($sql);
    
            $stmt->execute([
                $data->__GET('legajo'),
                $data->__GET('apellidoynombre'),
                $data->__GET('dni'),
                $data->__GET('domicilio'),
                $data->__GET('lugarinsc'),
                $fechanacim_sql,
                $data->__GET('promedioT'),
                $data->__GET('telefonos'),
                $data->__GET('Titulobas'),
                $fechatit_sql,
                $data->__GET('otorgadopor'),
                $finicio_sql,
                $data->__GET('otrostit'),
                $fingreso_sql,
                $data->__GET('cargosdocentes'),
                $faperturaleg_sql,
                $data->__GET('Nacionalidad'),
                $data->__GET('obsdoc'),
                $data->__GET('id2')
            ]);
    
            // Verificar si se realizó la actualización correctamente
            if ($stmt->rowCount() > 0) {
                return true; // Actualización exitosa
            } else {
                return false; // No se actualizó ningún registro
            }
        } catch (PDOException $e) {
            // Manejo de errores de PDO
            echo "Error: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            // Manejo de errores genéricos
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    



    public function RegistrarDocente(Docente $data)
    {
        try {
            // Convertir las fechas al formato adecuado para SQL Server
            $fechanacim_sql = $data->__GET('fechanacim') ? date('Y-m-d H:i:s', strtotime($data->__GET('fechanacim'))) : null;
            $fechatit_sql = $data->__GET('fechatit') ? date('Y-m-d H:i:s', strtotime($data->__GET('fechatit'))) : null;
            $finicio_sql = $data->__GET('finicio') ? date('Y-m-d H:i:s', strtotime($data->__GET('finicio'))) : null;
            $fingreso_sql = $data->__GET('fingreso') ? date('Y-m-d H:i:s', strtotime($data->__GET('fingreso'))) : null;
            $faperturaleg_sql = $data->__GET('faperturaleg') ? date('Y-m-d H:i:s', strtotime($data->__GET('faperturaleg'))) : null;
    
            // Preparar la consulta SQL
            $sql = "INSERT INTO _junta_docentes (
                        legajo, apellidoynombre, dni, domicilio, lugarinsc, fechanacim, 
                        promedioT, telefonos, Titulobas, fechatit, otorgadopor, finicio, 
                        otrostit, fingreso, cargosdocentes, faperturaleg, Nacionalidad, obsdoc
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
            // Preparar y ejecutar la consulta
            $stmt = $this->pdo->prepare($sql);
    
            $stmt->execute([
                $data->__GET('legajo'),
                $data->__GET('apellidoynombre'),
                $data->__GET('dni'),
                $data->__GET('domicilio'),
                $data->__GET('lugarinsc'),
                $fechanacim_sql,
                $data->__GET('promedioT'),
                $data->__GET('telefonos'),
                $data->__GET('Titulobas'),
                $fechatit_sql,
                $data->__GET('otorgadopor'),
                $finicio_sql,
                $data->__GET('otrostit'),
                $fingreso_sql,
                $data->__GET('cargosdocentes'),
                $faperturaleg_sql,
                $data->__GET('Nacionalidad'),
                $data->__GET('obsdoc')
            ]);
    
            // Verificar si se realizó la inserción correctamente
            if ($stmt->rowCount() > 0) {
                return true; // Inserción exitosa
            } else {
                return false; // No se insertó ningún registro
            }
        } catch (Exception $e) {
            die($e->getMessage()); // Manejo básico de errores, considera mejorar esta parte
        }
    }

    



    public function ListarMovimientos()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM _junta_movimientos ORDER BY legajo ASC");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $mod = new Docente();

                $mod->__SET('legajo', $r->legajo);
                $mod->__SET('legdoc', $r->legdoc);
                $mod->__SET('codmod', $r->codmod);

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
