<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php
/*��� ����� ����� � ���������, ������ ���������� �����, � ����������� �� ���������, � ������ ���������� ������� � ���������� �������� ������, ���, � ������.*/


//������ ������� ������� � �����/��������
defined('_JEXEC') or die;

//�������� ������� � ����������, ����������� ������������ ��� ���
if (!JFactory::getUser()->authorise('core.manage', 'com_mycomponents'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//�������� ��������� ���������� � ���������
$controller	= JControllerLegacy::getInstance('Mycomponents');

//���������� ������ task
$controller->execute(JFactory::getApplication()->input->get('task'));

//�������� �����������, ���� ������������ ������������
$controller->redirect();