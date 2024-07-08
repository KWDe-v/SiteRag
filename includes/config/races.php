<?php
function raceMonster() {
	return [
	     'Angel'        => 'Anjo',
	     'Formless'     => 'Amorfo',
	     'Brute'        => 'Bruto',
	     'Demon'        => 'Demônio',
	     'Dragon'       => 'Dragão',
	     'Demihuman'    => 'Humanóide',
	     'Insect'       => 'Inseto',
	     'Undead'       => 'Morto-vivo',
	     'Fish'         => 'Peixe',
	     'Plant'        => 'Planta',
	];
}

function raceMonsterIcon($key) {
 
 return '<img src="img/icones/racas/'.$key.'.png" width="30px">';

}
?>
