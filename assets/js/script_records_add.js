$(document).ready(function(){
	/**
	* TELA REGISTROS - CADASTROS
	 */
	$('.padrao').hide();
	$('#tipoChaves').hide();
	$('#tipoRecebimento').hide();
	$('#tipoServico').hide();
	$('#msg-veiculos').hide();
	$('#obs_reg').hide();	
	$('#lbl_reg').hide();
	// FUNÇÃO PEGA A HORA ATUAL
	function horaAtualFormatada(){
		var horario = new Date();
		var hora = horario.getHours();
		if(hora.toString().length == 1)
			hora = "0"+hora;
		var min = horario.getMinutes();
		if(min.toString().length == 1)
			min = "0"+min;
		return hora+':'+min;
	}
	$('#visitante').change(function(){
		var visitante = $('#visitante').val();
		if(visitante == '1'){			
			$('#placa-reg').attr("name", "placa_vr");
			$('#placa-reg').attr("id", "placa");
			$('#nome-reg').attr("name", "motorista_vr");
			$('#nome-reg').removeAttr('disabled');
			$('#empresa-reg').attr("name", "empresa_vr");
			$('#empresa-reg').removeAttr('disabled');
		}
		else {			
			$('#placa').attr("name", "");
			$('#placa').attr("id", "placa-reg");
			$('#nome-reg').attr("name", "motorista_vr");
			$('#nome-reg').attr('disabled', 'disabled');
			$('#empresa-reg').attr("name", "empresa_vr");
			$('#empresa-reg').attr('disabled', 'disabled');
		}
	});
	$('#tipoReg').change(function(){		
		var tipo = $('#tipoReg').val();		                           
		$('#hora_er').val('');
		if(tipo == '0'){
			$('#titulo-registro').text('Registrar Retirada de chave');						
			$('.padrao').show();	
			$('#tipoServico').hide();
			$('#tipoRecebimento').hide();
			$('#tipoChaves').hide();
			$('#obs_reg').hide();
			$('#lbl_reg').hide();
            $("#chaves").attr("name","chaves_id");
            $("#colab_ret").attr("name","colab_ret");
			$.ajax({
				type: 'POST',				
				url: BASE_URL+'/ajax/buscaChaves'
			}).done(function(result){
				console.log(result);				                             
				$('#hora_er').val(horaAtualFormatada());				                           
				$('#tipoChaves').show();						
				$('#chaves').html(result);				
			}).fail(function(){
				alert('Nao foi possivel, preencher o input com as informações');
			});
		}

		if(tipo == '1'){
	        $('#titulo-registro').text('Registrar Novo Recebimento');	        		
	        $('.padrao').show();	
	        $('#tipoChaves').hide();
	        $('#tipoRecebimento').hide();
	        $('#tipoServico').hide();
	        $('#obs_reg').show();
	        $('#lbl_reg').show();
	        $("#tipo_vr").attr("name","tipo_vr");
	        $("#placa_r").attr("name","placa_vr");
	        $('#nome_reg').attr("name", "motorista_vr");
	        $('#empresa_reg').attr("name", "empresa_vr");
			$.ajax({
				type: 'POST'
			}).done(function(result){								                             
				$('#hora_er').val(horaAtualFormatada());				                         
				$('#tipoRecebimento').show();				
			}).fail(function(){
				
			});	
		}				
		if(tipo == '2'){
            $('#titulo-registro').text('Registrar nova Entrada de Serviço');            	
            $('.padrao').show();	
            $('#tipoServico').hide();
            $('#tipoRecebimento').hide();
            $('#tipoChaves').hide();
            $('#obs_reg').show();     
            $('#lbl_reg').show();               
            $("#ukVeiculo").attr("name","veiculos_id");
            $.ajax({
                type: 'POST'								
			}).done(function(result){											
				$('#hora_er').val(horaAtualFormatada());				                           
				$('#tipoServico').show();
			}).fail(function(){
				
			});		
		}
		
	});
	// FUNÇÃO AO SAIR DO INPUT PLACA
	$('#placa-reg').on('blur',function(){
		var filtro = $('#placa-reg').val().toUpperCase();		
		$.ajax({
				type: 'POST',
				data: {filtro:filtro},
				url: BASE_URL+'/ajax/buscaVeiculos'
			}).done(function(result){
				var obj = $.parseJSON(result);				
				if(obj.length == 0){
					$('#nome-reg').val('');
					$('#empresa-reg').val('');					
					var id = $('#modal').attr("href");
        			var alturaTela = $(document).height();
        			var larguraTela = $(window).width();
        			//colocando o fundo preto
			        $('#mascara').css({'width':larguraTela,'height':alturaTela});
			        $('#mascara').fadeIn(1000); 
			        $('#mascara').fadeTo("slow",0.8);
        			var left = ($(window).width() /2) - ( $(id).width() / 2 );
        			var top = ($(window).height() / 2) - ( $(id).height() / 2 );
	     		    $(id).css({'top':top,'left':left});
        			$(id).show();
        			$('.msgTitle').text("VEICULO NAO CADASTRADO");
        			$('.msgTitle').css('color','red');
        			$('input[name="placa"]').val($('#placa-reg').val().toUpperCase());
				}   
				else{					
					$('#ukVeiculo').val(obj.id);
					$('#nome-reg').val(obj.motorista);
					$('#empresa-reg').val(obj.empresa);
                    $('#msg-veiculos').hide();
				}   

			}).fail(function(){
				
			});		
	});

	/* TELA EDIÇÃO*/	
	$('#hora_sr').mask("00:00");
	$('#hora_int_sai').mask("00:00");
	$('#hora_int_en').mask("00:00");
	
 
    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });
 
    $('.close').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $('.msgTitle').empty();
        $(".window").hide();
        $('#msg-veiculos').hide("slide");
        $('#tipoServico').show();
    });

    $('#adcVeiculo').click(function(){    	
    	var tipo = $("#tipo option:selected").val();    	
    	var motorista = $("input[name='motorista']").val();    	
    	var placa = $("input[name='placa']").val().replace('-','');    	
    	var empresa = $("input[name='empresa']").val();    	    	
    	$.ajax({
    		url: BASE_URL+'/ajax/cadVeiculos',
    		data: {tipo : tipo,motorista: motorista,placa: placa,empresa: empresa},
    		type: 'POST'    		
    	}).done(function(evt){    		
		  	$("#mascara").hide();
	        $(".window").hide();
	        $('#msg-veiculos').hide("slide");
	        $('#tipoServico').show();
	        $('#placa-reg').val(placa);
    	}).fail(function(evt){
    		alert('ERROU');
    		alert(evt);
    	});
    });

});
