<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php
// ������ � ������� �������. ���� ��� �� ���������� ���������� � ����� ��������, joomla ������ ������ ��������.
defined('_JEXEC') or die;
 
/**
 * ����� ������������
 */
class MycomponentsControllerMycomponent extends JControllerForm
{


//����� ���������������, ��� �� ��������� ����� �� �������� ����� ������.
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// ���������� ������ Mycomponent
		$model = $this->getModel('Mycomponent', '', array());

		// ����������������� �������������
		$this->setRedirect(JRoute::_('index.php?option=com_mycomponents&view=mycomponents' . $this->getRedirectToListAppend(), false));

		return parent::batch($model);
	}
}