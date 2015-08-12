<?= $this->element('nav') ?>
<div class="container">
	<div class="row text-center">
		<span class="glyphicon glyphicon-warning-sign error-icon"></span>
		<h1 class="error-title">Error 400</h1>
		<p class="error-text"><?= $message; ?></p>
		<p><?= __d('cake', 'Error'); ?></p>
		<p><?php printf(__d('cake', 'The requested address %s was not found on this server.'),"<strong>'{$url}'</strong>"); ?></p>
	</div>
</div>
<?= $this->element('footer') ?>