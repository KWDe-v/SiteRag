<?php if(isset($naoEncontrado)): ?>
 <div class="db-container">
   <h1>Monstro Não Encontrado</h1>
   <p>Nenhum Resultado Encontrado. <a href="?to=monstros&page=1">Voltar para a lista de Monstros</a></p>
</div>
 <?php else: ?>
<main id="monsters-main">
   <section>
      <div class="db-container" style="padding: 0;">
         <?php if (!empty($mvp_drops)):?>
         <img src="img/mvp.png" class="icon" width="75px">
         <?php endif?>
         <div id="itemDescription">
            <div class="col-xs-10">
               <h1 style="margin-bottom: 0px;"> <?php echo $nomeMonstro;?></h1>
               <div id="hidden">
                  <img id="monster" alt="" src="<?php echo monsterImage($idmonstro)?>">
               </div>
            </div>
            <div class="table-info" style="background: none;">
               <div id="flex-2">
                  <div class="information" style="margin: auto;">
                     <div class="title-out"><span>Informações</span></div>
                     <ul class="list" id="informacoes-list">
                        <li>Nível</li>
                        <li><?php echo $lvl;?></li>
                        <li>Raça</li>
                        <li><?php echo $racas[$race];?></li>
                        <li>Propriedade</li>
                        <li><?php echo $elementos[$element];?> <?php echo $element_lvl;?></li>
                        <li>Tamanho</li>
                        <li><?php echo $tamanhos[$size];?></li>
                        <li>Exp Base</li>
                        <li><?php echo $expBase;?></li>
                        <li>Exp Classe</li>
                        <li><?php echo $expJob;?></li>
                     </ul>
                  </div>
                  <div class="information"style="margin: auto;">
                     <div class="title-out"><span>Atributos</span></div>
                     <ul class="list" id="informacoes-list">
                        <li>FOR</li>
                        <li><?php echo $str;?></li>
                        <li>AGI</li>
                        <li><?php echo $agi;?></li>
                        <li>VIT</li>
                        <li><?php echo $vit?></li>
                        <li>INT</li>
                        <li><?php echo $int;?></li>
                        <li>DES</li>
                        <li><?php echo $dex;?></li>
                        <li>SOR</li>
                        <li><?php echo $luk;?></li>
                     </ul>
                  </div>
               </div>
                <div id="flex-2">
                  <div class="information" style="margin: auto; margin-top: 20px;">
                     <div class="title-out"><span>Outros</span></div>
                     <ul class="list" id="informacoes-list">
                        <li>HP</li>
                        <li><?php echo $hp;?></li>
                        <li>Defesa</li>
                        <li><?php echo $def;?></li>
                        <li>Ataque</li>
                        <li><?php echo $atkMin;?> - <?php echo $atkMax;?></li>
                        <li>DEFM</li>
                        <li><?php echo $defM;?></li>
                        <li>Alcance</li>
                        <li><?php echo $range;?></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section id="slider">
      <ul class="multiple-items col-xs-10">
         <li class="drops-itens active">Drops (<?php echo count($mvp_drops) + count($normal_drops); ?>)</li>

          
         <li class="summon">Nasce Em (<?php if (!empty($mapas)): echo count($mapas); else: echo '0'; endif; ?>)</li>

      </ul>
   </section>
   <section id="slider-result" class="slider-result-show">
      <?php if ($normal_drops || $mvp_drops): ?>
      <ul>
         <?php if (!empty($mvp_drops)): ?>
         <?php foreach ($mvp_drops as $dropsMVP): ?>
         <?php foreach ($dropsMVP['items'] as $key => $nomeItemMVP): ?>
         <li class="monstros show">
            <a href="?to=veritem&id=<?php echo $nomeItemMVP['id']; ?>">
               <div class="white-bg"><img id="monster" alt="<?php echo $nomeItemMVP['name_english']; ?>" src="<?php echo itemImage($nomeItemMVP['id']); ?>" /></div>
               <label style="display: flex; align-items: center;">
               <img src="img/icones/monstros-icon.png" alt="Monstros Icon" style="margin-right: 5px;">
               Monstros
               <img src="img/mvp.png" alt="MVP Icon" width="35px" style="margin-left: 5px;">
               </label>
               <h5><?php echo $nomeItemMVP['name_english']; ?></h5>
               <label>Taxa de Drop: <?php echo min(100, $dropsMVP['rate'] / 100 * ($config['DropMVP'] / 100)); ?>%</label> 
            </a>
         </li>
         <?php endforeach; ?>
         <?php endforeach; ?>
         <?php endif; ?>
         <?php if (!empty($normal_drops)): ?>
         <?php foreach ($normal_drops as $dropsNormal): ?>
         <?php foreach ($dropsNormal['items'] as $key => $nomeItemNormal): ?>
         <li class="monstros show">
            <a href="?to=veritem&id=<?php echo $nomeItemNormal['id']; ?>">
               <div class="white-bg"><img id="monster" alt="<?php echo $nomeItemNormal['name_english']; ?>" src="<?php echo itemImage($nomeItemNormal['id']); ?>" /></div>
               <label><img src="img/icones/monstros-icon.png"> Monstros</label>
               <h5><?php echo $nomeItemNormal['name_english']; ?></h5>
               <label>Taxa de Drop: <?php echo min(100, $dropsNormal['rate'] / 100 * ($config['DropNormal'] / 100)); ?>%</label> 
            </a>
         </li>
         <?php endforeach; ?>
         <?php endforeach; ?>
         <?php endif; ?>
      </ul>
      <?php else: ?>
      <ul>
         <li class="monstros show">
            <a href="#">
               <div class="white-bg"><img id="monster" alt="nenhum monstro" src="img/noimage.png" /></div>
               <label><img src="img/icones/monstros-icon.png"> Monstros</label>
               <h5>Nenhum Drop</h5>
               <label>Taxa de Drop: 0%</label>
            </a>
         </li>
      </ul>
      <?php endif; ?>
      <ul>
        <?php if (!empty($mapas)): ?>
         <?php foreach ($mapas as $mapa): ?>
         <li class="itens">
            <a href="?to=vermapa&id=<?php echo $mapa['mapname']; ?>">
               <div class="white-bg"><img id="itens" alt="Caixa de Presente" src="<?php echo iconMapa($mapa['mapname'],1); ?>" /></div>
               <label><img src="img/icones/mapa.png" width="13px"> Mapas</label>
               <h5><?php echo $mapa['mapname']; ?></h5>
               <label>Quantidade: <?php echo $mapa['amount']; ?>un<br> Tempo: <?php echo converterTempo($mapa['respawnTime']); ?></label>
            </a>
         </li>
         <?php endforeach; ?>
         <?php else: ?>
         <li class="itens">
            <a href="#">
               <div class="white-bg"><img id="itens" alt="Caixa de Presente" src="img/noimage.png" /></div>
               <label><img src="img/icones/mapa.png" width="13px"> Mapas</label>
               <h5>Sem Respawn</h5>
               <label>Quantidade: 0un<br> Tempo: 0 segundos</label>
            </a>
         </li>
         <?php endif; ?>
      </ul>
   </section>
</main>
  <?php endif; ?>