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
      <?php if(!isset($_GET['busca'])):?>
      <button class="btn-filter" style="pointer-events: none; opacity: 0.6;">Limpar</button><br><br>
      <?php else:?>
      <a href="?to=monstros&page=1"><button class="btn-filter">Limpar</button></a>
      <?php endif?>
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
            <td><?php echo $monstro['name_english']; ?></td>
            <td>❤️ <?php echo formatarNumero($monstro['hp']); ?></td>
            <td><?php echo $tamanho[$monstro['size']]; ?></td>
            <td><?php echo $raca[$monstro['race']]; ?></td>
            <td><?php echo $elemento[$monstro['element']]; ?></td>
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
            <input type="number" id="page-number" name="page" style="width: 50px;">
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