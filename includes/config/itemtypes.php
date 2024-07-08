<?php
function itemType() {
    return [
        'weapon'        => 'Arma',
        'armor'         => 'Armadura',
        'petarmor'      => 'Armadura de Pet',
        'card'          => 'Slot\'s',
        'cash'          => 'Cash',
        'delayconsume'  => 'Consumível',
        'healing'       => 'Cura',
        'ammo'          => 'Munição',
        'petegg'        => 'Ovo de Pet',
        'etc'           => 'Outros',
        'shadowgear'    => 'Sombra de Equip',
        'usable'        => 'Utilizável'

    ];
}
function itemTypeIcon($key) {
    return '<img src="img/icones/tipoitem/'.$key.'.png" style="width:30px; margin-right: 5px;">';
}
?>
