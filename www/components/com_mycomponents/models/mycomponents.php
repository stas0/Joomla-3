<?php
/* 
������ ����������. ����� �������� ������ � ��, 
� ���������� ��� ����� ��������, ��� ������ ��
������� ��� ������ ������� ����������.
MycomponentModelMycomponent
�������� ����� ������ ����� Model, ��� ��������
��� ����� �������� �������� ����� ����� ������
� ������� catid ����� class ������ ����� 
MycomponentModelCatid �� � �������������� ������ ������ � ������
������� � ������ ����������.
� �� ������� ��� loadObjectlist ��� �� ��� ����� ���������� ������
� ����� ��� ��� ��� ��� � loadResult �� �� �������� ����, �� ������������ ������
��� ����� ������.
*/

//������ �� ������� ��������� � �������
defined('_JEXEC') or die;


//�������� ������ ������ � �������� �����
class MycomponentsModelMycomponents extends JModelLegacy
{
//������� � �� ����� ������� � ����.
function getMycomponent()
	{
	//����������� � �� joomla
	$db = $this->getDbo();
	
	//�������� �� ����� ������� ����� ����������� ������ ORDER BY ordering ��� ������� ����������� ������ ���� ������� � ����� ������.
	$query = 'SELECT * FROM #__mycomponent ORDER BY ordering';
	$db->setQuery($query);
	$row = $db->loadObjectlist();
//������� row	
return $row;	
	
	}
	
}
?>