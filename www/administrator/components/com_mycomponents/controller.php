<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php
// ������ � ������� �������. ���� ��� �� ���������� ���������� � ����� ��������, joomla ������ ������ ��������.
defined('_JEXEC') or die;
 
/**
 * ������� ���������� ���������� mycomponent. ������ ���������� ������� �� ����� controllers ���� mycomponents �� �� � ������� �� ��������� ������ ���.
 */
class MycomponentsController extends JControllerLegacy
{

//����������� ������� �����������, ���������� ��� ���
	public function display($cachable = false, $urlparams = false)
	{
	
//���������� ����� ������ � ������� ���������, /helpers/priceleafs.php
//��� �� ������������ ��� ������������ �� ��������� ����������, �� ���� ����� ���������� 
//� ����� helpers.
		require_once JPATH_COMPONENT.'/helpers/mycomponents.php';

		$view   = $this->input->get('view', 'mycomponents');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// �������� ����� ��������������
		if ($view == 'mycomponent' && $layout == 'edit' && !$this->checkEditId('com_mycomponents.edit.mycomponent', $id)) {
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_mycomponents&view=mycomponents', false));

			return false;
		}
// ���������� �������������
		parent::display();
//������� ��������
		return $this;
	}
}