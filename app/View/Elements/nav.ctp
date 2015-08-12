<nav class="navbar navbar-red navbar-static-top">
  <div class="container">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <?php
          if($current_user['id']){
            echo '<li>'.$this->Html->link('Inicio', array('controller' => 'welcome', 'action' => 'index')).'</li>';
          }
          if(($current_user['role_id'] == '1') && ($current_user['type'] == 'A')){
            echo '<li class="dropdown">
                    <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Colegios <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li>'.$this->Html->link('Agregar Colegio', array('controller' => 'colleges', 'action' => 'add'), array('id' => 'modal')).'</li>
                      <li>'.$this->Html->link('Lista de Colegios', array('controller' => 'colleges', 'action' => 'ListCollege')).'</li>
                    </ul>
                  </li>';
          }
          if($current_user['id']){
            echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$current_user['username'].' <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Mis Datos</a></li>
                      <li class="divider"></li>
                      <li>'.$this->Html->link('Cerrar Sessión', array('controller' => 'users', 'action' => 'logout')).'</li>
                    </ul>
                  </li>';
          }
        ?>
         <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 1 <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                            <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="#">Action</a></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                                            <ul class="dropdown-menu dropdown-menu-left">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">One more separated link</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
      </ul>
    </div>
  </div>
</nav>