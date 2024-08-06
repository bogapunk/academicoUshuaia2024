   
<?php
class ModalidadesModel extends Mysql{
    public $id, $codmod, $nommod, $id2, $titulo, $tope,$comp,$creado,$modificado,;
    public function __construct()
    {
        parent::__construct();
    }
   public function eliminarModalidades(int $id)
    {
        $return = "";
        $this->id = $Id;
        $query = "UPDATE modalidades SET estado = 0 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }


    ?>