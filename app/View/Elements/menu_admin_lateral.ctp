<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <?= $this->Html->link('<span class="fa fa-dashboard fa-3x"></span> Dashboard', array('action' => 'index'), array('escape' => false), ['class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'index')) ? 'active-menu' : '']);?>
            </li>
            <li>
                <a  href="#"><i class="fa fa-desktop fa-3x"></i> Inicio</a>
                <ul class="nav nav-second-level <?= ($this->Html->menuActivo(array('action' => 'indexTxt')) ? 'collapse in' : ($this->Html->menuActivo(array('action' => 'indexSlider')) ? 'collapse in' : '')); ?>">
                    <li>
                        <?= $this->Html->link('<span class="fa fa-edit"></span> Texto', array('action' => 'indexTxt'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'indexTxt')) ? 'active-menu' : ''));?>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fa fa-file"></i> Slider', array('action' => 'indexSlider'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'indexSlider')) ? 'active-menu' : ''));?>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="#"><i class="fa fa-user fa-3x <?= ($this->Html->menuActivo(array('action' => 'nosotrosTXT')) ? 'active-menu' : ($this->Html->menuActivo(array('action' => 'nosotrosSlider')) ? 'active-menu' : '')); ?>"></i> Nosotros</a>
                <ul class="nav nav-second-level">
                    <li>
                        <?= $this->Html->link('<span class="fa fa-edit"></span> Texto', array('action' => 'nosotrosTXT'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'nosotrosTXT')) ? 'active-menu' : ''));?>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fa fa-file"></i> Slider', array('action' => 'nosotrosSlider'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'nosotrosSlider')) ? 'active-menu' : ''));?>
                    </li>
                </ul>
            </li> 
            <li>
                <a  href="#"></i><i class="fas fa-wine-bottle fa-3x"></i> Vinos</a>
                <ul class="nav nav-second-level <?= ($this->Html->menuActivo(array('action' => 'vinos')) ? 'collapse in' : ($this->Html->menuActivo(array('action' => 'vinosSlider')) ? 'collapse in' : ($this->Html->menuActivo(array('action' => 'vinosEdit')) ? 'collapse in' : ''))); ?>">
                    <li>
                        <?= $this->Html->link('<span class="fas fa-wine-bottle"></span> Vinos', array('action' => 'vinos'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'vinos')) ? 'active-menu' : ''));?>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fa fa-file"></i> Slider', array('action' => 'vinosSlider'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'vinosSlider')) ? 'active-menu' : ''));?>
                    </li>
                </ul>
            </li> 
            <li>
                <a  href="#"><i class="far fa-images fa-3x <?= ($this->Html->menuActivo(array('controller' => 'admines', 'action' => 'galeria')) ? 'active-menu' : ''); ?>"></i> Galeria</a>
                <ul class="nav nav-second-level">
                    <li>
                        <?= $this->Html->link('<span class="far fa-image"></span> Imagenes', array('action' => 'galeria'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'galeria')) ? 'active-menu' : ''));?>
                    </li>
                </ul>
            </li> 
            <li>
                <a  href="#"><i class="fa fa-shopping-cart fa-3x"></i> Tienda</a>
                <ul class="nav nav-second-level <?= ($this->Html->menuActivo(array('action' => 'categorias')) ? 'collapse in' : ($this->Html->menuActivo(array('action' => 'descontinuados')) ? 'collapse in' : $this->Html->menuActivo(array('action' => 'productos')) ? 'collapse in' : ($this->Html->menuActivo(array('action' => 'editar')) ? 'collapse in' : $this->Html->menuActivo(array('action' => 'add')) ? 'collapse in' : ($this->Html->menuActivo(array('action' => 'ventas')) ? 'collapse in' : ($this->Html->menuActivo(array('action' => 'registroVentas')) ? 'collapse in' : '' ))))); ?>">
                    <li>
                        <?= $this->Html->link('<span class="fa fa-edit"></span> Registrar ventas', array('action' => 'registroVentas'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'registroVentas')) ? 'active-menu' : ''));?>
                    </li>
                    <li>
                        <?= $this->Html->link('<span class="fa fa-edit"></span> Categorias', array('action' => 'categorias'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'categorias')) ? 'active-menu' : ''));?>
                    </li>
                    <li>
                        <?= $this->Html->link('<span class="fa fa-edit"></span> Vinos', array('action' => 'productos'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'productos')) ? 'active-menu' : ''));?>
                    </li>
                    <li>
                        <?= $this->Html->link('<span class="fa fa-edit"></span> Ventas', array('action' => 'ventas'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'ventas')) ? 'active-menu' : ''));?>
                    </li>
                    <li>
                        <?= $this->Html->link('<span class="fa fa-edit"></span> Descontinuados', array('action' => 'descontinuados'), array('escape' => false, 'class'=>$this->Html->menuActivo(array('controller' => 'admines', 'action' => 'descontinuados')) ? 'active-menu' : ''));?>
                    </li>
                </ul>
            </li> 
        </ul>    
    </div>
</nav>  