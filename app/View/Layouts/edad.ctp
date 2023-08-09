<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="https://kit.fontawesome.com/be0af648e9.js" crossorigin="anonymous"></script>
    <?php 
        echo $this->Html->charset('utf-8');
        echo $this->Html->css(array(
            'admin/bootstrap',
            'admin/font-awesome',
            'admin/custom',
            'admin/morris-0.4.3.min',
            'admin/style'
        ), array('fullBase' => true)); 
        echo $this->Html->script(array(
            'admin/jquery-1.10.2',
            'admin/bootstrap.min',
            'admin/jquery.metisMenu',
            'admin/morris/raphael-2.1.0.min',
            'admin/morris/morris',
            'admin/custom'

        ));
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Hacienda San Juan</title>
   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="container-fluid" style="height: 100%; width: 100%;">
        <div class="row">
            <div class="col-md-12 centrado">
                <div class="col-md-4 contenedor-logo">
                    <?= $this->Html->image('logo.png', ['class'=>'img-fluid']); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="separacion"></div>
            </div>
            <div class="col-md-12 centrado">
                <div class="col-md-4 radius" style="height: 40% !important;">
                    <?= $this->Html->image('galeria/27.jpeg', ['class'=>'img-tienda']); ?>
                </div>
            </div>            
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12"><h4 class="fondo-blanco text-center">Sitio para Mayores de edad</h4></div>
                        <div class="col-md-12"><p class="fondo-blanco">Este sitio contiene promoción y difusión de alcohol, por lo que para ingresar debes responder ¿eres mayor de edad?</p></div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 centrado">
                                    <?= $this->Html->link('Si',   ['controller' => 'Pages', 'action' => 'idioma', 'es'],['escape' => false, 'class'=>'btn btn-success']); ?>
                                </div>
                                <div class="col-md-6 centrado">
                                    <button class="btn btn-warning" onclick="menor();">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12"><h4 class="fondo-blanco text-center">site for adults</h4></div>
                        <div class="col-md-12"><p class="fondo-blanco">This site contains promotion and diffusion of alcohol, so to enter you must answer, are you of legal age?</p></div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 centrado">
                                    <?= $this->Html->link('Yes',   ['controller' => 'Pages', 'action' => 'idioma', 'en'],['escape' => false, 'class'=>'btn btn-success']); ?>
                                </div>
                                <div class="col-md-6 centrado">
                                    <button class="btn btn-warning" onclick="menor();">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<style type="text/css">
    html{
        height: 100%;
        width: 100%;     
    }
    body{
        height: 100%;
        width: 100%;
        background-color: black; 

    }
    .radius{
        border-right: 5px;        
    }
    .separacion{
        width: 100%;
        height: 10px !important;
        background-color: none;
    }
    .img-tienda{
        height: 300px;
        width: auto;
    }
    .centrado{
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center; 
    }
    .contenedor-logo{        
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.5);
    }
    .fondo-blanco{
        padding: 5px;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.5);
    }
</style>
<script type="text/javascript">
    function menor(){
        location.href='https://google.com';
    }
</script>