jQuery(document).ready(function($){
		//	Сохраненные данные
	var savedData = $('.bairroAccordionContent_Container .jform_listcontent').val();
	
		//	Save Accordion
	$('#saveAccordion').mousedown(function(e){
		console.log($(this).parent().parent().find('.hiddenData > input.jform_listcontent')[0]);
		$(this).parent().parent().find('.hiddenData > input.jform_listcontent').val($.toJSON(getData()));
		/*
		$.ajax({
			type: "POST",
			url: "/modules/mod_wichlacz/assets/fields/php/saveAccordion.php",
			data: {
				accordion: $.toJSON(getData())
			},
			success: function(msg){
				alert(msg);
			}
		});
		*/
	});
	
	function getData(){
		var data = [];
		
			//	Put data to arr
		$(".bairroAccordionContent_Item:not(:first-child) > .bairroAccordionContent_ItemWrap").each(function(i, entity){
			data[i] = {};
			data[i].title = $(entity).find("> div:nth-child(2) > .bairroAccordionContent_title:first > input:nth-child(2)").val();
			data[i].title_name = $(entity).find("> div:nth-child(2) > .bairroAccordionContent_title:first > input:nth-child(4)").val();
			
			data[i].data = [];
			
			$(entity).find("> div:last > .bairroAccordionContent_InnerItem:not(:first-child)").each(function(n, nEntity){
				var root = $(nEntity).find(".bairroAccordionContent_field");
				var tmpData = {};
				
				tmpData.text = root.find("> div:nth-child(1) > input").val();
				tmpData.value = root.find("> div:nth-child(2) > input").val();
				
				data[i].data[n] = tmpData;
			});
		});
		
		return data;
	}
	
		//	Add new item
	jQuery('#addNewItem').mousedown(function(e){
		var tmp = $('.bairroAccordionContent_ItemContainer > div.bairroAccordionContent_Item:first')
			.first().clone();
		$(tmp).css({
			'display': 'block'
		});
		$(tmp).find(">.bairroAccordionContent_ItemWrap .bairroAccordionContent_expandRoll_up > a:first-child").first().mousedown(expandRollUpItem);
		$(tmp).find("> .bairroAccordionContent_ItemWrap .bairroAccordionContent_draDropHand").first().mousedown(dragDropHand);
		$(tmp).find('.bairroAccordionContent_ItemWrap > .bairroAccordionContent_toolbar > .addNewInnerItem').mousedown(addNewInnerItem);
		$(tmp).find('.bairroAccordionContent_ItemWrap > .bairroAccordionContent_toolbar > .removeItem').mousedown(removeInnerItem);
		$(tmp).appendTo($('.bairroAccordionContent_ItemContainer').first());
	});
	
	$('.bairroAccordionContent_ItemContainer > div.bairroAccordionContent_Item').each(function(i, tmp){
		$(tmp).find(">.bairroAccordionContent_ItemWrap .bairroAccordionContent_expandRoll_up > a:first-child").first().mousedown(expandRollUpItem);
		$(tmp).find("> .bairroAccordionContent_ItemWrap .bairroAccordionContent_draDropHand").first().mousedown(dragDropHand);
		$(tmp).find('.bairroAccordionContent_ItemWrap > .bairroAccordionContent_toolbar > .addNewInnerItem').mousedown(addNewInnerItem);
		$(tmp).find('.bairroAccordionContent_ItemWrap > .bairroAccordionContent_toolbar > .removeItem').mousedown(removeInnerItem);
	});
	
	$('.bairroAccordionContent_ItemContainer > div.bairroAccordionContent_Item > .bairroAccordionContent_ItemWrap .bairroAccordionContent_InnerItem').each(function(e, tmp){
		$(tmp).find(".bairroAccordionContent_draDropHand").first().mousedown(dragDropHand);
		$(tmp).find(".deleteInnerItem").first().mousedown(removeInnerItem);
	});
	
		//	Add new inner item
	function addNewInnerItem(e){
		var tmp = $('.bairroAccordionContent_ItemContainer > div.bairroAccordionContent_Item:first > .bairroAccordionContent_ItemWrap .bairroAccordionContent_InnerItem')
			.first().clone();
		$(tmp).css({
			'display': 'flex'
		});
		
		var to = $(e.target).parent().parent().find("> div:nth-child(3)");
		$(tmp).find(".bairroAccordionContent_draDropHand").first().mousedown(dragDropHand);
		$(tmp).find(".deleteInnerItem").first().mousedown(removeInnerItem);
		$(tmp).appendTo(to);
	};
	
	function dragDropHand(e){
		var target = $(e.target).parentsUntil(".bairroAccordionContent_commonParentClass");
		
		if(target.length == 0) 
			target = $(e.target).parent();
		else
			target	= $(target[$(e.target).parentsUntil(".bairroAccordionContent_commonParentClass").length-1]).parent();
		
		$(target).draggable();
		$(target).css({
			'z-index': '9999'
		});
		
		$(target).mouseup(function(e){
			var parent = $(target).parent();
			var targetIndex = $(target).index();
			var insertTop = false;
			var h = $(target).outerHeight(true);
			var offsetTop = null;
			
			if($(target).css("top") != "auto")
				offsetTop = parseInt($(target).css("top").match(/-?\d*/)[0]);
			
			if(offsetTop < 0)
				insertTop = true;
			
			var itemPos = parseInt(($(target).index()-1)*h+offsetTop);
			
			if(itemPos < 0) itemPos = 0;
			
				//	Remove draggable
			$(target).attr('aria-disabled', false);
			$(target).css({
				'position': 'initial',
				'top': '0px',
				'left': '0px',
				'opacity': '1',
				'z-index': '0'
			});
			$(target).draggable({ disabled: true });
			$(target).draggable("destroy");
			
			if(Math.abs(offsetTop) <= h){
				console.log("ret");
				return;
			}
			
			itemPos = Math.ceil(itemPos/h);
			var dump = target.clone();
			target.detach();
			
			if(insertTop == true){
				if(itemPos <= 0){
					$(target).insertAfter($(parent).children().first());
				}else{
					target.insertAfter($(parent).children().eq(itemPos));
				}
			}else{
				var btnMax = offsetTop >= (($(parent).children().length-1)*h);
				if(offsetTop >= btnMax && targetIndex != $(parent).length){
					$(target).appendTo($(parent));
				}else{
					target.insertAfter($(parent).children().eq(itemPos-1));
				}
				
				if(offsetTop >= btnMax && $(target).index() == $(parent).length){
					$(target).appendTo($(parent));
				}
				
			}
			//$(target).mousedown(dragDropHand);
		});
		
		$(target).css({
			'position': 'relative'
		});
	};
		
		//	Remove (inner) item
	function removeInnerItem(e){
		var target = $(e.target).parentsUntil(".bairroAccordionContent_commonParentClass");
		target = $(target[target.length-1]).parent();
		target.remove();
	}
	
	function expandRollUpItem(e){
		console.log("roll");
		$(e.target).toggleClass("expandRollUpItemActive");
		
		if($(e.target).hasClass("expandRollUpItemActive")){
			$(e.target).html("+");
			console.log($(e.target).parent().parent().next()[0]);
			$(e.target).parent().parent().next().css({
				'display': 'none'
			});
		}else{
			$(e.target).html("-");
		
			$(e.target).parent().parent().next().css({
				'display': 'block'
			});
		}
	}
}(jQuery));