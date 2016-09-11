<?php
	defined('_JEXEC') or die();

	class HelperFields{
		public static function toJson(&$dataArr, $fields){
			foreach ($fields as $key => $value) {
				if(array_key_exists($value, $dataArr)){
					$dataArr[$value] = json_encode($dataArr[$value]);
				}
			}
		}
	}
?>