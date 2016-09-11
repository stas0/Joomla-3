<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
/*Это точка входа в компонент, отсюда начинается старт, и запускается всё остальное, а именно контроллер который в дальнейшем вызывает модель, вид, и шаблон.*/


//Запрет прямого доступа к файлу/странице
defined('_JEXEC') or die;

//Проверка доступа к компоненту, авторизован пользователь или нет
if (!JFactory::getUser()->authorise('core.manage', 'com_mycomponents'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//Получить экземпляр контроллер с префиксом
$controller	= JControllerLegacy::getInstance('Mycomponents');

//Выполнение задачи task
$controller->execute(JFactory::getApplication()->input->get('task'));

//Редирект контроллера, если установленно контроллером
$controller->redirect();