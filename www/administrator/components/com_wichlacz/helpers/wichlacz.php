<?php
	defined('_JEXEC') or die();
	
	class WichlaczHelper extends JHelperContent{
		public static function addSubmenu($viewName){
			JHtmlSidebar::addEntry(
					JText::_('COM_WICHLACZ_SUMBMENU_BOILERS'),
					'index.php?option=com_wichlacz&view=wichlacz',
					$viewName == 'boilers'
				);
		}
		
		public static function getActions($messageId = 0){
			$user	= JFactory::getUser();
			$result	= new JObject;

			if (empty($messageId)) {
				$assetName = 'com_wichlacz';
			}
			else {
				$assetName = 'com_wichlacz.message.'.(int) $messageId;
			}

			$actions = array(
				'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
			);

			foreach ($actions as $action) {
				$result->set($action,	$user->authorise($action, $assetName));
			}

			return $result;
		}
	}
?>