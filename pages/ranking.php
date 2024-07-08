<?php if(isset($naoEncontrado)): ?>
<div class="db-container">
   <h1>Nenhum Jogador Encontrado</h1>
   <p>Nenhum Resultado Encontrado. <a href="?to=inicio">Voltar para o Início</a></p>
</div>
<?php else: ?>      
<div class="db-container">
   <div class="db-content">
      <?php if($_GET['type'] == 'zeny'):?>
      <h1>Ranking de Zeny</h1>
      <br><br>
      <table class="db-itens">
         <tr align="left">
            <th align="center">Posição</th>
            <th>Nome</th>
            <th>Zeny</th>
            <th>Classe</th>
            <th>Nivel de Base</th>
            <th>Nível de Classe</th>
            <th colspan="2">Nome da Guild</th>
         </tr>
         <?php foreach ($chars as $key => $zeny): ?>
         <?php $imgrank = ($key < 3) ? "<img src='img/icones/ranking/top" . ($key+1) . ".png' width='30px'>" : ""; ?>
         <tr align="left">
            <td align="center"><?php echo $imgrank ?><?php echo $key+1 ?><?php echo (strtolower($zeny['sex']) == 'f') ?  'ª' :   'º'?></td>
            <td><?php echo $zeny['name'] ?></td>
            <td><?php echo formatarNumero($zeny['zeny'])?></td>
            <td><?php echo getClasse($zeny['class']) ?></td>
            <td><?php echo $zeny['base_level'] ?></td>
            <td><?php echo $zeny['job_level'] ?></td>
            <td colspan="2"><span class="not-applicable"><?php echo $zeny['guild_name'] ?></span></td>
         </tr>
         <?php endforeach; ?>
      </table>
      <?php elseif($_GET['type'] == 'pvp'):?>
      <h1>Ranking de Kills</h1>
      <br><br>
      <table class="db-itens">
         <tr align="left">
            <th align="center">Posição</th>
            <th>Nome</th>
            <th>Matou</th>
            <th>Morreu</th>
            <th>Classe</th>
            <th>Nivel de Base</th>
            <th>Nível de Classe</th>
            <th colspan="2">Nome da Guild</th>
         </tr>
         <?php foreach ($chars as $key => $kill): ?>
         <?php $imgrank = ($key < 3) ? "<img src='img/icones/ranking/top" . ($key+1) . ".png' width='30px'>" : ""; ?>
         <tr>
            <td align="center"><?php echo $imgrank ?><?php echo $key+1 ?><?php echo (strtolower($kill['sex']) == 'f') ?  'ª' :   'º'?></td>
            <td><?php echo $kill['name']; ?></td>
            <td><?php echo $kill['total_matou']; ?></td>
            <td><?php echo $kill['total_morreu']; ?></td>
            <td><?php echo getClasse($kill['class']); ?></td>
            <td><?php echo $kill['base_level']; ?></td>
            <td><?php echo $kill['job_level']; ?></td>
            <td><?php echo getGuildName($kill['guild_id'],$conn); ?></td>
         </tr>
         <?php endforeach; ?>
      </table>
      <?php elseif($_GET['type'] == 'mvp'):?>
      <h1>Ranking MvP</h1>
      <br><br>
      <table class="db-itens">
         <tr align="left">
            <th align="center">Posição</th>
            <th>Nome</th>
            <th>Kill's</th>
            <th>Classe</th>
            <th>Nivel de Base</th>
            <th>Nível de Classe</th>
            <th colspan="2">Nome da Guild</th>
         </tr>
         <?php foreach ($chars as $key => $mvp): ?>
         <?php $imgrank = ($key < 3) ? "<img src='img/icones/ranking/top" . ($key+1) . ".png' width='30px'>" : ""; ?>
         <tr>
            <td align="center"><?php echo $imgrank ?><?php echo $key+1 ?><?php echo (strtolower($mvp['sex']) == 'f') ?  'ª' :   'º'?></td>
            <td><?php echo $mvp['name'] ?></td>
            <td><?php echo formatarNumero($mvp['kills'])?></td>
            <td><?php echo getClasse($mvp['class']) ?></td>
            <td><?php echo $mvp['base_level'] ?></td>
            <td><?php echo $mvp['job_level'] ?></td>
            <td colspan="2"><span class="not-applicable"><?php echo $mvp['guild_name'] ?></span></td>
         </tr>
         <?php endforeach; ?>
      </table>
      <?php endif?>
      <?php endif?>
      <br><br>
      <?php if(!isset($naoEncontrado)): ?>
      <div class="footer-table">
         <a class="btn-footer-anterior" href="<?php echo $prev_page_url; ?>" style="color: white; <?php if ($page <= 1) echo 'pointer-events: none; opacity: 0.5;'; ?>" align="center">Anterior</a>
         <span id="paginas"><?php echo $page . ' de ' . $total_pages; ?></span>
         <?php if ($page == $total_pages): ?>
         <a class="btn-footer-proximo" href="<?php echo $next_page_url; ?>" style="color: white; pointer-events: none; opacity: 0.5;" align="center">Próximo</a><br><br>
         <?php else:?>
         <a class="btn-footer-proximo" href="<?php echo $next_page_url; ?>" style="color: white;"   align="center">Próximo</a>
         <?php endif?>
      </div>
      <div class="footer-table">
         <form id="page-form" onsubmit="goToPage(event)">
            <label for="page-number">Ir Para:</label>
            <input type="number" id="page-number" name="page" style="width: 75px;" min="1"max="<?php echo $total_pages; ?>">
            <button class="btn-filter" type="submit" style="width: 50px;">Ir</button>
         </form>
      </div>
   </div>
</div>
<?php endif?>