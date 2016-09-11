(function($){
	$(document).ready(function(e){
		$('.productFilterItem a').click(function(e){
			var filterQ = '';
			
			$('.productFilterItem.selectedFilter').each(function(i, entity){
				filterQ += $(entity).find('a').data('filter') + ',';
			});
			filterQ = filterQ.substr(0, filterQ.length-1);

			var url = '';

			if(filterQ != ''){
				url = setURLParameter('filters', filterQ);
			}else{
				url = removeURLParameter('filters');
			}
			
			url = removeURLParameter('page', url);

			window.location = url;
		});

		$('#resetFilters').click(function(e){
			var url = removeURLParameter('page');
			url = removeURLParameter('filters', url);
			window.location = url;
		});

		function getURLParameter(name, url) {
		    if (!url) url = window.location.href;
		    name = name.replace(/[\[\]]/g, "\\$&");
		    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		        results = regex.exec(url);
		    if (!results) return null;
		    if (!results[2]) return '';
		    return decodeURIComponent(results[2].replace(/\+/g, " "));
		}

		function setURLParameter(name,value){
			var search;
			if(getURLParameter(name) != null){
				search =location.search.replace(new RegExp('([?|&]'+name + '=)' + '(.+?)(&|$)'),"$1"+encodeURIComponent(value)+"$3");
				console.log(getURLParameter(name)); 
			}else if(location.search.length){
				search = location.search +'&'+name + '=' +encodeURIComponent(value);
			}else{
				search = '?'+name + '=' +encodeURIComponent(value);
			}
			
			return search;
		}

		function removeURLParameter(parameter, url) {
			if (!url) url = window.location.href;

		    //prefer to use l.search if you have a location/link object
		    var urlparts= url.split('?');   
		    if (urlparts.length>=2) {

		        var prefix= encodeURIComponent(parameter)+'=';
		        var pars= urlparts[1].split(/[&;]/g);

		        //reverse iteration as may be destructive
		        for (var i= pars.length; i-- > 0;) {    
		            //idiom for string.startsWith
		            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
		                pars.splice(i, 1);
		            }
		        }

		        url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
		        return url;
		    } else {
		        return url;
		    }
		}
	});
})(jQuery);