(function($){
	var selectedMenuItem = {
		menuItem: null,
		itemId: null,
		itemName: null,
		menuId: null
	};
	var returnedMenuItem = {
		menuItem: null,
		itemId: null,
		itemName: null,
		menuId: null
	};
	
	function in_array(need, arr){
		for(var item in arr){
			if(need == arr[item]){
				return true;
			}
		}
		
		return false;
	}
	
		//	Получить данные о выбраном пункте меню
	$('.changeMenuItem_sourceColumn .changeMenuItem_menu > div:not(first-child)').mousedown(function(e){
		if($(this).hasClass('changeMenuItem_menuTitle')){
			return;
		}
		
		if(selectedMenuItem.menuItem != null){
			selectedMenuItem.menuItem.removeClass('changeMenuItem_selectedItem');
		}
		
		$(this).addClass('changeMenuItem_selectedItem');
		selectedMenuItem.menuItem 	= $(this);
		selectedMenuItem.itemId 	= $(this).data('id');
		selectedMenuItem.itemName 	= $(this).text();
		var parent 					= $(this).parent().find('.changeMenuItem_menuTitle').first();
		selectedMenuItem.menuId 	= parent.data('id');
		selectedMenuItem.menuName 	= parent.text();
	});
	
		//	Перенести в выбранные пункты меню
	$('.changeMenuItem_drag > div:first-child').click(function(e){
		if(selectedMenuItem.menuItem == null){
			console.log(selectedMenuItem.menuItem == null);
			return;
		}
		
		var parent = $(this).parentsUntil('.changeMenuItem');
		parent = $(parent[parent.length-1]).parent().find('.changeMenuItem_selectedColumn');
		
		var menu = parent.find('> .changeMenuItem_menu > .changeMenuItem_menuTitle[data-id="'+ selectedMenuItem.menuId +'"]')[0];
		if(menu == undefined){
			var html = '<div class="changeMenuItem_menu">';
			html	+= 		'<div class="changeMenuItem_menuTitle" data-id="'+ selectedMenuItem.menuId +'">'+ selectedMenuItem.menuName +'</div>';
			html	+= 		'<div class="changeMenuItem_menuItem" data-id="'+ selectedMenuItem.itemId +'">'+ selectedMenuItem.itemName +'</div>';
			html 	+= '</div>';
			
			parent.append(html);
			$(parent).find('> .changeMenuItem_menu .changeMenuItem_menuItem[data-id="'+selectedMenuItem.itemId+'"]').mousedown(selectItemSelectedColumn);
		}else{
			menu = $(menu).parent();
			
			if(menu.find('> div:not(:first-child)[data-id="'+ selectedMenuItem.itemId +'"]')[0] == undefined){
				var html = '<div class="changeMenuItem_menuItem" data-id="'+ selectedMenuItem.itemId +'">'+ selectedMenuItem.itemName +'</div>';
				menu.append(html);
			}
			
			$(parent).find('> .changeMenuItem_menu .changeMenuItem_menuItem[data-id="'+selectedMenuItem.itemId+'"]').mousedown(selectItemSelectedColumn);
		}
	});
	
	function selectItemSelectedColumn(e){
		if($(this).hasClass('changeMenuItem_menuTitle')){
			return;
		}
		
		if(returnedMenuItem.menuItem != null){
			returnedMenuItem.menuItem.removeClass('changeMenuItem_selectedItem');
		}
		
		$(this).addClass('changeMenuItem_selectedItem');
		returnedMenuItem.menuItem 	= $(this);
		returnedMenuItem.itemId 	= $(this).data('id');
		returnedMenuItem.itemName 	= $(this).text();
		var parent 					= $(this).parent().find('.changeMenuItem_menuTitle').first();
		returnedMenuItem.menuId 	= parent.data('id');
		returnedMenuItem.menuName 	= parent.text();
	};
	
		//	Удалить выбранные пункты меню
	$('.changeMenuItem_drag > div:last-child').click(function(e){
		if(returnedMenuItem.menuItem == null){
			return;
		}
		
		var parent = $(this).parentsUntil('.changeMenuItem');
		parent = $(parent[parent.length-1]).parent().find('.changeMenuItem_selectedColumn');
		var removedItem = parent.find('> .changeMenuItem_menu .changeMenuItem_menuItem[data-id="'+returnedMenuItem.itemId+'"]');
		var parentRemovedItem = removedItem.parent();
		removedItem.remove();
		
		if(parentRemovedItem.find('.changeMenuItem_menuItem').length == 0){
			parentRemovedItem.remove();
		}
	});
	
		//	Сохранить
	$('.changeMenuItem .changeMenuItem_toolbar > .btn-success').click(function(e){
		var root = $(this).parent().parent();
		
		var json = {};
		var menuItemsArr = [];
		var medaData = {};
		
			//	Собрать выбранные пункты
			//	Пункты
		var menuItems = '';
			
		root.find('.changeMenuItem_selectedColumn .changeMenuItem_menuItem').each(function(i, entity){
			menuItems += $(entity).data('id') + ',';
		});
		
		menuItems = menuItems.substr(0, menuItems.length-1);
		
			//	title
		var data = root.find('.changeMenuItem_data');
		
		medaData.title = data.find('input[name="changeMenuItem_titleSuffix"]').val();
		medaData.description = data.find('input[name="changeMenuItem_description"]').val();
		medaData.keywords = data.find('input[name="changeMenuItem_keywords"]').val();
		
		json.menuItems = menuItems;
		json.metaData = medaData;
		
		$(this).parent().parent().find('.value').val($.toJSON(json));
	});
	
		//	Заполняем форму
	$('.changeMenuItem').each(function(i, entity){
		var data = $.parseJSON($(entity).find('.changeMenuItem_data .value').val());
		var arr = data['menuItems'].split(',');
		var btnDragToSelected = $(entity).find('.changeMenuItem_drag > div:first-child'); 
		console.log($(entity)[0]);
		$(this).find('.changeMenuItem_sourceColumn .changeMenuItem_menuItem').each(function(i, entity){
			if(in_array($(entity).data('id'), arr) == true){
				$(entity).triggerHandler('mousedown');
				$(btnDragToSelected).triggerHandler('click');
			}
		});
	});
	
	$('.changeMenuItem_menuItem').removeClass('changeMenuItem_selectedItem');
})(jQuery);