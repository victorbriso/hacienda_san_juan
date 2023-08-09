<h1>Pago Simultaneo</h1>

<?= $this->Html->link('Pagar con Pago Simultaneo', array('action' => 'compraPagoSimultaneo'), array('class' => 'btn btn-primary')); ?> |
<?= $this->Html->link('Anular Pago', array('action' => 'anularCompra'), array('class' => 'btn btn-primary')); ?>

<br><br><br>

<h1> Oneclick </h1>
<?= $this->Html->link('Inscribirse en Webpay Oneclick', array('action' => 'inscripcionOneclick'), array('class' => 'btn btn-primary')); ?> |
<?= $this->Html->link('Darse de baja', array('action' => 'bajaOneclick'), array('class' => 'btn btn-primary')); ?> |
<?= $this->Html->link('Realizar pago', array('action' => 'pagoOneclick'), array('class' => 'btn btn-primary')); ?> |
<?= $this->Html->link('Reversar pago', array('action' => 'reversarOneclick'), array('class' => 'btn btn-primary')); ?>
