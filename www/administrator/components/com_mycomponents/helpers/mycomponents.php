<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php
// ������ � ������� �������. ���� ��� �� ���������� ���������� � ����� ��������, joomla ������ ������ ��������.
defined('_JEXEC') or die;

/**
 * ����� ������.
 */
class MycomponentsHelper
{
	/**
	 * ��������� ������ ������.
	 */
	public static function addSubmenu($vName = 'mycomponents')
	{
		JHtmlSidebar::addEntry(JText::_('COM_MYCOMPONENT_RAZDEL'), 'index.php?option=com_mycomponents&view=mycomponents', $vName == 'mycomponents');
	}
	
	/**
	 * ��������� ��������
	 */
	public static function getActions($messageId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($messageId)) {
			$assetName = 'com_mycomponents';
		}
		else {
			$assetName = 'com_mycomponents.message.'.(int) $messageId;
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
