<?php if(isset($naoEncontrado)): ?>
 <div class="db-container">
   <h1>Mapa Não Encontrado</h1>
   <p>Nenhum Resultado Encontrado. <a href="?to=mapas&page=1">Voltar para a lista de Mapas</a></p>
</div>
 <?php else: ?>
<main id="monsters-main">
   <section>
      <div id="db-container">
         <?php if (!empty($mvp_drops)):?>
         <img src="img/mvp.png" class="icon" width="75px">
         <?php endif?>
         <div id="itemDescription">
            <div class="col-xs-10">
               <h1 style="margin-bottom: 0px;"> <?php echo $data['name'];?><br><?php echo $data['mapname'];?></h1>
        
               <div id="hidden">
                  <img id="monster" alt=" <?php echo $data['name'];?>" src="<?php echo iconMapa($idmapa,2)?>">
               </div>
            </div>
         </div>
      </div>
   </section>
   <section id="slider">
      <ul class="multiple-items col-xs-10">
         <li class="drops-itens active">Monstros (<?php echo count($mobs)?>)</li>
         <li class="summon">NPC's (<?php echo count($npcs); ?>)</li>
      </ul>
   </section>
   <section id="slider-result" class="slider-result-show">
      <?php if ($mobs): ?>
      <ul>
         <?php foreach ($mobs as $mob): ?>
         <?php 
            $monsterId = $mob['monsterId'];
            if ($config['Renewal'] == FALSE) {
                $sql = "(SELECT name_english FROM mob_db WHERE id = '$monsterId')
                        UNION
                        (SELECT name_english FROM mob_db2 WHERE id = '$monsterId')";
            }else{
                $sql = "(SELECT name_english FROM mob_db_re WHERE id = '$monsterId')
                        UNION
                        (SELECT name_english FROM mob_db2_re WHERE id = '$monsterId')";
            }
                $result = mysqli_query($conn, $sql);
            
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                       
                        $nomeMob = $row['name_english'];
                    }
                } else {
                    echo "Erro na consulta: " . mysqli_error($conn);
                }
            
            ?>
         <li class="monstros show">
            <a href="?to=vermonstro&id=<?php echo $mob['monsterId']; ?>">
               <div class="white-bg"><img id="monster" alt="<?php echo 'Em Espera'; ?>" src="<?php echo monsterImageIndex($mob['monsterId']); ?>" /></div>
               <label><img src="img/icones/monstros-icon.png"> Monstros</label>
               <h5><?php echo $nomeMob; ?></h5>
               <label>Quantidade: <?php echo $mob['amount']; ?>un<br> Tempo: <?php echo converterTempo($mob['respawnTime']); ?></label>
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
         <?php if ($npcs): ?>
         <?php foreach ($npcs as $npc): ?>
         <li class="itens">
            <a>
               <div class="white-bg"><img id="itens" alt="Caixa de Presente" src="<?php echo npcImage($npc['job']); ?>" /></div>
               <label><img src="img/icones/mapa.png" width="13px"> NPC's</label>
               <h5><?php echo $npc['name']; ?></h5>
               <label>Local: <?php echo $npc['mapname']; ?><br> Cordenadas: <?php echo ''.$npc['x'].','.$npc['y'].''; ?></label>
            </a>
         </li>
         <?php endforeach; ?>
         <?php else: ?>
         <li class="itens">
            <a href="#">
               <div class="white-bg"><img id="itens" alt="Caixa de Presente" src="img/noimage.png" /></div>
               <label><img src="img/icones/mapa.png" width="13px"> Mapas</label>
               <h5>Sem Respawn</h5>
               <label>Local: - <br> Cordenadas: -</label>
            </a>
         </li>
         <?php endif; ?>
      </ul>
   </section>
</main>
<?php endif; ?>