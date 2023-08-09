<div class="content-sec inner-sec">
  <div class="row">
    <div class="large-12 columns">
      <h2>Nuestros Vinos</h2>
      <p class="texto-justificado">A diferencia de otras viñas que han
adaptado o migrado su producción
a procedimientos orgánicos y/o
biodinámicos, la Viña Hacienda San Juan
se lo propone desde su nacimiento, siendo
pionera en este aspecto.
La agricultura biodinámica, concebida en
su origen por el filósofo austriaco Rudolf
Steiner –fundador de la antroposofía–,
no solo implica un desarrollo orgánico
de los cultivos, sino que también
considera a los terrenos de producción
como entes complejos donde entran en
relación los tipos de suelos, plantas y
animales, las labores humanas que se
aplican en el lugar, y el vínculo de ellos
con los movimientos de los astros; esa
interrelación de factores se combinan en
armonía, prescindiendo del uso de agentes
externos al terreno, como lo son, por
ejemplo, el uso de fertilizantes, pesticidas
y/o herbicidas, con el fin de mantener los
equilibrios propios del entorno natural.<br>
Por este principio de sustentabilidad,
todos los derivados vegetales producidos
por la viña, como el escobajo y el
sarmiento, son reintegrados en forma
de compost a la misma producción,
generando ciclos de retribución con
el ambiente natural para mantener su
equilibrio y sanidad. Asimismo, el
calendario de poda, cosecha, riego,
vendimia, como todo el proceso de
vinificación, se realizan atendiendo los
ritmos lunares, basándose en un
calendario preciso que identifica las
condiciones apropiadas para tales efectos.
Además, los vinos no se filtran, se realiza
una maceración fría, y sólo existen
levaduras indígenas que provienen del
mismo terreno (evitando el uso de
corrector enológico, por ejemplo). </p>
    </div>
    <div class="clearfix"></div> 
    <div class="large-12 columns">
      <div class="separacion-vinos-nuestros"> 
          <h4>Blancos</h4>
      </div>
      <div class="separacion"></div> 
      <div>
        <? foreach ($misProductos as $key => $value) {
          if($value['Vino']['variedad_id']!=5){continue;}
            if($lang=='es'){
              $descripcion=$value['Vino']['desc_es'];
            }elseif ($lang=='en') {
              $descripcion=$value['Vino']['desc_en'];
            }else{
              $descripcion=$value['Vino']['desc_es'];
            }
          ?>
            <div class="large-12 columns">
              <div class="large-6 columns cont-img-mis-vinos">
                <?= $this->Html->image('misVinos/'.$value['Vino']['path_img'], ['class'=>'img-mis-vinos']); ?>
              </div>
              <div class="large-6 columns">
                  <h4 style="color: #9D204A; text-align: right;"><?= $value['Vino']['nombre'] ?></h4>   
                  <p class="desc-mis-vinos"><?= $descripcion ?></p>
                  <div class="cont-bnt-centrado">
                    <?= $this->Html->link('Ver más', array('action' => 'ficha', $value['Vino']['id']), array('escape' => false, 'class'=>'button radius'));?>
                  </div>
              </div>
                                
              </div>

            </div>
        <?} ?>
      </div>
      <div class="separacion-vinos-nuestros">
          <h4>Tintos</h4>
      </div>
      <div class="separacion"></div> 
      <div>
        <? foreach ($misProductos as $key => $value) {
          if($value['Vino']['variedad_id']!=6){continue;}
          if($lang=='es'){
            $descripcion=$value['Vino']['desc_es'];
          }elseif ($lang=='en') {
            $descripcion=$value['Vino']['desc_en'];
          }else{
            $descripcion=$value['Vino']['desc_es'];
          }
            ?>
            <div class="large-12 columns">
              <h4 style="color: #9D204A; text-align: right;"><?= $value['Vino']['nombre'] ?></h4>              
              <div class="large-6 columns cont-img-mis-vinos">
                <?= $this->Html->image('misVinos/'.$value['Vino']['path_img'], ['class'=>'img-mis-vinos']); ?>
              </div>
              <div class="large-6 columns">                
                <p class="desc-mis-vinos"><?= $descripcion ?></p>
                <div class="cont-bnt-centrado">
                  <?= $this->Html->link('Ver más', array('action' => 'ficha', $value['Vino']['id']), array('escape' => false, 'class'=>'button radius'));?>
                </div> 
              </div>
              <div class="large-12 columns">
                <div class="separacion-vinos-nuestros"></div>
              </div>
            </div>
        <?} ?>      
      </div>
    </div>

  </div>
</div>  
<script type="text/javascript">
  $('.single-item').slick();
</script> 