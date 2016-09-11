<?php
/*
Вид это промежуточный этап между моделью и шаблоном.
Так как мы используем loadObjectlist то мы указываем 
одну функцию. Если будет другой вид скажем loadResult
то прийдётся указывать каждую функцию отдельно и в 
моделе для каждой строки которая нам нужна создавать 
новый запрос в бд а модель будет одна для всех 
$model = $this->getModel();.
*/

//Защита от прямого обращения к скрипту
defined('_JEXEC') or die;

class MycomponentsViewMycomponents extends JViewLegacy
{
//Функция которая выводит данные из модели. function getMycomponent() это функция модели, а тут мы извлекаем её $rows = $model->getMycomponent();
function display ($tpl = null)
	{
	$model = $this->getModel();
	$rows = $model->getMycomponent();
	$this->assignRef('rows',$rows);
	
parent::display($tp1);
	}


}

?>