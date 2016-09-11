<?php
	defined('_JEXEC') or die();
	
	class WichlaczModelWichlacz extends JModelLegacy{
		function getWichlacz(){
			$db = $this->getDbo();
			
			$query = "select * from #__wichlacz";
			$db->setQuery($query);
			
			return $db->loadObectlist();
		}
	}
?>