function doFilterExecute() {
	var params = '';

	if($('select[name=tipo]').val() == '')
		params = '';
	else if($('select[name=tipo]').val() == 0)
		params = 'tipo=Regeneração';
	else if($('select[name=tipo]').val() == 1)
		params = 'descricao=Recupera';

	setFilter($('#input-itens').val(), params);
}

function doFilterRead() {
	var vars = getFilterVars();

	if(vars['tipo'] != undefined && vars['tipo'] == 'Regenera%C3%A7%C3%A3o')
		$('select[name=tipo]').val(0);
	else if(vars['descricao'] != undefined && vars['descricao'] == 'Recupera')
		$('select[name=tipo]').val(1);
	else
		$('select[name=tipo]').val('');
}