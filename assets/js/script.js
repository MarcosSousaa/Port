$(document).ready(function(){
	/* CONFIGURAÇÕES GLOBAIS */
	$('input[name=cpf]').mask('000.000.000-00');

	placa = $('input[name="placa"]').val();	
	$('input[name=placa]').mask('SSS-0000');	
});