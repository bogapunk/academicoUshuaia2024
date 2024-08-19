<?php
/* conexion anerior en mysql 
class DependenciasModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=db;dbname=junta;charset=utf8', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar3()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM _junta_dependencias order by  nomdep asc");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$mod = new Dependencia();

				$mod->__SET('iddep', $r->iddep);
				$mod->__SET('coddep', $r->coddep);
				$mod->__SET('nomdep', $r->nomdep);
				$mod->__SET('domicilio', $r->domicilio);
				$mod->__SET('directo', $r->directo);
                $mod->__SET('interno', $r->interno);
                $mod->__SET('codloc', $r->codloc);
                $mod->__SET('trial503', $r->trial503);

				$result[] = $mod;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerDependencia($iddep)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM _junta_dependencias WHERE iddep = ?");
			          

			$stm->execute(array($iddep));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$mod = new Dependencia();

			$mod->__SET('iddep', $r->iddep);
			$mod->__SET('coddep', $r->coddep);
			$mod->__SET('nomdep', $r->nomdep);
			$mod->__SET('domicilio', $r->domicilio);
			$mod->__SET('directo', $r->directo);
			$mod->__SET('interno', $r->interno);
			$mod->__SET('codloc', $r->codloc);
			$mod->__SET('trial503', $r->trial503);

			return $mod;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarDependencia($iddep)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM _junta_dependencias WHERE iddep = ?");			          

			$stm->execute(array($iddep));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarDependencia(Dependencia $data)
	{
		try 
		{
			$sql = "UPDATE _junta_dependencias SET 
						coddep          = ?, 
						nomdep        = ?,
						domicilio           = ?, 
						codloc =             ?,
						directo           = ?, 
						interno           = ?,
						trial503 = ?
					
						
				    WHERE iddep = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('coddep'), 
					$data->__GET('nomdep'), 
					$data->__GET('domicilio'),
					$data->__GET('codloc'),
					$data->__GET('directo'),
                    $data->__GET('interno'),
                    $data->__GET('trial503'),

                 

					$data->__GET('iddep')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarDependencia(Dependencia $data)
	{
		try 
		{
		$sql = "INSERT INTO _junta_dependencias (coddep,nomdep,domicilio,codloc,directo,interno,trial503) 
		        VALUES (?, ?, ?, ?, ?, ?,?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('coddep'), 
				$data->__GET('nomdep'), 
				$data->__GET('domicilio'),
				$data->__GET('directo'),
				$data->__GET('interno'),
				$data->__GET('codloc'),
				$data->__GET('trial503')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

*/
class DependenciasModel
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try
		{
            $this->pdo = new PDO('sqlsrv:Server=10.1.9.113;Database=junta;TrustServerCertificate=yes', 'SA', 'Davinci2024#');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Listar3()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM _junta_dependencias ORDER BY nomdep ASC");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $mod = new Dependencia();
               
				$mod->__SET('codniv', $r->codniv);
                $mod->__SET('iddep', $r->iddep);
                $mod->__SET('coddep', $r->coddep);
                $mod->__SET('nomdep', $r->nomdep);
                $mod->__SET('domicilio', $r->domicilio);
                $mod->__SET('directo', $r->directo);
                $mod->__SET('interno', $r->interno);
                $mod->__SET('codloc', $r->codloc);
				
				
              

                $result[] = $mod;
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ObtenerDependencia($iddep)
    {
        try 
        {
            $stm = $this->pdo->prepare("SELECT * FROM _junta_dependencias WHERE iddep = ?");
            $stm->execute(array($iddep));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $mod = new Dependencia();

            $mod->__SET('iddep', $r->iddep);
			$mod->__SET('codniv', $r->codniv);
            $mod->__SET('coddep', $r->coddep);
            $mod->__SET('nomdep', $r->nomdep);
            $mod->__SET('domicilio', $r->domicilio);
            $mod->__SET('directo', $r->directo);
            $mod->__SET('interno', $r->interno);
            $mod->__SET('codloc', $r->codloc);
			

            return $mod;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function EliminarDependencia($iddep)
    {
        try 
        {
            $stm = $this->pdo->prepare("DELETE FROM _junta_dependencias WHERE iddep = ?");
            $stm->execute(array($iddep));
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function ActualizarDependencia(Dependencia $data)
    {
        try 
        {
            $sql = "UPDATE _junta_dependencias SET 
			            codniv = ?,
                        coddep = ?, 
                        nomdep = ?, 
                        domicilio = ?, 
                        codloc = ?, 
                        directo = ?, 
                        interno = ?
                    WHERE iddep = ?";

            $this->pdo->prepare($sql)->execute(
                array(
					$data->__GET('codniv'), 
                    $data->__GET('coddep'), 
                    $data->__GET('nomdep'), 
                    $data->__GET('domicilio'), 
                    $data->__GET('codloc'), 
                    $data->__GET('directo'), 
                    $data->__GET('interno'),  
                    $data->__GET('iddep')
                )
            );
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function RegistrarDependencia(Dependencia $data)
    {
        try 
        {
            $sql = "INSERT INTO _junta_dependencias (codniv,coddep, nomdep, domicilio,directo,interno, codloc,iddep,CUISE) 
                    VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";

            $this->pdo->prepare($sql)->execute(
                array(
					$data->__GET('codniv'),
                    $data->__GET('coddep'), 
                    $data->__GET('nomdep'), 
                    $data->__GET('domicilio'), 
					$data->__GET('directo'), 
					$data->__GET('interno'), 
                    $data->__GET('codloc'), 
					$data->__GET('iddep'), 
                    $data->__GET('CUISE')


                )
            );
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
?>