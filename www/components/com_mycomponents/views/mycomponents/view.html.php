<?php
/*
��� ��� ������������� ���� ����� ������� � ��������.
��� ��� �� ���������� loadObjectlist �� �� ��������� 
���� �������. ���� ����� ������ ��� ������ loadResult
�� �������� ��������� ������ ������� �������� � � 
������ ��� ������ ������ ������� ��� ����� ��������� 
����� ������ � �� � ������ ����� ���� ��� ���� 
$model = $this->getModel();.
*/

//������ �� ������� ��������� � �������
defined('_JEXEC') or die;

class MycomponentsViewMycomponents extends JViewLegacy
{
//������� ������� ������� ������ �� ������. function getMycomponent() ��� ������� ������, � ��� �� ��������� � $rows = $model->getMycomponent();
function display ($tpl = null)
	{
	$model = $this->getModel();
	$rows = $model->getMycomponent();
	$this->assignRef('rows',$rows);
	
parent::display($tp1);
	}


}

?>