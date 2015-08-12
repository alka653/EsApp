<?= $this->element('nav') ?>
<div class="container">
	<div class="row spacing">
		<h1><i class="fa fa-users"></i> <small>Seleccione una Institución Educativa</small></h1>
	</div>
	<div class="row spacing">
		<?php
			foreach($colleges AS $college){
		?>
			<div class="col-sm-6 col-md-4 spacing text-center">
				<?= $this->Html->image($dir.'/'.$college['College']['photo_dir'].'/'.$college['College']['photo'], array('alt' => $college['College']['name_college'], 'class' => 'image-college')) ?>
				<div class="edit">
					<p>edit</p>
				</div>
				<?php
          			if(($current_user['role_id'] == '1') && ($current_user['type'] == 'A')){
          				if($college['College']['state_id'] == '1'){
          					$className = 'button-college';
          				}else{
          					$className = 'button-danger';
          				}
          				echo $this->Html->link($college['College']['name_college'], array('controller' => 'colleges', 'action' => 'college_edit', 'name' => $college['College']['prefix']), array('class' => 'btn '.$className.' col-md-12'));
          			}else{
				?>
					<?= $this->Html->link($college['College']['name_college'], array('controller' => 'colleges', 'action' => 'college_login', 'name' => $college['College']['prefix']), array('class' => 'btn button-college col-md-12')) ?>
				<?php
					}
				?>
			</div>
		<?php
			}
		?>
	</div>
</div>
<?= $this->element('footer') ?>