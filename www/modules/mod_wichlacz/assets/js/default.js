(function($){
	$(document).ready(function(e){
		$('.floatVal').focusout(function(e){
			if(isNaN(parseFloat($(this).val())) == true){
				$(this).addClass('bairo_invalidField');
				$('#bairo_boiler_filter_btn').addClass('disable btn_blue_selected');
			}else{
				$(this).removeClass('bairo_invalidField');
				$('#bairo_boiler_filter_btn').removeClass('disable btn_blue_selected');
			}
		});
		
		$('#wichlacz_module_filter').validator();
		$('#wichlacz_module_filter_send_mail').validator();
		
		$('#bairo_boiler_filter_btn').click(function(e){
			if($('#bairo_boiler_filter_btn').hasClass('disable')){
				return;
			}
			
			var roomSpace = $('#wichlacz_module_filter *[name="room_space"]').val();
			var filter_1 = $('#wichlacz_module_filter *[name="building_type"]').val();
			var filter_1_name = $('#wichlacz_module_filter *[name="building_type"] option:selected').data('name');
			var filter_2 = $('#wichlacz_module_filter *[name="type_flue"]').val();
			var filter_2_name = $('#wichlacz_module_filter *[name="type_flue"] option:selected').data('name');
			var filter_3_name = '';
			
			$('#wichlacz_module_filter input[name="flue_supply"]:checked').each(function(i, entity){
				filter_3_name += $(entity).val() + ', ';
			});
			
			filter_3_name = filter_3_name.substr(0, filter_3_name.length-2);
			
			console.log(filter_3_name);
			
			window.location = encodeURI($('#wichlaczFilterData_filterResultUrl').val() + 
				'?filter_result=1&room_space=' + roomSpace + 
				'&building_type=' + filter_1 + '&building_type_name=' + filter_1_name + 
				'&type_flue=' + filter_2 + '&type_flue_name=' + filter_2_name +
				'&flue_supply=' + filter_3_name);
			
		});
		
			//	Отправить письмо на мыло
		$('#wichlacz_module_filter_send_mail_btn').click(function(e){
			var recipientEmail = $('#wichlaczFilterData_filterRecipientEmail').val();
			
			$.ajax({
				url: '/modules/mod_wichlacz/assets/php/sendmain.php',
				data: $('#wichlacz_module_filter_send_mail *[name]').serialize(),
				type: 'post',
				success: function(data){
					if(data == '1'){
						alert('Письмо успешно отправлено!');
						
						//	Чистим форму
						$('#wichlacz_module_filter_send_mail select').val($('#wichlacz_module_filter_send_mail select').prop('defaultSelected'));
						$('#wichlacz_module_filter_send_mail input').val('');
					}else{
						alert('При отправки письма произошла ошибка.');
					}
				}
			});
		});
		
		$('#myHeader').hover(function(e){
			$(this).css('color', 'red');
		});
		
		$('#myTriggerHover').hover(function(e){
			console.log(e.type);
			$('#myHeader').trigger('mouseenter');
		});
	});
})(jQuery);