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
    <div class="container">        
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 10px;display: flex;align-items: center;text-align: center;        justify-content: center">
                <?= $this->Html->image('logo.png', ['class'=>'img-fluid']); ?>
            </div>
            <div class="col-md-6 col-md-offset-3" style="margin-top: 10px;display: flex;align-items: center;text-align: center;        justify-content: center">
                <div class="center-block">
                    <?= $this->Form->create('data', array('url' => array( 'controller' => 'Admines', 'action' => 'login'), 'class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
                        <table>
                            <tr>
                                <td><?= $this->Form->input('mail', array('class' => 'form-control', 'required', 'placeholder'=>'E-Mail', 'type'=>'email')); ?></td>
                            </tr>
                            <tr>
                                <td><?= $this->Form->input('pass', array('class' => 'form-control', 'required', 'placeholder'=>'Contraseña', 'type'=>'password')); ?></td>
                            </tr>
                            <tr>
                                <td><input class="button round" type="submit" value="Ingresar"></td>
                            </tr>
                        </table>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>     
</body>
</html>