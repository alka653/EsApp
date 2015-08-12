<div class="modal fade" id="modal-escolapp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	   	<div class="modal-content">
	   	 	<div class="modal-header">	
	   	 		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	   	 		 <h4 class="modal-title">Nuevo Colegio</h4>
			</div>
			<div class="modal-body">
				<?= $this->Form->create('College', array('action' => $action, 'type' => 'file', 'inputDefaults' => array('label' => false))) ?>
					<div class="form-group">
						<label>Nombre del Colegio</label>
						<?= $this->Form->input('name_college', array('type' => 'text', 'class' => 'form-control', 'required' => true)) ?>
					</div>
					<div class="form-group">
						<label>Nombre de la Base de Datos</label>
						<?= $this->Form->input('name_database', array('type' => 'text', 'class' => 'form-control', 'required' => true, 'maxlength' => 45, 'find' => 'find', 'type_input' => 'name_database')) ?>
					</div>
					<div class="form-group">
						<label>Prefijo</label>
						<?= $this->Form->input('prefix', array('type' => 'text', 'class' => 'form-control', 'required' => true, 'maxlength' => 5, 'find' => 'find', 'type_input' => 'prefix')) ?>
					</div>
					<div class="form-group">
						<label>Foto</label>
						<?= $this->Form->input('photo', array('type' => 'file')) ?>
						<?= $this->Form->input('photo_dir', array('type' => 'hidden')) ?>
					</div>
				<?= $this->Form->submit('Guardar Cambios', array('class' => 'btn btn-save button-college', 'id' => 'CollegeSaveForm', 'div' => false)) ?>
				<button type="button" class="btn button-danger" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>
    $('input[find="find"]').keyup(function(){
    	var value = this.value;
    	var type_input = $(this).attr('type_input');
    	$.ajax({
    		url: '<?= Router::url(array("controller" => "Colleges", "action" => "CollegeFindDB"), true) ?>',
    		data: {
    			text: value,
    			type: type_input
    		},
    		dataType: 'json',
    		success: function(data){
		  		if(data.button == '0'){
		  			$('.top-right').notify({
			    		message: { text: data.message },
			    		type: data.type,
			    		fadeOut: {enable: true, delay: 3000}
			  		}).show();
    				$('.btn-save').addClass('disabled');
    			}else{
    				$('.btn-save').removeClass('disabled');
    			}
    		},
    		error: function(data){
    			$('.top-right').notify({
		    		message: { text: data.message },
		    		type: data.type,
		    		fadeOut: {enable: true, delay: 3000}
		  		}).show();
    		}
    	});
	});
</script>