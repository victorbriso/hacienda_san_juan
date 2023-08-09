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
    <div id="wrapper">
        <?= $this->element('menu_admin_superior'); ?> 
        <?= $this->element('menu_admin_lateral'); ?> 
        <div id="page-wrapper" >
            <?= $this->fetch('content'); ?>
        </div>
    </div>  
</body>
</html>