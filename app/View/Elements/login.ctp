<?= $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'login'), 'inputDefaults' => array('label' => false))) ?>
	<?= $this->Form->input('type', array('type' => 'hidden')) ?>
	<div class="form-group text-center">
		<h3><?= $title ?></h3>
		<?= $this->Html->image($dir_image, array('class' => 'img-circle img-login')) ?>
	</div>
	<?= $this->Form->input('username', array('div' => 'form-group text-center', 'label' => 'Usuario', 'class' => 'form-control','placeholder' => 'Ingrese su Usuario')) ?>
	<?= $this->Form->input('password', array('div' => 'form-group text-center', 'label' => 'Contraseña', 'class' => 'form-control','placeholder' => 'Ingrese su Contraseña')) ?>
	<div class="form-group">
		<?= $this->Form->submit('Ingresar', array('class' => 'btn button-college', 'div' => false, 'id' => 'User'.$form.'LoginForm')) ?>
		<?= $this->Html->link('Regresar', array('controller' => 'colleges', 'action' => 'ListCollege'), array('class' => 'btn button-danger')) ?>
	</div>
<script>
	$("#User<?= $form ?>LoginForm").submit(function(e){
    	var postData = $(this).serializeArray();
    	var formURL = $(this).attr("action");
    	$.ajax({
        	url : formURL,
        	type: 'POST',
        	data : postData,
    		dataType: 'json',
        	success: function(data){
        		if(data.type == 'login'){
        			location.reload();
        		}
            	$('.top-right').notify({
		    		message: data.message,
		    		type: data.type,
		    		fadeOut: {enable: true, delay: 3000}
		  		}).show();
        	},
        	error: function(data){
            	$('.top-right').notify({
		    		message: { text: 'Ha ocurrido un error' },
		    		type: 'danger',
		    		fadeOut: {enable: true, delay: 3000}
		  		}).show();
        	}
    	});
		e.preventDefault();
		return false;
	});
</script>