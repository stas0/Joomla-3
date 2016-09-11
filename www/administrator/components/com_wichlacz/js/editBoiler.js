(function($){
	$(document).ready(function(e){
		$('#jform_range_heating_min, #jform_range_heating_max, #jform_max_working_pressure, #jform_width_furnace_door,' +
			'#jform_height_furnace_door, #jform_height_furnace, #jform_length_furnace, #jform_width_furnace, #jform_depth_furnace,' +
			'#jform_volume_furnace, #jform_volume_water, #jform_cross_section_chimney, #jform_cross_section_chimney,' +
			'#jform_thickness_metal_furnace, #jform_price, #jform_power'
		).focusout(function(e){
			if(isNaN(parseFloat($(this).val())) == true){
				$(this).addClass('bairo_invalidField');
			}else{
				$(this).removeClass('bairo_invalidField');
			}
		});
	})
})(jQuery);