<div class="db-container">
   <div class="db-content">
      <h1>Lista de Itens</h1>
      <div class="search-box">
         <form id="buscarItens" method="get" action="">
            <input name="to" type="hidden" value="itens" />
            <input name="page" type="hidden" value="1" />
            <input name="busca" type="text" placeholder="Procurar nome ou id" value="<?php if(isset($_GET['busca'])) echo $_GET['busca'];?>" />
            <button type="submit" class="fas fa-search btn-filter" style="width:50px;"></button>
         </form>
      </div>
      <a href="javascript:toggleSearchForm()"><button class="btn-filter">Filtrar</button></a>
      <?php if(!isset($_GET['busca']) && !isset($_GET['filter'])):?>
      <button class="btn-filter" style="pointer-events: none; opacity: 0.6;">Limpar</button><br><br>
      <?php else:?>
      <a href="?to=itens&page=1"><button class="btn-filter">Limpar</button></a>
      <?php endif?>
        <form id="filterForm" method="get" action="">
      <div id="filter" class="filterdb">   
         <input type="hidden" name="to" value="itens">
           <input type="hidden" name="page" value="1">
             <?php foreach (itemType() as $key => $type): ?>                
                  <div class="radio-item">
                     <?php if (isset($_GET['filter']) && $key == $_GET['filter']): ?>
                      <input id="tipo<?php echo $key; ?>" type="radio" name="filter" value="<?php echo$key; ?>"onclick="submitFormFilter(this)" <?php echo isset($_GET['filter']) && $_GET['filter'] == $key ? 'checked' : ''; ?>>
                     <?php else: ?>
                     <input id="tipo<?php echo $key; ?>" type="radio" name="filter" value="<?php echo$key; ?>"onclick="submitFormFilter(this)">
                     <?php endif ?>
                      <label for="tipo<?php echo $key; ?>"><?php echo itemTypeIcon($key) ?><?php echo $type; ?></label>
                  </div>         
             <?php endforeach; ?>
         </div>
      </form>
      <?php if(!isset($_GET['error']) == 'naoencontrado'):?>
      <?php if($itens):?>
      <table class="db-itens">
         <tr>
            <th>ID</th>
            <th colspan="2">Nome</th>
            <th>Tipo</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Peso</th>
            <th>Ação</th>
         </tr>
         <?php foreach ($paginated_items as $item): ?>
         <tr align="center">
            <td><?php echo $item['id']; ?></td>
            <td width="24"><img src="<?php echo iconImage($item['id']); ?>" /></td>
            <td align="left"><?php echo $item['name_english']; ?></td>
            <td><?php echo itemTypeIcon($item['type']) ?><?php echo itemType()[$item['type']]; ?></td>
            <?php if ($item['type'] == 'weapon' || $item['type'] == 'ammo'): ?>
            <td><?php echo itemSubTypeIcon($item['type'],$item['subtype'])?><?php echo itemSubType($item['type'])[$item['subtype']]; ?></td>
            <?php elseif(($item['type'] == 'card') && ($item['id'] > 4453)): ?>
            <td><?php echo itemSubTypeIcon('card', 'enchant')?>Encantamento</td>
            <?php elseif(($item['type'] == 'card') && ($item['id'] <= 4453)): ?>
            <td><img src="<?php echo iconImage($item['id']); ?>"width="24px" /> Carta</td>
            <?php else: ?>
            <td><?php echo itemSubTypeIcon($item['type'],$item['subtype'])?><?php echo itemSubType($item['type'])[$item['subtype']]; ?></td>
            <?php endif ?>
            <td><span style="font-size: 24px;">💸</span> <?php echo $item['price_buy']; ?></td>
            <td><span style="font-size: 24px;">⚖️</span> <?php echo $item['weight']; ?></td>
            <td ><a href="?to=veritem&id=<?php echo $item['id']; ?>" class="btn-filter" style="color: white;">Visualizar</a></td>
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
            <label for="page-number" style="color: white;">Ir Para:</label>
            <input type="number" id="page-number" name="page" style="width: 75px;" min="1"max="<?php echo $total_pages; ?>">
            <button class="btn-filter" type="submit" style="width: 50px;">Ir</button>
         </form>
      </div>
      <?php else:?>
      <p>Nenhum Resultado Encontrado<a href="?to=inicio">Voltar a Pagina Inicial</a></p>
      <?php endif?>
      <?php else:?>
      <p>Nenhum Resultado Encontrado. <a href="?to=itens&page=1">Voltar para a lista de itens</a></p>
      <?php endif?>
   </div>
</div>
