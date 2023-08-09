<?= $this->Html->scriptBlock(sprintf("var pedidos                 = %s;", json_encode($detallePedidos))); ?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><i class="fa fa-cog"></i> Resumen de ventas</h4></div>
	<div class="panel-body">
		<div class="col-md-12">
			<table class="table">
				<tr>
					<td>#</td>
					<td>Cliente</td>
					<td>Productos</td>
					<td>Total</td>
					<td>Estado</td>
					<td>Entrega</td>
					<td>Fecha</td>
					<td>Acciones</td>
				</tr>
				<? foreach ($dataVentas as $key => $value) {?>
					<tr>
						<td><?=$key+1?></td>
						<td><?= $value['VinaUsuario']['nombre'] ?> <?= $value['VinaUsuario']['apellido'] ?></td>
						<td><?= count($value['VinaVentaDetalle']) ?></td>
						<td>$<?= number_format($value['VinaVentaResumen']['total'], 0, ',', '.') ?></td>
						<td><?=$estados[$value['VinaVentaResumen']['estado']]?></td>
						<td>
							<? if($value['VinaVentaResumen']['estado']==0){?>
								Pendiente de entrega
							<?}elseif ($value['VinaVentaResumen']['estado']==1) {?>
								Pendiente de entrega
							<?}elseif ($value['VinaVentaResumen']['estado']==2) {?>
								Pendiente de entrega
							<?} elseif ($value['VinaVentaResumen']['estado']==4) {?>
								Anulado
							<?}?>
						</td>
						<td><?= $value['VinaVentaResumen']['fecha'] ?></td>
						<td>
							<button type="button" class="btn btn-warning abreModalDetalle" data-toggle="modal" data-target="#addVino">Ver detalle</button>
							<? if($value['VinaVentaResumen']['estado']==0){?>
								<?= $this->Html->link('Pagado', ['action' => 'cambiaEstadosPedidos', $value['VinaVentaResumen']['id'], 2],['class'=>'btn btn-success']); ?>
								<?= $this->Html->link('Anular', ['action' => 'cambiaEstadosPedidos', $value['VinaVentaResumen']['id'], 4],['class'=>'btn btn-danger']); ?>
							<?}elseif ($value['VinaVentaResumen']['estado']==1) {?>
								<?= $this->Html->link('Entregado', ['action' => 'cambiaEstadosPedidos', $value['VinaVentaResumen']['id'], 3],['class'=>'btn btn-success']); ?>
							<?}elseif ($value['VinaVentaResumen']['estado']==2) {?>
								<?= $this->Html->link('Entregado', ['action' => 'cambiaEstadosPedidos', $value['VinaVentaResumen']['id'], 3],['class'=>'btn btn-success']); ?>
							<?}?>
						</td>
					</tr>
				<?}?>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="addVino" tabindex="-1" role="dialog" aria-labelledby="addVinoTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid" id="contenidoDetallePedido">
					<table class="table">
						<tr></tr>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    	$('.abreModalDetalle').on('click', function(){

    	});
        var nombreInsumo = '';
        var nombreUnSalida = '';
        var insumoId=0;
        var tipoMedida = 0;
        var unidadSalida = 0;
        var iteral=0;
        $('#receta').on('click', function(){
            if ($('#receta').prop('checked') ){
                $('#tablaReceta').show();
            }else{
                $('#tablaReceta').hide();
            }
        });
        $('#insumos').change(function(){
            $('#unidadesMedida').html('<option disabled selected>--Seleccione</option>');
            nombreInsumo       =   $('#insumos option:selected').text();
            tipoMedida        =   $('option:selected', this).attr('medida');
            insumoId=$('option:selected', this).val();
            if(tipoMedida==2||tipoMedida==3||tipoMedida==4||tipoMedida==5||tipoMedida==6){
                $.each(unidadesMedida, function( index, value ){
                    if(index==7||index==8||index==9||index==1){return;}
                    var option = '<option value="'+index+'">'+value+'</option>';
                    $('#unidadesMedida').append(option);
                });
                $('#unidadesMedida').prop('disabled', false);
            }
            if(tipoMedida==7||tipoMedida==8||tipoMedida==9){
                $.each(unidadesMedida, function( index, value ){
                    if(index==1||index==2||index==3||index==4||index==5||index==6){return;}
                    var option = '<option value="'+index+'">'+value+'</option>';
                    $('#unidadesMedida').append(option);
                });
                $('#unidadesMedida').prop('disabled', false);
            }
            if(tipoMedida==1){
                $('#unidadesMedida').html('<option disabled selected value="1">Unidad</option>');
                unidadSalida=1;
                nombreUnSalida='Unidad';
            }     
        });
        $('#unidadesMedida').change(function(){
            unidadSalida=$('option:selected', this).val();
            nombreUnSalida=$('#unidadesMedida option:selected').text();
        });
        $('#tablaReceta').on('click', '.agregarInsumo', function(){
            if(unidadSalida==0){
                alert('Debe seleccionar el insumo y la unidad de salida');
            }else{
                if($('#cantidad').val()==0||$('#cantidad').val()==''){
                    alert('Debe ingresar la cantidad');
                }else{
                    var tdInsumo = '<tr id=insumo'+iteral+'><td>'+nombreInsumo+'</td>'+
                                '<td>'+nombreUnSalida+'</td>'+
                                '<td>'+$('#cantidad').val()+'</td>'+
                                '<td><button type="button" class="btn btn-danger btn-block eliminar" reglon="'+iteral+'"><i class="fa fa-trash-o"></i></button></td>'+
                                '<input type="hidden" name="data[receta]['+iteral+'][insumoId]" value="'+insumoId+'">'+
                                '<input type="hidden" name="data[receta]['+iteral+'][unidadSalida]" value="'+unidadSalida+'">'+
                                '<input type="hidden" name="data[receta]['+iteral+'][cantidad]" value="'+$('#cantidad').val()+'">'+
                                '</tr>';
                    nombreInsumo = '';
                    nombreUnSalida = '';
                    insumoId=0;
                    tipoMedida = 0;
                    unidadSalida = 0;
                    $('#detalleReceta').append(tdInsumo);
                    $('#unidadesMedida').html('<option disabled selected>--Seleccione</option>');
                    $("#insumos").val('default');
                    $("#insumos").selectpicker("refresh");
                    $('#cantidad').val('default');
                    iteral++;    
                }                    
            }            
        });
        $('#tablaReceta').on('click', '.eliminar', function(){
            iteralBorrar=$(this).attr('reglon');
            $('#insumo'+iteralBorrar).remove();
        });
        $('.validaform').on('click', function(){
            idCategoria       =   $('#selectCategoria option:selected').val();
            idElaboracion       =   $('#selectElaboracion option:selected').val();
            if(idCategoria!=0&&idElaboracion!=0){
                document.formAdd.submit()
            }else{
                alert('Debe seleccionar categoría y lugar de elaboración');
            }
        });
    });
</script>