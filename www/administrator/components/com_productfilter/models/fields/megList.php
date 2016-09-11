<?php
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
 
class JFormFieldMegList extends JFormField{
 	protected $type = 'MegList';

 	public function getInput() {
 		$sql = $this->getAttribute('query');

 		if(is_null($sql)){
 			return 'Field type megList need sql query!';
 		}

 		$keyField = $this->getAttribute('key_field', 'id');
 		$valueField = $this->getAttribute('value_field', 'title');
 		
 		$selected = json_decode($this->value);
 		$html = '';
 		$document = JFactory::getDocument();
 		$db = JFactory::getDbo();
 		$db->setQuery($sql);
 		$list = $db->loadObjectlist();
 		$list = JHTML::_('select.genericlist', $list, $this->name, 'multiple="true" size="10"', $keyField, $valueField, $selected);

 		return $list;
 	}
}