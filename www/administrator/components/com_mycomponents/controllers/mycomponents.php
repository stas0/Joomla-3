<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php

// ������ � ������� �������. ���� ��� �� ���������� ���������� � ����� ��������, joomla ������ ������ ��������.
defined('_JEXEC') or die;

/**
 * ����� �����������
 */
class MycomponentsControllerMycomponents extends JControllerAdmin
{
	/**
	 * ������ ��� getModel
	 */
	public function getModel($name = 'Mycomponent', $prefix = 'MycomponentsModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
	
//����� AJAX ��� �� ��������� ������������� ������.	
		public function saveOrderAjax()
	{

		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');

		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// �������� ������
		$model = $this->getModel();

		// ��������� �������
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// ������� ����������
		JFactory::getApplication()->close();
	}
	
}
