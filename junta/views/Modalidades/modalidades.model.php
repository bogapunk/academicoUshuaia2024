<?php
/* conexion a mysql 
class ModalidadesModel
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

	public function Listar2()
	{
		try
		{
			$result = array();
                // Establece la codificación de la conexión
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8"); // Establece la codificación a UTF-8
			$stm = $this->pdo->prepare("SELECT * FROM _junta_modalidades order by codmod asc");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$mod = new Modalidad();

				$mod->__SET('id', $r->id);
				$mod->__SET('codmod', $r->codmod);
				$mod->__SET('nommod', $r->nommod);
				$mod->__SET('titulo', $r->titulo);
				$mod->__SET('tope', $r->tope);

				$result[] = $mod;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM _junta_modalidades WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$mod = new Modalidad();

			$mod->__SET('id', $r->id);
			$mod->__SET('codmod', $r->codmod);
			$mod->__SET('nommod', $r->nommod);
			$mod->__SET('titulo', $r->titulo);
			$mod->__SET('tope', $r->tope);

			return $mod;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM _junta_modalidades WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Modalidad $data)
	{
		try 
		{
			$sql = "UPDATE _junta_modalidades SET 
						codmod          = ?, 
						nommod        = ?,
						titulo           = ?, 
						tope = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('codmod'), 
					$data->__GET('nommod'), 
					$data->__GET('titulo'),
					$data->__GET('tope'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Modalidad $data)
	{
		try 
		{
		$sql = "INSERT INTO _junta_modalidades (codmod,nommod,titulo,tope) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('codmod'), 
				$data->__GET('nommod'), 
				$data->__GET('titulo'),
				$data->__GET('tope')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
*/

class ModalidadesModel
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try
        {
            $this->pdo = new PDO('sqlsrv:Server=db;Database=junta;TrustServerCertificate=yes', 'SA', '"asd123"');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Listar2()
    {
        try
        {
            $result = array();
            // Establece la codificación de la conexión
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $stm = $this->pdo->prepare("SELECT * FROM _junta_modalidades ORDER BY codmod ASC");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $mod = new Modalidad();

                $mod->__SET('id', $r->id);
                $mod->__SET('codmod', $r->codmod);
                $mod->__SET('nommod', $r->nommod);
                $mod->__SET('titulo', $r->titulo);
                $mod->__SET('tope', $r->tope);

                $result[] = $mod;
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try 
        {
            $stm = $this->pdo->prepare("SELECT * FROM _junta_modalidades WHERE id = ?");
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $mod = new Modalidad();

            $mod->__SET('id', $r->id);
            $mod->__SET('codmod', $r->codmod);
            $mod->__SET('nommod', $r->nommod);
            $mod->__SET('titulo', $r->titulo);
            $mod->__SET('tope', $r->tope);

            return $mod;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try 
        {
            $stm = $this->pdo->prepare("DELETE FROM _junta_modalidades WHERE id = ?");
            $stm->execute(array($id));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Actualizar(Modalidad $data)
    {
        try 
        {
            $sql = "UPDATE _junta_modalidades SET 
                        codmod = ?, 
                        nommod = ?,
                        titulo = ?, 
                        tope = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)->execute(
                array(
                    $data->__GET('codmod'), 
                    $data->__GET('nommod'), 
                    $data->__GET('titulo'),
                    $data->__GET('tope'),
                    $data->__GET('id')
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Registrar(Modalidad $data)
    {
        try 
        {
            $sql = "INSERT INTO _junta_modalidades (codmod, nommod, titulo, tope) 
                    VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)->execute(
                array(
                    $data->__GET('codmod'), 
                    $data->__GET('nommod'), 
                    $data->__GET('titulo'),
                    $data->__GET('tope')
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}