<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>EscolApp :: <?= $title ?></title>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
		<?= $this->Html->css(array('bootstrap.min', 'style.min', 'notify', 'font-awesome.min')) ?>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<?= $this->Html->script(array('notify', 'bootstrap.min')) ?>
	</head>
	<body>
		<?= $this->Session->flash() ?>
		<?= $this->fetch('content') ?>
		<div class="modal-load"></div>
		<div class='notifications top-right'></div>
		<script>
			$('#flashMessage').delay(4000).fadeOut();
			$("#modal").click(function(event){
		        event.preventDefault();
		        var target = $(this).attr("href");
		        $('.modal-load').load(target, function(){
		            $('#modal-escolapp').modal('show');
		    	});
		    });
			<?= $this->fetch('script') ?>
		</script>
	</body>
</html>