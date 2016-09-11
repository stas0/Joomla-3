<?php
/* 
Модель компонента. Здесь делается запрос в бд, 
и выбирается что нужно вытащить, все данные из
таблицы или только какието конкретные.
MycomponentModelMycomponent
название файла модели после Model, при создании
ещё одной страницы создаётся опять новая модель
к примеру catid тогда class модели будет 
MycomponentModelCatid ну и соответственно другой запрос в другую
таблицу и другие переменные.
И на заметку что loadObjectlist это то как будут выводиться данные
в цикле или нет так как с loadResult вы не выведите цикл, он предназначен только
для одной строки.
*/

//Защита от прямого обращения к скрипту
defined('_JEXEC') or die;


//Название класса модели и название файла
class MycomponentsModelMycomponents extends JModelLegacy
{
//Функция её мы будем выводит в виде.
function getMycomponent()
	{
	//Подключение к бд joomla
	$db = $this->getDbo();
	
	//Выбираем из какой таблицы будем вытаскивать данные ORDER BY ordering это порядок отображения данных этим займёмся в админ панеле.
	$query = 'SELECT * FROM #__mycomponent ORDER BY ordering';
	$db->setQuery($query);
	$row = $db->loadObjectlist();
//вернуть row	
return $row;	
	
	}
	
}
?>