<?php
	defined('_JEXEC') or die();

	class ProductFilterModelProductFilter extends JModelItem{
		protected $message;

		public function getTable($type = 'ProductFilterData', $prefix = 'ProductFilterTable', $config = array()){
			return JTable::getInstance($type, $prefix, $config);
		}

		public function getPorductList(){
			$table = $this->getTable();
			$input = JFactory::getApplication()->input;

			$page = intval((($input->get('page')) ? $input->get('page') : 0));
			$filters = (($input->get('filters')) ? $input->get('filters') : '');
			
			if($filters != ''){
				$filters = explode(',', $filters);
			}

			if(isset($_GET['filters'])){
				$filtersQ = $_GET['filters'];
				$products = $table->getListProducts($filtersQ, $page);
			}else{
				$products = $table->getListProducts('', $page);
			}

			return $products;
		}

		public function getPorductPagination(){
			$table = $this->getTable();
			$input = JFactory::getApplication()->input;

			$page = intval((($input->get('page')) ? $input->get('page') : 0));
			$filters = (($input->get('filters')) ? $input->get('filters') : '');
			
			if($filters != ''){
				$filters = explode(',', $filters);
			}

			if(isset($_GET['filters'])){
				$filtersQ = $_GET['filters'];
				$pagination = $table->getProductPagination($filtersQ);
			}else{
				$pagination = $table->getProductPagination('');
			}
			
			$url = $_SERVER['REQUEST_URI'];
			$urlParts = parse_url($url);
			parse_str($urlParts['query'], $params);

			$paginations = array();
			for ($i=0; $i < $pagination; $i++) { 
				$params['page'] = $i;

				$arr = array(
					'url' => $urlParts['path'] . '?' . http_build_query($params),
					'page' => $i
				);

				$paginations[] = $arr;
			}
			
			return array(
				'count'	=> $pagination,
				'currPage' => $page,
				'paginations' => $paginations
			);
		}

		public function getListFilters(){
			$table = $this->getTable();
			
			if(isset($_GET['filters'])){
				$filters = (array)$table->getListFilters($_GET['filters']);
			}else{
				$filters = (array)$table->getListFilters();
			}
			
			return $filters;
		}
	}
?>