<?php

function sizeMonster() {
    return [
      'Small'  => 'Pequeno',
      'Medium' => 'Médio',
      'Large'  => 'Grande'
   ];
}


function sizeMonsterIcon($key) {
	return '<img src="img/icones/tamanhos/'.$key.'.png" width="30px">';
}

?>
