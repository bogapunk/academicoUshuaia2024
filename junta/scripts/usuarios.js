init();

 function init(){
    getData();
   
 }

  function getData(){

   $('#list_usuarios').dataTable({

      pagelenght: 10,
      responsive: true,
      processing: true,
      ajax : "controller/usuarios.php?op=listar"



   });
  function ObtenerUsuariosPorId(id)  
   {
  
  parametros = {

  	"id" : id


  }
   $.ajax({
        data:parametros,
        url:'controller/usuarios.php?op=ObtenerUsuariosPorId',
        type:'POST',
        beforeSend:function(){},
        success:function(response){
        	console.log(response);
        }



   });


      }

  }