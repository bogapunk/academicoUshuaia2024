
<div class="table-responsive">
    
    <table class="table table-bordered table-condensed table-hover table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>MODALIDAD</th>
                <th>DESCRIPCION</th>
                <th>TITULO</th>
                <th>TOPE</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        
        <tbody>
            
            <?php
            
            require_once 'ModalidadCon.php';

            $query = "SELECT * FROM modalidades";
           
            $stmt = $conn->prepare2($query);
            $stmt->execute();
            
            if($stmt->rowCount() > 0) {
                
                while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                ?>
                <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $codmod; ?></td>
                <td><?php echo $nommod; ?></td>
                <td><?php echo $titulo; ?></td>
                <td><?php echo $tope; ?></td>
                <td> 
                <a class="btn btn-sm btn-danger" id="delete_product" data-id="<?php echo $pro_id; ?>" href="?action=eliminar&id=<?php echo $r->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
                </tr>
                <?php
                }   
                
            } else {
                
                ?>
                <tr>
                <td colspan="3">No hay modalidades en lista</td>
                </tr>
                <?php
                
            }
            ?>
             
        </tbody>
    </table>
    
</div>