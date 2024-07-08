<div class="db-container">
   <div class="db-content">
      <h1>Lista de Monstros</h1>
      <div class="search-box">
         <form id="buscarItens" method="get" action="">
            <input name="to" type="hidden" value="monstros" />
            <input name="page" type="hidden" value="1" />
            <input name="busca" type="text" placeholder="Procurar nome ou id" value="<?php if(isset($_GET['busca'])) echo $_GET['busca'];?>" />
            <button type="submit" class="fas fa-search btn-filter" style="width:50px;"></button>
         </form>
      </div>
      <a href="javascript:toggleSearchForm()"><button class="btn-filter">Filtrar</button></a>
      <?php if(!isset($_GET['busca']) && !isset($_GET['filter'])):?>
      <button class="btn-filter" style="pointer-events: none; opacity: 0.6;">Limpar</button><br><br>
      <?php else:?>
      <a href="?to=monstros&page=1"><button class="btn-filter">Limpar</button></a>
      <?php endif?>
      <form id="filterForm" method="get" action="">
         <div id="filter" class="filterdb">
            <input type="hidden" name="to" value="monstros">
            <input type="hidden" name="page" value="1">
            <?php foreach (sizeMonster() as $key => $size): ?>
            <?php if ($size !== 'N/A' && $key !== 'N/A'): ?>
            <div class="radio-item">
               <?php if (isset($_GET['filter']) && $key == $_GET['filter']): ?>
               <input id="tipo<?php echo $key; ?>" type="radio" name="filter" value="<?php echo$key; ?>"onclick="submitFormFilter(this)" <?php echo isset($_GET['filter']) && $_GET['filter'] == $key ? 'checked' : ''; ?>>
               <?php else: ?>
               <input id="tipo<?php echo $key; ?>" type="radio" name="filter" value="<?php echo$key; ?>"onclick="submitFormFilter(this)">
               <?php endif ?>
               <label for="tipo<?php echo $key; ?>" style="color:white;"><?php echo sizeMonsterIcon($key)?> <?php echo $size; ?></label>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php foreach (raceMonster() as $key => $race): ?>
            <?php if ($race !== 'N/A' && $key !== 'N/A'): ?>
            <div class="radio-item">
               <?php if (isset($_GET['filter']) && $key == $_GET['filter']): ?>
               <input id="tipo<?php echo $key; ?>" type="radio" name="filter" value="<?php echo$key; ?>"onclick="submitFormFilter(this)" <?php echo isset($_GET['filter']) && $_GET['filter'] == $key ? 'checked' : ''; ?>>
               <?php else: ?>
               <input id="tipo<?php echo $key; ?>" type="radio" name="filter" value="<?php echo$key; ?>"onclick="submitFormFilter(this)">
               <?php endif ?>
               <label for="tipo<?php echo $key; ?>" style="color:white;"><?php echo raceMonsterIcon($key)?> <?php echo $race; ?></label>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php foreach (elementMonster() as $key => $element): ?>
            <?php if ($element !== 'N/A' && $key !== 'N/A'): ?>
            <div class="radio-item">
               <?php if (isset($_GET['filter']) && $key == $_GET['filter']): ?>
               <input id="tipo<?php echo $key; ?>" type="radio" name="filter" value="<?php echo$key; ?>"onclick="submitFormFilter(this)" <?php echo isset($_GET['filter']) && $_GET['filter'] == $key ? 'checked' : ''; ?>>
               <?php else: ?>
               <input id="tipo<?php echo $key; ?>" type="radio" name="filter" value="<?php echo$key; ?>"onclick="submitFormFilter(this)">
               <?php endif ?>
               <label for="tipo<?php echo $key; ?>" style="color:white;"><?php echo elementMonsterIcon($key)?> <?php echo $element; ?></label>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <div class="radio-item">
               <?php if (isset($_GET['filter']) && $key == $_GET['filter']): ?>
               <input id="tipomvp" type="radio" name="filter" value="mvp_exp"onclick="submitFormFilter(this)" <?php echo isset($_GET['filter']) && $_GET['filter'] == $key ? 'checked' : ''; ?>>
               <?php else: ?>
               <input id="tipomvp" type="radio" name="filter" value="mvp_exp"onclick="submitFormFilter(this)">
               <?php endif ?>
               <label for="tipomvp" style="color:white; display: flex; align-items: center;"><img src="img/icones/mvp.png" style="width:30px; margin-right: 5px;" /> MVP</label>
            </div>
         </div>
      </form>
      <?php if(!isset($_GET['error']) == 'naoencontrado'):?>
      <?php if($monstros):?>
      <table class="db-itens">
         <tr align="left">
            <th align="center">ID</th>
            <th colspan="2"align="center">Nome</th>
            <th>HP</th>
            <th>Tamanho</th>
            <th>Raça</th>
            <th>Elemento</th>
            <th align="center">Ação</th>
         </tr>
         <?php foreach ($paginated_monsters as $monstro): ?>
         <tr align="left">
            <td align="center"><?php echo $monstro['id']; ?></td>
            <td align="center"><img src="<?php echo monsterImageIndex($monstro['id']); ?>" style="max-width: 100px;"></td>
            <?php if($monstro['mvp_exp']):?>
            <td><?php echo $monstro['name_english']; ?><img src="img/icones/mvp.png"/></td>
            <?php else:?>
            <td><?php echo $monstro['name_english']; ?></td>
            <?php endif?>
            <td>❤️ <?php echo formatarNumero($monstro['hp']); ?></td>
            <td><?php echo sizeMonsterIcon($monstro['size'])?> <?php echo sizeMonster()[$monstro['size']]; ?></td>
            <td><?php echo raceMonsterIcon($monstro['race'])?> <?php echo raceMonster()[$monstro['race']]; ?></td>
            <td><?php echo elementMonsterIcon($monstro['element'])?> <?php echo elementMonster()[$monstro['element']]; ?></td>
            <td align="center"><a href="?to=vermonstro&id=<?php echo $monstro['id']; ?>" class="btn-filter" style="color: white;">Visualizar</a></td>
         </tr>
         <?php endforeach; ?>
      </table>
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
      <?php else:?>
      <p>Nenhum Resultado Encontrado<a href="?to=inicio">Voltar a Pagina Inicial</a></p>
      <?php endif?>
      <?php else:?>
      <p>Nenhum Resultado Encontrado. <a href="?to=monstros&page=1">Voltar para a lista de monstros</a></p>
      <?php endif?>
   </div>
</div>