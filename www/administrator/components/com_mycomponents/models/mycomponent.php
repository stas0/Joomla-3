<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php
// ������ � ������� �������. ���� ��� �� ���������� ���������� � ����� ��������, joomla ������ ������ ��������.
defined('_JEXEC') or die;
 
/**
 * Mycomponent Model
 */
class MycomponentsModelMycomponent extends JModelAdmin
{
/**
	 * Returns ���������� ������ �� ������.
	 *
	 * @param	type	��� ������� ��� �������� ����������
	 * @param	string	������� ��� ����� ������ �������.
	 * @param	array	������ ��� ������.
	 * @return	JTable	������� ���� ������
	 */
	 
	protected $text_prefix = 'COM_MYCOMPONENT';	 
	 
	 
//���������� ������ �� ������ �������, ��� ��� ��������.	 
	public function getTable($type = 'Mycomponent', $prefix = 'MycomponentsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * ����� ��������� ������
	 *
	 * @param	array	$data		������ ��� �����.
	 * @param	boolean	$loadData	����� ��� ���� ��� �� ��������� ���� ������(�� ���������).
	 * @return	mixed	������� ������ � ������ ��������� ����������.
	 */
	public function getForm($data = array(), $loadData = true) 
	{
		// �������� �����
		$form = $this->loadForm('com_mycomponents.mycomponent', 'mycomponent', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
	
	/**
	 * �����, ����� �������� ������, ������� ������ ���� �������� � �����.
	 *
	 * @return	mixed	������ �� �����.
	 */
	protected function loadFormData() 
	{
		// �������� ������ ��� ����� ������� ������ �����
		$data = JFactory::getApplication()->getUserState('com_mycomponents.edit.mycomponent.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
}