<?php include 'menuHeader.php'; 
if(array_key_exists('id', $_GET)):
    $id= $_GET['id'];
    echo RentalModal("Excluir", "Tem certeza que deseja excluir a imagem", "Cancelar", "Excluir", "Excluir");
    var_dump($id);
endif;


//$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

?>
<link href="../dist/css/LocalStyle.css" rel="stylesheet" type="text/css"/>

<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Usuário cadastrado com Sucesso!</h4>
						</div>
						<div class="modal-body">
							<?php echo "OK" ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info" data-dismiss="modal">Corrigir Cadastro</button>
							<a href="index.php"><button type="button" class="btn btn-success">Ok</button></a>
						</div>
					</div>
				</div>
			</div>	-->


<!--

    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Default Modal</h4>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right-container" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>		-->



<?php

$id=1;
echo '<button type="button" class="btn btn-default pull-right-container" data-dismiss="modal" onClick="Excluir()">Close</button>';



include 'menuFooter.php'; ?>

<script>
    $(document).ready(function () {
            $('#myModal').modal('show');
    });
    
    function Excluir(){
        location.href="teste.php?id=<?php print $id;?>"
    };
    
    function Cancelar(){
        location.href="teste.php"
    };
</script>