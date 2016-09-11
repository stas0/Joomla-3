<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php
// ������ � ������� �������. ���� ��� �� ���������� ���������� � ����� ��������, joomla ������ ������ ��������.
defined('_JEXEC') or die;
 
/**
 * ��� ����������
 */
class MycomponentsViewMycomponents extends JViewLegacy
{
	
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * ����������� ������
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		print_r($this->items);
		MycomponentsHelper::addSubmenu('mycomponents');

		// ��������� �� ������� ������.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
//���������� ���������
		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * �������� ��������� �������� � ������ ������������.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
//����� ���������	
		require_once JPATH_COMPONENT.'/helpers/mycomponents.php';

//������� ����������		
		$state	= $this->get('State');
		$canDo	= MycomponentsHelper::getActions($state->get('filter.category_id'));
		$user	= JFactory::getUser();
		// �������� ��������� ������� ������ ������������
		$bar = JToolBar::getInstance('toolbar');

//����� ������ ������������, ��������, �������, ������������, ����� � ����������		
		JToolbarHelper::title(JText::_('COM_MYCOMPONENT'), 'mycomponents.png');
		if ($canDo->get('core.create')) {
			JToolbarHelper::addNew('mycomponent.add');
		}
		if ($canDo->get('core.edit')) {
			JToolbarHelper::editList('mycomponent.edit');
		}
		
			JToolbarHelper::publish('mycomponents.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('mycomponents.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		

			JToolbarHelper::deleteList('', 'mycomponents.delete');



		JHtmlSidebar::setAction('index.php?option=com_mycomponents&view=mycomponents');

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_state',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);
	}

	/**
	 * ���������� ������ ����� ������� ����� �����������
	 *
	 * ����������� �������, ���������� ��� ���� ��� ���������� � �������� ����� � ����� �� ������� � �������� ��������
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.state' => JText::_('JSTATUS'),
			'a.name' => JText::_('JGLOBAL_TITLE'),
			'a.adres' => JText::_('JGLOBAL_TITLE'),			
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}