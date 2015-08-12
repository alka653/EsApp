<?php
	Router::connect('/', array('controller' => 'colleges', 'action' => 'ListCollege'));
	Router::connect('/inicio', array('controller' => 'welcome', 'action' => 'index'));
	Router::connect('/colegio/:name', array('controller' => 'colleges', 'action' => 'college_login'), array('pass' => array('name')));
	Router::connect('/colegio/:name/editar', array('controller' => 'colleges', 'action' => 'college_edit'), array('pass' => array('name')));
	Router::connect('/colegio/:name/cambiar-estado-:state-:college', array('controller' => 'colleges', 'action' => 'ChangeState'), array('pass' => array('college', 'state', 'name')));
	Router::connect('/colegio/:id/actualizar-datos', array('controller' => 'colleges', 'action' => 'edit'), array('pass' => array('id')));
	Router::connect('/ingresar', array('controller' => 'users', 'action' => 'user_login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	CakePlugin::routes();
	require CAKE . 'Config' . DS . 'routes.php';
?>