<?php
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
 
class JFormFieldFilters extends JFormField{
 
	protected $type = 'filters';
 
	public function getInput() {
        $fieldData = $this->form->getData()->get($this->getAttribute('name'));
        $fieldData = json_decode($fieldData);

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, filter_title')->from('`#__productfilter_filters` AS a');
        $rows = $db->setQuery($query)->loadObjectlist();

        foreach($rows as $row){
            $filters[] = array(
                'value' => $row->id,
                'text' => $row->filter_title
            );
        }
        // Merge any additional options in the XML definition.
        $options = JHTML::_('select.genericlist', $filters, $this->name, 'multiple="multiple" size="10"', 'value', 'text', $fieldData);

        return $options;
	}
}