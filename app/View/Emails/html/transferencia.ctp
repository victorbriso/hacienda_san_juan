<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body style="Margin: 0;padding: 0;max-width: 600px;background-color: #ffffff;">
    <center style="width: 600px;table-layout: fixed;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%; background-color: #fff;">    
        <div style="font-family: Arial,Helvetica,sans-serif;max-width: 100%; background-color:#fff">
            <table border="0" style="Margin: 0 auto;text-align:center;width: 100%;border-spacing: 0;max-width: 100%;" align="center">
                <tr>
                    <td align="center">
                        <table width="100%">
                            <tr>
                                <td align="center" style="width: 600px; max-width: 100%; padding: 10px; text-align:center !important">
                                        <span style="color: #696158; font-size: 20px; text-align: center !important;"> Hola, recientemente realizaste el proceso de compra en la tienda online de la Viña Hacienda San Juan, a continuación se detalla el pedido y el monto total a pagar.</span>
                                        <br>
                                </td>
                            </tr>       
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Producto</th>
                                    <th style="text-align: center;">Precio</th>
                                    <th style="text-align: center;">Cant.</th>
                                    <th style="text-align: right;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <? if(!empty($carrito)){
                                    $iteral=0;
                                    foreach ($carrito as $key => $value) { $iteral++; ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $iteral ?></td>
                                            <td style="text-align: center;"><?= $value['VinaProducto']['nombre'] ?></td>
                                            <td style="text-align: center;">$<?= number_format($value['VinaProducto']['precio'], 0, ',', '.'); ?></td>
                                            <td align="center" style="text-align: center;"><?= $value['VinaProducto']['cantidad'] ?></td>
                                            <td style="text-align: right;">$<?= number_format($value['VinaProducto']['precio']*$value['VinaProducto']['cantidad'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?}?>
                                    <tr>
                                        <td colspan="3" style="text-align: right; font-weight: bold">SubTotal</td>
                                        <td colspan="2" style="text-align: right; font-weight: bold">$ <?= number_format($totalCarrito, 0, ',', '.') ?>.- </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: right; font-weight: bold">Despacho</td>
                                        <td colspan="2" style="text-align: right; font-weight: bold">$ <?= number_format($despacho, 0, ',', '.') ?>.- </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: right; font-weight: bold">Total</td>
                                        <td colspan="2" style="text-align: right; font-weight: bold">$ <?= number_format($monto, 0, ',', '.') ?>.- </td>
                                    </tr>
                                <?}?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="100%">
                            <tr>
                                <td align="center" style="width: 600px; max-width: 100%; padding: 10px;">
                                    <table width="100%">
                                        <tr>
                                            <td colspan="2" style="color: #696158; font-size: 20px; text-align: center !important;">Datos de transferencia</td>
                                        </tr>
                                        <tr>
                                            <td>Titular</td>
                                            <td style="text-align: center;">Viña San Juan de Llo-LLeo LTDA</td>
                                        </tr>
                                        <tr>
                                            <td>Banco</td>
                                            <td style="text-align: center;">Santander</td>
                                        </tr>
                                        <tr>
                                            <td>Tipo Cuenda</td>
                                            <td style="text-align: center;">Cuenta Corriente</td>
                                        </tr>
                                        <tr>
                                            <td>N° de cuenta</td>
                                            <td style="text-align: center;">70 70 72 25</td>
                                        </tr>
                                        <tr>
                                            <td>R.U.T.:</td>
                                            <td style="text-align: center;">76.650.401-9</td>
                                        </tr>
                                        <tr>
                                            <td>Mail de notificación</td>
                                            <td style="text-align: center;">contacto@haciendasanjuan.cl</td>
                                        </tr>
                                        <tr>
                                            <td>Asunto</td>
                                            <td style="text-align: center;">Compra On-Line N° <?=$resumenId?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>       
                        </table>
                    </td>
                </tr>
            </table>   
        </div>
    </center>
</body>
</html>