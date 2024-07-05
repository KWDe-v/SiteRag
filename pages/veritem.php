<?php if(isset($naoEncontrado)): ?>
 <div class="db-container">
   <h1>Item Não Encontrado</h1>
   <p>Nenhum Resultado Encontrado. <a href="?to=itens&page=1">Voltar para a lista de Itens</a></p>
</div>
 <?php else: ?>
<main id="itens-main">
   <section>
      <div id="db-container">
      <div id="itemDescription">
         <article class="items-emphasis">
            <div class="item-img">
               <img alt="<?php echo$nomeitem;?>" src="<?php echo itemImage($iditem); ?>" style="max-width: 150px;"/>
            </div>
            <div>
               <img src="<?php echo iconImage($iditem); ?>" style="width: 25px;"/>
               <h1><?php echo$iditem;?> - <?php echo$nomeitem;?></h1>
               <pre><?php echo$textoFormatado;?></pre>
            </div>
         </article>
         <div class="table-info">
            <div>
               <div class="information">
                  <div class="title-out"><span>Informações</span></div>
                  <ul class="list">
                     <li>Preço</li>
                     <li><?php echo$preco;?></li>
                     <li>Peso</li>
                     <li><?php echo$peso;?></li>
                     <li>Tipo</li>
                     <li><?php echo $tipo;?></li>
                     <li>Ataque</li>
                     <li><?php echo$ataque;?></li>
                     <li>Defesa</li>
                     <li><?php echo$defesa;?></li>
                     <li>Slot's</li>
                     <li><?php echo$slots;?></li>
                  </ul>
               </div>
               <div id="more-information">
                  <div class="full-title">
                     <span class="orange-label">Pode ser...</span>
                  </div>
                  <ul class="flex-check">
                     <li><img src="<?php echo$dropar;?>" /></li>
                     <li>Jogado no chão</li>
                     <li><img src="<?php echo$refinavel;?>" /></li>
                     <li>Refinável</li>
                     <li><img src="<?php echo$negociar;?>" /></li>
                     <li>Negociado</li>
                     <li><img src="img/icones/POSITIVE.png" /></li>
                     <li>Vendido para NPC</li>
                     <li><img src="<?php echo$storage;?>" /></li>
                     <li>Colocado no armazém</li>
                     <li><img src="<?php echo$storageguild;?>" /></li>
                     <li>Colocado no armazém da guilda</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php $dropsquan = count($itemget); ?>
   <section id="slider">
      <ul class="multiple-items col-xs-10">
         <li class="drops-itens active">Dropado por (<?php echo $dropsquan; ?>)</li>
          
         <li class="summon">Obtido por (<?= !empty($itensDrop) ? count(array_filter($itensDrop, function($info) { return $info['internalType'] === ''; })) : '0'; ?>)</li>

      
      </ul>
   </section>
   <section id="slider-result" class="slider-result-show">
      <?php if ($dropsquan): ?>
      <ul>
         <?php foreach ($itemget as $key => $item): ?>
         <li class="monstros show">
            <a href="?&to=vermonstro&id=<?php echo $item['id']; ?>">
               <div class="white-bg"><img id="monster" alt="<?php echo $item['nome']; ?>" src="<?php echo monsterImageIndex($item['id']); ?>" style="max-width: 78px; max-height: 100px;"/></div>
               <label><img src="img/icones/monstros-icon.png"> Monstros</label>
               <h5><?php echo $item['nome']; ?></h5>
               <label>Taxa de Drop: <?php echo min(100, $item['Taxa de drop'] / 100 * ($config['DropNormal'] / 100)); ?>%</label>
            </a>
         </li>
         <?php endforeach; ?>
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
         <?php if ($itensDrop): ?>
         <?php foreach ($itensDrop as $info): ?>
         <?php if ($info['internalType'] === ''): ?>
         <li class="itens">
            <a href="?&to=veritem&id=<?php echo $info['sourceId']; ?>">
               <div class="white-bg"><img id="itens" alt="<?php echo $info['sourceName']; ?>" src="<?php echo itemImage($info['sourceId']); ?>" /></div>
               <label><img src="img/icones/itens-icon.png"> Itens</label>
               <h5><?php echo $info['sourceName']; ?></h5>
               <label>Taxa de Drop: <?php echo $info['chance'] / 100; ?>%</label>
            </a>
         </li>
         <?php endif; ?>
         <?php endforeach; ?>
         <?php else: ?>
         <li class="itens">
            <a href="#">
               <div class="white-bg"><img id="itens" alt="Caixa de Presente" src="img/noimage.png" /></div>
               <label><img src="img/icones/itens-icon.png" width="13px"> Itens</label>
               <h5>Sem Itens</h5>
               <label>Taxa de Drop: 0%</label>
            </a>
         </li>
         <?php endif; ?>
      </ul>
   </section>
</main>
  <?php endif; ?>