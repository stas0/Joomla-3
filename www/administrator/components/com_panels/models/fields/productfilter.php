<?php
	defined('_JEXEC') or die();

	JFormHelper::loadFieldClass('list');

	class JFormFieldProductFilter extends JFormFieldList{
		protected $type = 'productfilter';

		protected function getOptions(){
			$optionsItems = array(
				array(
					'id' => 1,
					'text' => 'Big text'
				),
				array(
					'id' => 2,
					'text' => 'Small text'
				)
			);
			
			foreach ($optionsItems as $key => $value) {
				$options[] = JHtml::_('select.option', $value['id'], $value['text']);
			}

			$options = array_merge(parent::getOptions(), $options);

			return $options;
		}
	}
?>