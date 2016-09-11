<?php
	defined('_JEXEC') or die();

	class PanelsTablePanel extends JTable{
		public function __construct(&$db){
			parent::__construct('#__panels_panels', 'id', $db);
		}
	}
?>