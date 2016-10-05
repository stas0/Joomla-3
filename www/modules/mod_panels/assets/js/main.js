(function($){
	$(document).ready(function(e){
		var currData = {
			'panel': null,
			'color': null,
			'width': null,
			'height': null,
			'automationPrice': null,
			'eur': null
		}

		/**
		 * Initialization
		 */
		function init(){
			setRTData('automationPrice', getAutomationPrice());
			setRTData('panel', getPanelPrice());
			setRTData('eur', $('#panels-module').data('eur'));

			//  Throw change event
			$(document).trigger('changeInputFiends');
		}

		/**
		 * Select panel
		 */
		$('#panels-module .selectPanel').change(function(){
			var mainImage = getPanelImage();

			setMainImage(mainImage);

			var panelID = $(this).val();
			var request = getRequestObj({
				'panelID': panelID
			});

			//  Insert new panel colors
			updatePanles(request, function(response){
				//  Remove old panle colors
				removePanelStyles();
				//  Update automation price
				setRTData('panel', getPanelPrice());
				setRTData('color', getPanelColorPrice());

				addPanelColors(response.data);

				//  Throw change event
				$(document).trigger('changeInputFiends');
			});
		});

		/**
		 * Select panel color
		 */
		$('#panels-module .selectColor').change(function(){
			var val = $(this).val();
			var selectedColor = $('#panels-module .selectColor option:selected');
			var mainImage;

			if(val == -1){
				mainImage = getPanelImage();
			} else {
				mainImage = selectedColor.data('image');
			}

			setMainImage(mainImage);
			setRTData('color', getPanelColorPrice());

			//  Throw change event
			$(document).trigger('changeInputFiends');
		});

		/**
		 * Update width var
		 */
		$('#panels-module .panelWidthParam').focusout(function(){
			var val = parseFloat($(this).val());

			setRTData('width', val);

			//  Throw change event
			$(document).trigger('changeInputFiends');
		});

		/**
		 * Update height var
		 */
		$('#panels-module .panelHeightParam').focusout(function(){
			var val = parseFloat($(this).val());

			setRTData('height', val);

			//  Throw change event
			$(document).trigger('changeInputFiends');
		});

		/**
		 * Update automation price toggle
		 */
		$('#panels-module .radiobox input[type="radio"]').change(function(){
			var val = $(this).data('price');

			setRTData('automationPrice', val);

			//  Throw change event
			$(document).trigger('changeInputFiends');
		});

		/**
		 * Calculate total price
		 *
		 * Sп*Ц(цвет)+ Sс*Ц(тип)+Ц(автом)

		 Sп – площадь по пользовательским размерам (ширина*высота)
		 Sс – площадь по стандартной сетке размеров (ширина*высота)
		 Ц(цвет) – цена по цвету панели за кв. метр
		 Ц(тип) – цена по типу панели за кв. метр
		 Ц(автом) – цена за автоматику

		 */
		$(document).on('changeInputFiends', function(){
			if(getRTData('width') == null || getRTData('height') == null){
				return;
			}

			var price = getTotalPrice();

			$('#panels-module .price').text(price + "грн.");
		});

		//	Save pdf
		$('#panels-module .mod_btn.save').click(function() {
			createPdf();
		});

		function getTotalPrice() {
			var price = 0;
			console.log(currData);

			var userSqueare = getRTData('width') * getRTData('height');

			price += userSqueare*getRTData('panel');

			console.log(getRTData('automationPrice'));
			price += getRTData('automationPrice');

			if(getRTData('color') != null){
				price += userSqueare*getRTData('color');
			}

			price = getPrice(price);

			return price;
		}

		/**
		 * Create and return request object
		 *
		 * User data in "data" parameter
		 *
		 * @param data
		 * @returns {{option: string, module: string, format: string, data: *}}
		 */
		function getRequestObj(data){
			return {
				'do': 'getPanels',
				'option': 'com_ajax', // Используем AJAX интерфейс
				'module': 'panels', // Название модуля без mod_
				'format': 'json', // Формат возвращаемых данных
				'panelID': data.panelID
			};
		}

		/**
		 * Update panels
		 *
		 * Update images and prices after select new panel type
		 *
		 * @param request - request object
		 * @param callback - callback(response)
		 */
		function updatePanles(request, callback){
			$.ajax({
				type: 'POST',
				data: request,
				success: function(response){
					if(response.success == false){
						console.error('Module Panels - Ajax Error');

						return;
					}

					callback(response);
				}
			});
		}

		function createPdf(){
			var data = {
				panelName: $('#panels-module .selectPanel option:selected').text().trim(),
				colorName: $('#panels-module .selectColor option:selected').text().trim(),
				width: getRTData('width'),
				height: getRTData('height'),
				price: getTotalPrice()
			}

			var str = jQuery.param( data );
			console.log(encodeURI(str));

			var url = 'http://'+ window.location.host +'/modules/mod_panels/craete_pdf.php?' + encodeURI(str);
			var win = window.open(url, '_blank');
			win.focus();
		}

		/**
		 * Get panel image
		 *
		 * @returns {*} - image src
		 */
		function getPanelImage(){
			var selected = $('#panels-module .selectPanel option:selected');

			return selected.data('image');
		}

		/**
		 * Set main image
		 *
		 * @param image - image src
		 */
		function setMainImage(image){
			$('#panels-module .mainImage').attr('src', image);
		}

		/**
		 * Remove panel colors
		 */
		function removePanelStyles(){
			$('#panels-module .panelStyle').remove();
		}

		/**
		 * Add colors to drop-down list and to view box container
		 *
		 * @param list - response array
		 */
		function addPanelColors(list){
			for(var key in list){
				var item = list[key];

				addPanelColor(item.id, item.color, item.image, item.price);
			}
		}

		/**
		 * Add color to drop-down list adn to view box container
		 *
		 * @param value - value of option
		 * @param text - text color
		 * @param image - image src
		 * @param price - color price
		 */
		function addPanelColor(value, text, image, price){
				//  Add option item
			var html = $("<option class='panelStyle' value='"+ value +"' data-image='"+ image +"' data-price='"+ price +"'" +
				">"+ text +"</option>");

			$('#panels-module .selectColor').append(html);

				//  Add view box item
			html = $("" +
				"<div class='row col-md-6 listItem panelStyle' style='margin-top: 20px;'>" +
					"<div class=''>" +
						"<img src='"+ image +"' width='80'>" +
						"<p>"+ text +"</p>" +
					"</div>" +
				"</div>");
			
			$('#panels-module .selectColor-viewBox').append(html);
		}

		/**
		 * Get automation price
		 *
		 * @returns {*}
		 */
		function getAutomationPrice(){
			var price = $('#panels-module .radiobox input[name="radiobutton"]:checked');
			
			return price.data('price');
		}

		/**
		 * Get panel price
		 *
		 * @returns {*}
		 */
		function getPanelPrice(){
			var price = $('#panels-module .selectPanel option:selected');

			return price.data('price');
		}

		/**
		 * Get panel color price
		 *
		 * @returns {*}
		 */
		function getPanelColorPrice(){
			var price = $('#panels-module .selectColor option:selected');

			return price.data('price');
		}

		/**
		 * Get UAN price
		 * @param price
		 * @returns {number}
		 */
		function getPrice(price) {
			return price*getRTData('eur');
		}

		/**
		 * Get runtime data
		 *
		 * @param name - item name
		 * @param defaultVal - default value
		 */
		function getRTData(name, defaultVal){
			defaultVal = defaultVal || null;

			if(!(name in currData)){
				return defaultVal;
			}

			return currData[name];
		}

		/**
		 * Set/Add runtime data
		 *
		 * @param name - key
		 * @param val - mix
		 */
		function setRTData(name, val){
			currData[name] = val;
		}

		init();
	});
})(jQuery);