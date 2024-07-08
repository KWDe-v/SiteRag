<?php
function elementMonster() {
	return [
		
		'Water' 	=> 'Água',
		'Ghost' 	=> 'Fantasma',
		'Fire' 		=> 'Fogo',
		'Undead' 	=> 'Maldito',
		'Neutral' 	=> 'Neutro',
		'Holy' 		=> 'Sagrado',
		'Dark' 		=> 'Sombrio',
		'Earth' 	=> 'Terra',
		'Wind' 		=> 'Vento',
		'Poison'	=> 'Veneno'
    ];  
}
function elementMonsterIcon($key) {
 
 return '<img src="img/icones/elementos/'.$key.'.png" width="30px">';

}
?>