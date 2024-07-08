<?php


function itemSubType($type){
	if($type == 'weapon'){
		return [
			'1haxe'			=> 'Machado de Uma Mão',
			'1hspear'		=> 'Lança de Uma Mão',
			'1hsword'		=> 'Espada de Uma Mão',
			'2haxe'			=> 'Machado de Duas Mãos',
			'2hspear'		=> 'Lança de Duas Mãos',
			'2hstaff'		=> 'Cajado de Duas Mãos',
			'2hsword'		=> 'Espada de Duas Mãos',
			'book'			=> 'Livro',
			'bow'			=> 'Arco',
			'dagger'		=> 'Adaga',
			'gatling'		=> 'Metralhadora Gatling',
			'grenade'		=> 'Lança-Granadas',
			'huuma'			=> 'Shuriken Huuma',
			'katar'			=> 'Katar',
			'knuckle'		=> 'Punho',
			'mace'			=> 'Maça',
			'musical'		=> 'Instrumento Musical',
			'revolver'		=> 'Revólver',
			'rifle'			=> 'Rifle',
			'shotgun'		=> 'Espingarda',
			'staff'			=> 'Cajado',
			'whip'			=> 'Chicote'

		];

	}elseif($type == 'ammo'){
		return [
			'arrow'			=> 'Flecha',
			'bullet'		=> 'Projétil',
			'dagger'		=> 'Adaga Arremessável',
			'cannonball'	=> 'Bala de Canhão',
			'grenade'		=> 'Granada',
			'kunai'			=> 'Kunai',
			'shell'			=> 'Concha',
			'shuriken'		=> 'Shuriken',
			'throwweapon'	=> 'Arremessável'
		];
	}elseif($type == 'card'){
		return [
			'unknown'		=> 'N/A',
			'enchant'		=> 'Encantamento'
		];
	}else{
		return 	['unknown'	=> 'N/A'];
	}
}
function itemSubTypeIcon($type, $subtybe) {
		if($type == 'ammo' || $type == 'weapon'){
    		return '<img src="img/icones/categoriaitem/'.$type.'/'.$subtybe.'.png" style="width:24px; margin-right: 5px;">';
    	}else{
    		return '<img src="img/icones/categoriaitem/'.$subtybe.'.png" style="width:24px; margin-right: 5px;">';
    	}
}	
?>
