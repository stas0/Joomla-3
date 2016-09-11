<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;

/**
 * Класс помощи.
 */
class MycomponentsHelper
{
	/**
	 * Установка панели ссылок.
	 */
	public static function addSubmenu($vName = 'mycomponents')
	{
		JHtmlSidebar::addEntry(JText::_('COM_MYCOMPONENT_RAZDEL'), 'index.php?option=com_mycomponents&view=mycomponents', $vName == 'mycomponents');
	}
	
	/**
	 * Получение действий
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
