	function addVeiculo(obj){
		var id = $(obj).attr('data-id');
		var placa = $(obj).attr('data-placa');
		var motorista = $(obj).attr('data-motorista');
		var empresa = $(obj).attr('data-empresa');
		$('.searchresults').hide();
		$('#ukVeiculo').val(id);
		$('#placa-reg').val(placa);
		$('#nome-reg').val(motorista);
		$('#empresa-reg').val(empresa);      

	}

$(document).ready(function(){
	/**
	* TELA REGISTROS - CADASTROS
 	*/
	$('.padrao').hide();
	$('#hora_er').mask("00:00");
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
			$('#nome-reg').attr("placeholder", "Informe o Motorista");
			//var inputNovo = '<div class="form-group col-md-3 inputRg"><label for="rg">RG Motorista</label><br><input type="text" class="form-control" placeholder="Informe o RG do motorista" name="rg" /><span class="errorMsgRG"></span></div>';
			//$('.nme').append(inputNovo);
			$('#empresa-reg').attr("name", "empresa_vr");
			$('#empresa-reg').attr("placeholder", "Informe a Empresa");
			$('#empresa-reg').removeAttr('disabled');
			$('#rg-entrada').removeAttr('disabled');
			$('#rg-entrada').attr('placeholder','Informe o RG do motorista');
			$('#obs_reg').text("");
			$('#obs_reg').text("VISITANTE FALAR C/");
		}
		else {			
			$('#placa').attr("name", "");
			$('#placa').attr("id", "placa-reg");
			$('#nome-reg').attr("name", "motorista_vr");
			$('#nome-reg').removeAttr('placeholder');
			$('#nome-reg').attr('disabled', 'disabled');
			$('#empresa-reg').attr("name", "empresa_vr");
			$('#empresa-reg').attr('disabled', 'disabled');
			$('#empresa-reg').removeAttr('placeholder');
			$('#rg-entrada').attr('disabled','disabled');
			$('#rg-entrada').removeAttr('placeholder');
			//$('#nome-reg').removeAttr('placeholder');
			$('.inputRg').remove();
			$('#obs_reg').text("");
			$('#obs_reg').text("FUNCIONARIO");
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
			$('input[name="rg"]').removeAttr('required');
            $("#chaves").attr("name","chaves_id");
            $("#colab_ret").attr("name","colab_ret");
			$.ajax({
				type: 'POST',				
				url: BASE_URL+'/ajax/buscaChaves'
			}).done(function(result){				
				$('#hora_er').val(horaAtualFormatada());				                           
				$('#tipoChaves').show();						
				$('#chaves').html(result);				
			}).fail(function(){
				alert('Nao foi possivel, preencher o input com as informações');
			});
		}

		if(tipo == '1'){
	        $('#titulo-registro').text('Registrar Entrega / Recebimento');	        		
	        $('.padrao').show();	
	        $('#tipoChaves').hide();
	        $('#tipoRecebimento').hide();
	        $('#tipoServico').hide();
	        $('input[name="rg"]').attr('required', 'required');
	        $('#obs_reg').show();
	        $('#lbl_reg').show();
	        $("#tipo_vr").attr("name","tipo_vr");
	        $("#placa_r").attr("name","placa_vr");
	        $("#placa_r").attr("required","required");
	        $('#nome_reg').attr("name", "motorista_vr");
	        $('#empresa_reg').attr("name", "empresa_vr");
			$.ajax({
				type: 'POST'
			}).done(function(result){								                             
				$('#hora_er').val(horaAtualFormatada());				                         
				$('#tipoRecebimento').show();
				$('#obs_reg').text("");	
				$('#obs_reg').text("NF:      - FALAR C/");
			}).fail(function(){
				
			});	
		}				
		if(tipo == '2'){
            $('#titulo-registro').text('Registrar Entrada Veículo');            	
            $('.padrao').show();	
            $('#tipoServico').hide();
            $('#tipoRecebimento').hide();
            $('#tipoChaves').hide();
            $('input[name="rg"]').removeAttr('required');
            $('#obs_reg').show();     
            $('#lbl_reg').show();               
            $("#ukVeiculo").attr("name","veiculos_id");
            $.ajax({
                type: 'POST'								
			}).done(function(result){
				var valid = true;											
				$('#hora_er').val(horaAtualFormatada());				                           
				$('#tipoServico').show();
				$('#obs_reg').text("");		
				$('#obs_reg').text("FUNCIONARIO");		
			}).fail(function(){
				
			});		
		}
		
	});

	/*
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
        			$('input[name="placa_c"]').val($('#placa-reg').val().toUpperCase());
				}   
				else{					
					$('#ukVeiculo').val(obj.id);
					$('#nome-reg').val(obj.motorista);
					$('#empresa-reg').val(obj.empresa);                    
				}   

			}).fail(function(){
				
			});		
	});

*/

	$('#placa-reg').on('keyup',function(){
			if($('#placa-reg').val().length >= 3){						
					var filtro = $(this).val();
					$.ajax({
						url: BASE_URL+'/ajax/buscaVeiculos',
						data: {filtro: filtro},
						type: 'POST',
						dataType: 'json'				
					}).done(function(json){			
						if($('.searchresults').length == 0){
							$('#placa-reg').after('<div class="searchresults"></div>');
						}
						if(json != undefined){
							$('.searchresults').css('left', $('#placa-reg').offset().left+'px');
							$('.searchresults').css('top', $('#placa-reg').offset().top+$('#placa-reg').height()+'px');	
							var html = '';
							for(var i in json){				
								html += '<div class="si"><a href="javascript:;" Onclick="addVeiculo(this)" data-id="'+json[i].id+'" data-placa="'+json[i].placa+'" data-motorista="'+json[i].motorista+'" data-empresa="'+json[i].empresa+'">'+json[i].placa+' -  '+json[i].motorista+'</a></div>';
							}
							$('.searchresults').html(html);
							$('.searchresults').show();
						}else {
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
			        			$('input[name="placa_c"]').val($('#placa-reg').val().toUpperCase());
						}
					}).fail(function(){
						alert ('falha');
					});
				}
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
    /* VALIDAÇÃO DE REGISTROS PARA ADICIONAR */
    $('#addRegistro').click(function(){
    	var tipo = $('#tipoReg').val();
    	if(tipo == '0'){
    		var valida = true;    		 
            var colab_ret = $('input[name="colab_ret"]').val();
            var chave = $('#chaves').val();
            if(chave == null){
    			setTimeout(function(){
	            		$('#chave').focus();
	            		$('#chave').css("border","1px solid red");
	            		$('.errorMsgChave').text('obrigatório escolher a chave retirada');
	            		$('.errorMsgChave').css("color","red");
            		});
            		setTimeout(function(){
	            		$('#chave').focus();
	            		$('#chave').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgChave').text("");
            		},10000); 
            		valida = false;                    
    		}

            else if(colab_ret.length < 1){
            	setTimeout(function(){
            		$('input[name="colab_ret"]').focus();
            		$('input[name="colab_ret"]').css("border","1px solid red");
            		$('.errorMsgColab').text('Nome do Colaborador é necessario');
            		$('.errorMsgColab').css("color","red");
            	});
            	setTimeout(function(){
            		$('input[name="colab_ret"]').focus();
            		$('input[name="colab_ret"]').css("border-color","rgb(169, 169, 169)");
            		$('.errorMsgColab').text("");
            	},10000); 
            	valida = false;                     	
            }            

            else{
            	valida = true;
            	if(valida){
            		$('form').submit();
            	}	
            } 
    	}

    	if(tipo == '1'){
    		var tipo = $('#tipo_vr').val();
    		var placa = $('input[name="placa_vr"]').val();
    		var motorista = $('input[name="motorista_vr"]').val();
    		var empresa = $('input[name="empresa_vr"]').val();
    		var rg = $('input[name="rg"]').val();
    		var obs = $('#obs_reg').val();

    		if(tipo == null){
    			setTimeout(function(){
	            		$('#tipo_vr').focus();
	            		$('#tipo_vr').css("border","1px solid red");
	            		$('.errorMsgTipo').text('Obrigatório escolhero o tipo de veículo');
	            		$('.errorMsgTipo').css("color","red");
            		});
            		setTimeout(function(){
	            		$('#tipo_vr').focus();
	            		$('#tipo_vr').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgTipo').text("");
            		},10000); 
            		valida = false;                    
    		}

    		else if(placa.length < 1){
    				setTimeout(function(){
	            		$('input[name="placa_vr"]').focus();
	            		$('input[name="placa_vr"]').css("border","1px solid red");
	            		$('.errorMsgPlacaReceb').text('Numero da Placa é obrigatório');
	            		$('.errorMsgPlacaReceb').css("color","red");
            		});
            		setTimeout(function(){
	            		$('input[name="placa_vr"]').focus();
	            		$('input[name="placa_vr"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgPlacaReceb').text("");
            		},10000); 
            		valida = false;                    
    			}
    			else if (motorista.length < 1){
					setTimeout(function(){
	            		$('input[name="motorista_vr"]').focus();
	            		$('input[name="motorista_vr"]').css("border","1px solid red");
	            		$('.errorMsgMotReceb').text('Nome do Motorista é obrigatório');
	            		$('.errorMsgMotReceb').css("color","red");
            		});
            		setTimeout(function(){
	            		$('input[name="motorista_vr"]').focus();
	            		$('input[name="motorista_vr"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgMotReceb').text("");
            		},10000); 
            		valida = false;                    
    			}
    			else if (rg.length < 1){
					setTimeout(function(){
	            		$('input[name="rg"]').focus();
	            		$('input[name="rg"]').css("border","1px solid red");
	            		$('.errorMsgRGReceb').text('Numero do RG do Motorista é obrigatório');
	            		$('.errorMsgRGReceb').css("color","red");
            		});
            		setTimeout(function(){
	            		$('input[name="rg"]').focus();
	            		$('input[name="rg"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgRGReceb').text("");
            		},10000); 
            		valida = false;                    
    			}
    			else if(empresa.length < 1 ){
					setTimeout(function(){
	            		$('input[name="empresa_vr"]').focus();
	            		$('input[name="empresa_vr"]').css("border","1px solid red");
	            		$('.errorMsgEmp').text('Nome da Empresa é obrigatório');
	            		$('.errorMsgEmp').css("color","red");
            		});
            		setTimeout(function(){
	            		$('input[name="empresa_vr"]').focus();
	            		$('input[name="empresa_vr"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgEmp').text("");
            		},10000); 
            		valida = false;                    
    			}
    			else if(obs.length < 1){    				
    				setTimeout(function(){
	            		$('input[name="obs_reg"]').focus();
	            		$('input[name="obs_reg"]').css("border","1px solid red");
	            		$('.errorMsgObs').text('Observação Obrigatoria');
	            		$('.errorMsgObs').css("color","red");
            		});
	            	setTimeout(function(){
	            		$('input[name="obs_reg"]').focus();
	            		$('input[name="obs_reg"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgObs').text("");
	            	},10000); 
            		valida = false;                    
    			}
    			else{
    				valida = true;
            		if(valida){
            			$('form').submit();
            		}		
    			}
    	}

    	if(tipo == '2'){
    		var visitante = $('#visitante').val();
    		if(visitante == '1'){
    			var placa = $('input[name="placa_vr"]').val();
    			var motorista = $('input[name="motorista_vr"]').val();
    			var rg = $('input[name="rg-entrada"]').val();
    			var empresa = $('input[name="empresa_vr"]').val();
    			var obs = $('#obs_reg').val();
    			if(placa.length < 1){
    				setTimeout(function(){
	            		$('input[name="placa_vr"]').focus();
	            		$('input[name="placa_vr"]').css("border","1px solid red");
	            		$('.errorMsgPlaca').text('Numero da Placa é obrigatório');
	            		$('.errorMsgPlaca').css("color","red");
            		});
            		setTimeout(function(){
	            		$('input[name="placa_vr"]').focus();
	            		$('input[name="placa_vr"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgPlaca').text("");
            		},10000); 
            		valida = false;                    
    			}
    			else if (motorista.length < 1){
					setTimeout(function(){
	            		$('input[name="motorista_vr"]').focus();
	            		$('input[name="motorista_vr"]').css("border","1px solid red");
	            		$('.errorMsgMot').text('Nome do Motorista é obrigatório');
	            		$('.errorMsgMot').css("color","red");
            		});
            		setTimeout(function(){
	            		$('input[name="motorista_vr"]').focus();
	            		$('input[name="motorista_vr"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgMot').text("");
            		},10000); 
            		valida = false;                    
    			}
    			else if (rg.length < 1){
					setTimeout(function(){
	            		$('input[name="rg-entrada"]').focus();
	            		$('input[name="rg-entrada"]').css("border","1px solid red");
	            		$('.errorMsgRG').text('Numero do RG do Motorista é obrigatório');
	            		$('.errorMsgRG').css("color","red");
            		});
            		setTimeout(function(){
	            		$('input[name="rg-entrada"]').focus();
	            		$('input[name="rg-entrada"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgRG').text("");
            		},10000); 
            		valida = false;                    
    			}
    			else if(empresa.length < 1 ){
					setTimeout(function(){
	            		$('input[name="empresa_vr"]').focus();
	            		$('input[name="empresa_vr"]').css("border","1px solid red");
	            		$('.errorMsgEmp').text('Nome da Empresa é obrigatório');
	            		$('.errorMsgEmp').css("color","red");
            		});
            		setTimeout(function(){
	            		$('input[name="empresa_vr"]').focus();
	            		$('input[name="empresa_vr"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgEmp').text("");
            		},10000); 
            		valida = false;                    
    			}
    			else if(obs.length < 1){    				
    				setTimeout(function(){
	            		$('input[name="obs_reg"]').focus();
	            		$('input[name="obs_reg"]').css("border","1px solid red");
	            		$('.errorMsgObs').text('Observação Obrigatória');
	            		$('.errorMsgObs').css("color","red");
            		});
	            	setTimeout(function(){
	            		$('input[name="obs_reg"]').focus();
	            		$('input[name="obs_reg"]').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgObs').text("");
	            	},10000); 
            		valida = false;                    
    			}
    			else{
    				valida = true;
            		if(valida){
            			$('form').submit();
            		}		
    			}
    		}
    		else {
    			var obs = $('#obs_reg').val();
    			if(obs.length < 1){    				
    				setTimeout(function(){
	            		$('#obs_reg').focus();
	            		$('#obs_reg').css("border","1px solid red");
	            		$('.errorMsgObs').text('Observação Obrigatória');
	            		$('.errorMsgObs').css("color","red");
            		});
	            	setTimeout(function(){
	            		$('#obs_reg').focus();
	            		$('#obs_reg').css("border-color","rgb(169, 169, 169)");
	            		$('.errorMsgObs').text("");
	            	},10000); 
            		valida = false;                    
    			}
    			else{
    				valida = true;
            		if(valida){
            			$('form').submit();
            		}		
    			}	
    		}    		
    	}    	
    });
    /* ADICIONA VEICULOS NA TELA DE REGISTROS */
    $('#adcVeiculo').click(function(){    	
    	var tipo = $("#tipo option:selected").val();    	
    	var motorista = $("input[name='motorista']").val();    	
    	var placa = $("input[name='placa_c']").val().replace('-','');    	
    	var empresa = $("input[name='empresa']").val();

    	if(tipo == null){
    		setTimeout(function(){
	    		$('#tipo').focus();
	    		$('#tipo').css("border","1px solid red");
	    		$('.errorMsgTipoCad').text('Escolha o tipo');
	    		$('.errorMsgTipoCad').css("color","red");
			});
        	setTimeout(function(){
	    		$('#tipo').focus();
	    		$('#tipo').css("border-color","rgb(169, 169, 169)");
	    		$('.errorMsgTipoCad').text("");
        	},10000); 
    		valida = false;                    	
    	}
    	else if(motorista.length < 2){
    		setTimeout(function(){
	    		$('input[name="motorista"]').focus();
	    		$('input[name="motorista"]').css("border","1px solid red");
	    		$('.errorMsgMotCad').text('Nome motorista obrigatório');
	    		$('.errorMsgMotCad').css("color","red");
			});
        	setTimeout(function(){
	    		$('input[name="motorista"]').focus();
	    		$('input[name="motorista"]').css("border-color","rgb(169, 169, 169)");
	    		$('.errorMsgMotCad').text("");
        	},10000); 
    		valida = false;                    		
    	}

	  	else if(empresa.length < 2){
    		setTimeout(function(){
	    		$('input[name="empresa"]').focus();
	    		$('input[name="empresa"]').css("border","1px solid red");
	    		$('.errorMsgEmpCad').text('Nome Empresa Obrigatória');
	    		$('.errorMsgEmpCad').css("color","red");
			});
        	setTimeout(function(){
	    		$('input[name="empresa"]').focus();
	    		$('input[name="empresa"]').css("border-color","rgb(169, 169, 169)");
	    		$('.errorMsgEmpCad').text("");
        	},10000); 
    		valida = false;                    		
    	}
		else if(placa.length < 2){
    		setTimeout(function(){
	    		$('input[name="placa_c"]').focus();
	    		$('input[name="placa_c"]').css("border","1px solid red");
	    		$('.errorMsgPlacaCad').text('Placa é Obrigatória');
	    		$('.errorMsgPlacaCad').css("color","red");
			});
        	setTimeout(function(){
	    		$('input[name="placa_c"]').focus();
	    		$('input[name="placa_c"]').css("border-color","rgb(169, 169, 169)");
	    		$('.errorMsgPlacaCad').text("");
        	},10000); 
    		valida = false;                    		
    	}
    	else {
    		valida = true;
    	}    	
    	if(valida){
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
    		});
    	}    
	});
});
