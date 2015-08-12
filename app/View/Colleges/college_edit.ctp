<?php 
	if($college['College']['state_id'] == '1'){ 
		$className = 'active'; 
		$className2 = 'inactive'; 
		$button = 'Inactivar';
		$state = '2';
	}else{ 
		$className = 'inactive'; 
		$className2 = 'active'; 
		$button = 'Activar';
		$state = '1';
	} 
	echo $this->element('nav');
?>
<div class="container">
	<div class="row">
		<div class="col-md-4 text-center">
			<div class="col-md-12 <?= $className ?>" style='padding:5px'>
				<?= 'Estado del Colegio: '.$college['State']['name_state'].' ' ?>
				<?= $this->Html->link($button, array('controller' => 'colleges', 'action' => 'ChangeState', 'state' => $state, 'college' => $college['College']['id'], 'name' => $college['College']['prefix']), array('class' => 'label '.$className2)) ?>
			</div>
			<div class="col-md-12 card">
				<?= $this->Html->image('college/photo/'.$college['College']['photo_dir'].'/'.$college['College']['photo'], array('class' => 'img-responsive image-college')) ?>
	  			<h3><?= $college['College']['name_college'] ?></h3>
	  			<p><?= $college['College']['prefix'] ?></p>
	  			<?= $this->Html->link('Actualizar Datos', array('controller' => 'colleges', 'action' => 'edit', 'id' => $college['College']['id']), array('class' => 'btn button-college', 'id' => 'update')) ?>
				<?= $this->Html->link('Regresar', array('controller' => 'colleges', 'action' => 'ListCollege'), array('class' => 'btn button-danger')) ?>
			</div>
		</div>
		<div class="col-md-8">
			<div class="col-md-12 card">
	  			<div class="row text-center">
	  				
	  			</div>
	  		</div>
		</div>
	</div>
</div>
<?= $this->element('footer') ?>
<?php $this->start('script') ?>
	$("#update").click(function(event){
		event.preventDefault();
		var target = $(this).attr("href");
		$('.modal-load').load(target, function(){
			$('#modal-escolapp').modal('show');
		});
	});
<?php $this->end() ?>