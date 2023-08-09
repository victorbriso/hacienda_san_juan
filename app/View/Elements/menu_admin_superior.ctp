<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <?= $this->Html->link($this->Html->image('logo.png', ['style'=>'max-height:50px; margin:0 auto;']),   ['action' => 'index'],['escape' => false]); ?>
    </div>
    <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> 
        <?= $this->Html->link('<span class="fas fa-ding-out-alt"></span> Salir', array('action' => 'logout'), array('escape' => false, 'class'=>'btn btn-danger square-btn-adjust'));?>
    </div>
</nav>  