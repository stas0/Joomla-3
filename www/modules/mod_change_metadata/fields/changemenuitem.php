<?php
defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

class JFormFieldChangeMenuItem extends JFormField{
	protected $type = 'changeMenuItem';
	private $modName = 'mod_change_metadata';
	private $lang = array(
		'save' 			=> 'Сохранить',
		'title' 		=> 'Title',
		'description' 	=> 'Description',
		'keywords' 		=> 'Keywords'
	);
	
	public function getLabel(){
		return str_replace($this->id, $this->id . '_id', parent::getLabel());
	}
	
	public function getInput(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName('menutype') . ', ' . $db->quoteName('id'));
		$query->from($db->quoteName('#__menu_types'));
		$db->setQuery($query);
		$menusRes = $db->loadObjectList();
		$menus = array();
		
		foreach($menusRes as $menu){
			$query = $db->getQuery(true);
			$query->select($db->quoteName('title') . ', ' . $db->quoteName('id'));
			$query->from($db->quoteName('#__menu'));
			$query->where($db->quoteName('menutype') . ' = ' . $db->quote($menu->menutype));
			$db->setQuery($query);
			
			$menuItems = $db->loadObjectList();
			
			$menus[] = array(
				'menuTitle' => $menu->menutype,
				'menuId'	=> $menu->id,
				'menuItems' => $menuItems
			);
		}
		
		$doc = JFactory::getDocument();
		$doc->addStyleSheet('/modules/'.$this->modName.'/assets/fields/css/changeMenuItem.css');
		
		$data = (array)json_decode($this->value);
		if(!empty($data)){
			$this->updataMenuItems($data);
		}
		
		$html .= '<div class="changeMenuItem">';
		$html .= 	'<div class="changeMenuItem_data">';
		$html .=		'<input type="text" name="'. $this->name .'" value=\''. $this->value .'\' class="value">';
		$html .=		'<label>'. $this->lang['title'] .'</label><input type="text" name="changeMenuItem_titleSuffix" value=\''. $data['metaData']->title .'\'>';
		$html .=		'<label>'. $this->lang['description'] .'</label><input type="text" name="changeMenuItem_description" value=\''. $data['metaData']->description .'\'>';
		$html .=		'<label>'. $this->lang['keywords'] .'</label><input type="text" name="changeMenuItem_keywords" value=\''. $data['metaData']->keywords .'\'>';
		$html .=	'</div>';
		$html .= 	'<div class="changeMenuItem_toolbar">
						<div class="btn btn-small btn-success">'. $this->lang['save'] .'</div>';
		$html .= 	'</div>';
		$html .= '
					<div class="changeMenuItem_sourceColumn changeMenuItem_column">';
						foreach($menus as $menu){
							$html .= '<div class="changeMenuItem_menu">';
							$html .= '<div class="changeMenuItem_menuTitle" data-id="'. $menu['menuId'] .'">' . $menu['menuTitle'] . '</div>';
							
							foreach($menu['menuItems'] as $menuItem){
								$html .= '<div class="changeMenuItem_menuItem" data-id="'. $menuItem->id .'">' . $menuItem->title . '</div>';
							}
							
							$html .= '</div>';
						}
		$html .= '	</div>
					<div class="changeMenuItem_drag changeMenuItem_column">
						<div>→</div>
						<div>←</div>
					</div>
					<div class="changeMenuItem_selectedColumn changeMenuItem_column">
					</div>
				</div>';
		$html .= '
			<script src="/modules/'.$this->modName.'/assets/fields/js/changeMenuItem.js"></script>
			<script src="/modules/'.$this->modName.'/assets/js/json.js"></script>';
					
		return $html;
		
	}
	
	private function updataMenuItems($data){
		$menuItems = explode(',', $data['menuItems']);
		$db = JFactory::getDbo();
		
		foreach($menuItems as $menuItem){
			$query = $db->getQuery(true);
			$db->setQuery("select `params` from #__menu where id = " . $menuItem);
			$params = (array)json_decode($db->loadResult());
			
			echo '<pre>';
			print_r($params);
			echo '</pre>';
			
			
			$params['menu-meta_description'] = $data['metaData']->description;
			$params['menu-meta_keywords'] = $data['metaData']->keywords;
			
			//echo $this->unicode_decode(json_encode($params));
			
			$db->setQuery("SET NAMES utf8");
			$db->execute();
			$query = $db->getQuery(true);
			$db->setQuery("update #__menu set params='". $this->unicode_decode(json_encode($params)) ."' where id = " . $menuItem);
			$db->execute();
		}
	}
	
	public static function replace_unicode_escape_sequence($match) {
		return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
	}
	
	public static function unicode_decode($str){
		return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', array('JFormFieldChangeMenuItem', 'replace_unicode_escape_sequence'), $str);
	}
}
?>