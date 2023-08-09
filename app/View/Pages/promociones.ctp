
<div class="content-sec inner-sec">
    <div class="row">  
        <div class="row">
            <div class="large-9 medium-9 small-12 columns">
                <nav class="top-bar" data-topbar role="navigation">
                    <ul class="title-area">
                        <li class="name"> </li>
                        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                    </ul>
                    <section class="top-bar-section">
                        <!-- Right Nav Section -->
                        <ul class="right">
                            <li>
                                <?= $this->Html->link('<i class="fa fa-user"></i> Mi cuenta',   ['controller' => 'Pages', 'action' => 'contacto'],['escape' => false]); ?>
                            </li>    
                            <li>
                                <?= $this->Html->link('<i class="fa fa-shopping-cart"></i> Carrito',   ['controller' => 'Pages', 'action' => 'carrito'],['escape' => false]); ?>
                            </li> 
                        </ul>
                    </section>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="separacion-vinos-nuestros">
                <h4>Nuestros vinos</h4>
            </div>
            <div class="separacion"></div>
        <? foreach ($productos as $key => $value) {
            if($value['VinaProducto']['vina_id']!=8){continue;}
            $img=(file_exists('../webroot/img/productos/'.$value['VinaProducto']['id'].'.'.$value['VinaProducto']['extension'])?'productos/'.$value['VinaProducto']['id'].'.'.$value['VinaProducto']['extension']:'productos/img-no-disponible-2.png');
            
         ?>
            <div class="large-4 medium-4 small-12 columns">
                <ul class="pricing-table">
                    <li class="title" style="height: 82px;"><?= $value['VinaProducto']['nombre'] ?></li>
                    <li class="lista-img"><?= $this->Html->image($img, ['class'=>'img-presentacion']); ?></li>
                    <li class="price">$ <?= number_format($value['VinaProducto']['precio'], 0,',', '.') ?></li>
                    <li class="extra-white">Año <?= $value['VinaProducto']['anhio'] ?></li>
                    <li class="extra-grey">Cepa: <?= $value['VinaCepa']['nombre'] ?></li>
                    <li class="extra-white">Variedad: <?= $value['VinaVariedad']['nombre'] ?></li>
                    <li class="extra-grey">Viña: <?= $value['VinaVina']['nombre'] ?></li>
                    <li class="description" style="height: 115px;"><?= substr($value['VinaProducto']['descripcion'], 0, 200) ?>...</li>
                    <li class="bullet-item">
                    <?= $this->Html->link('Ficha técnica', ['controller' => 'Pages', 'action' => 'fichas', 1],['escape' => false, 'class'=>'button round grey']); ?>
                    </li>
                    <li class="cta-button">
                        <? if($value['VinaProducto']['stock']==0){?>
                            <h4>Producto agotado</h4>
                       <? }else{?>
                        <button class="button radius" onclick="agregar(<?= $value['VinaProducto']['id'] ?>)">Comprar</button>
                        <div class="agregado<?= $value['VinaProducto']['id'] ?>" style="display: none">
                            <h4>Producto Agregado</h4>
                            <?= $this->Html->link('<i class="fa fa-shopping-cart"></i> ir al carrito',   ['controller' => 'Pages', 'action' => 'carrito'],['escape' => false]); ?>
                        </div>
                        <div class="error<?= $value['VinaProducto']['id'] ?>" style="display: none">
                            <h4>Error al agregar el producto</h4>
                            <p>Favor intentar de nuevo, si el error continúa, favor contactarse <?= $this->Html->link('acá',   ['controller' => 'Pages', 'action' => 'contacto'],['escape' => false]); ?></p>
                        </div>
                       <?} ?>  
                    </li>
                </ul>
            </div>
        <?} ?>     
        </div>
        <div class="separacion"></div>
        <div class="row">
            <div class="separacion-vinos-nuestros">
                <h4>Otros vinos</h4>
            </div>
            <div class="separacion"></div>
        <? foreach ($productos as $key => $value) {
            if($value['VinaProducto']['vina_id']==8){continue;}
            $img=(file_exists('../webroot/img/productos/'.$value['VinaProducto']['id'].'.'.$value['VinaProducto']['extension'])?'productos/'.$value['VinaProducto']['id'].'.'.$value['VinaProducto']['extension']:'productos/img-no-disponible-2.png');
            
         ?>
            <div class="large-4 medium-4 small-12 columns">
                <ul class="pricing-table">
                    <li class="title" style="height: 82px;"><?= $value['VinaProducto']['nombre'] ?></li>
                    <li class="lista-img"><?= $this->Html->image($img, ['class'=>'img-presentacion']); ?></li>
                    <li class="price">$ <?= number_format($value['VinaProducto']['precio'], 0,',', '.') ?></li>
                    <li class="extra-white">Año <?= $value['VinaProducto']['anhio'] ?></li>
                    <li class="extra-grey">Cepa: <?= $value['VinaCepa']['nombre'] ?></li>
                    <li class="extra-white">Variedad: <?= $value['VinaVariedad']['nombre'] ?></li>
                    <li class="extra-grey">Viña: <?= $value['VinaVina']['nombre'] ?></li>
                    <li class="description" style="height: 115px;"><?= substr($value['VinaProducto']['descripcion'], 0, 200) ?>...</li>
                    <li class="bullet-item">
                    <?= $this->Html->link('Ficha técnica', ['controller' => 'Pages', 'action' => 'fichas', 1],['escape' => false, 'class'=>'button round grey']); ?>
                    </li>
                    <li class="cta-button">
                        <? if($value['VinaProducto']['stock']==0){?>
                            <h4>Producto agotado</h4>
                       <? }else{?>
                        <button class="button radius" onclick="agregar(<?= $value['VinaProducto']['id'] ?>)">Comprar</button>
                        <div class="agregado<?= $value['VinaProducto']['id'] ?>" style="display: none">
                            <h4>Producto Agregado</h4>
                            <?= $this->Html->link('<i class="fa fa-shopping-cart"></i> ir al carrito',   ['controller' => 'Pages', 'action' => 'carrito'],['escape' => false]); ?>
                        </div>
                        <div class="error<?= $value['VinaProducto']['id'] ?>" style="display: none">
                            <h4>Error al agregar el producto</h4>
                            <p>Favor intentar de nuevo, si el error continúa, favor contactarse <?= $this->Html->link('acá',   ['controller' => 'Pages', 'action' => 'contacto'],['escape' => false]); ?></p>
                        </div>
                       <?} ?>  
                    </li>
                </ul>
            </div>
        <?} ?>     
        </div>
         
    
    </div>
</div>  
<script type="text/javascript">
    function agregar(id){         
        $.ajax({
            type: 'POST',
            url: 'agregaProducto',
            data            : {
                id           : id
            },
            success: function (result) {
                console.log(result);
                if(result==1){
                    $('.agregado'+id).show();
                }else{
                    $('.agregado'+id).show();
                }
            },
            error: function (result){
                console.log(result);
            }
        });    
    }
</script>