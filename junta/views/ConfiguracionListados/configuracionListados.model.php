<?php
/* conexion anterior
class configuracionListadosModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=junta;charset=utf8', 'root', '');// aca se configura para los acentos
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarConfiguracionListado()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM _junta_listadosgenerales order by listado asc");
			$stm->execute();
			


			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$mod = new ConfiguracionListados();

				$mod->__SET('id', $r->id);
				//$mod->__SET('id2', $r->id2);
				$mod->__SET('listado', $r->listado);
				$mod->__SET('modalidades', $r->modalidades);
				$mod->__SET('ciudad', $r->ciudad);
				

				$result[] = $mod;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerConfiguracionListados($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM _junta_listadosgenerales WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$mod = new ConfiguracionListados();

			$mod->__SET('id', $r->id);
			//$mod->__SET('id2', $r->id2);
			$mod->__SET('listado', $r->listado);
			$mod->__SET('modalidades', $r->modalidades);
			$mod->__SET('ciudad', $r->ciudad);
			

			return $mod;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarConfiguracionListado($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM _junta_listadosgenerales WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarConfiguracionListado(ConfiguracionListados $data)
	{
		try 
		{
			$sql = "UPDATE _junta_listadosgenerales SET 
						
						listado        = ?,
						modalidades           = ?, 
						ciudad = ?,
						
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					//$data->__GET('id2'), 
					$data->__GET('listado'), 
					$data->__GET('modalidades'),
					$data->__GET('ciudad'),
				
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarConfiguracionListado(ConfiguracionListados $data)
	{
		try 
		{
		$sql = "INSERT INTO _junta_listadosgenerales (listado,modalidades,ciudad,trial510,id) 
		        VALUES (?, ?, ?, ?, ?,?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				//$data->__GET('id2'), 
				$data->__GET('listado'), 
				$data->__GET('modalidades'),
				$data->__GET('ciudad'),
                
				$data->__GET('id')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}


*/
class ConfiguracionListadosModel
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try
        {
            // Configuración de conexión a SQL Server
            $dsn = "sqlsrv:Server=localhost;Database=junta";
            $user = 'SA'; // Cambia tu_usuario por el nombre de usuario de SQL Server
            $pass = '30153846'; // Cambia tu_contraseña por la contraseña de SQL Server
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	        
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ListarConfiguracionListado()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT id, Listado as listado, modalidades,ciudad FROM _junta_listadosgenerales ORDER BY listado ASC");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $mod = new ConfiguracionListados();

                $mod->__SET('id', $r->id);
                $mod->__SET('listado', $r->listado);
                $mod->__SET('modalidades', $r->modalidades);
                $mod->__SET('ciudad', $r->ciudad);

                $result[] = $mod;
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ObtenerConfiguracionListados($id)
    {
        try 
        {
            $stm = $this->pdo->prepare("SELECT id, Listado as listado, modalidades,ciudad FROM _junta_listadosgenerales WHERE id = ?");
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $mod = new ConfiguracionListados();

            $mod->__SET('id', $r->id);
            $mod->__SET('listado', $r->listado);
            $mod->__SET('modalidades', $r->modalidades);
            $mod->__SET('ciudad', $r->ciudad);

            return $mod;
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function EliminarConfiguracionListado($id)
    {
        try 
        {
            $stm = $this->pdo->prepare("DELETE FROM _junta_listadosgenerales WHERE id = ?");
            $stm->execute(array($id));
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function ActualizarConfiguracionListado(ConfiguracionListados $data)
    {
        try 
        {
            $sql = "UPDATE _junta_listadosgenerales SET 
                        listado = ?,
                        modalidades = ?,
                        ciudad = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)->execute(
                array(
                    $data->__GET('listado'), 
                    $data->__GET('modalidades'),
                    $data->__GET('ciudad'),
                    $data->__GET('id')
                )
            );
        } 
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function RegistrarConfiguracionListado(ConfiguracionListados $data)
    {
        try 
        {
            $sql = "INSERT INTO _junta_listadosgenerales (listado, modalidades, ciudad) 
                    VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)->execute(
                array(
                    $data->__GET('listado'), 
                    $data->__GET('modalidades'),
                    $data->__GET('ciudad')
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