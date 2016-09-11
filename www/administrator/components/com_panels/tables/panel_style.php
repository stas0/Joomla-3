<?php
	defined('_JEXEC') or die();

	class PanelsTablePanel_style extends JTable{
		public function __construct(&$db){
			parent::__construct('#__panel_styles', 'id', $db);
		}
	}
?>