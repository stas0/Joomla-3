<?php
	defined('_JEXEC') or die();

	class ProductFilterModelProductFilter{
		private $table;
		private $categorieId = -1;

		public function __construct(){
			$this->table = new ProductFilterTableProductFilterData();
		}

		public function setCategorieId($id){
			$this->categorieId = $id;
			$this->table->setCategorieId($this->categorieId);
		}

		public function getPorductList(){
			$table = $this->table;
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
			$table = $this->table;
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
			$table = $this->table;
			
			if(isset($_GET['filters'])){
				$filters = (array)$table->getListFilters($_GET['filters']);
			}else{
				$filters = (array)$table->getListFilters();
			}
			
			return $filters;
		}

		public function getRelatedFilters(){
			$table = $this->table;
			
			return $table->getRelatedFilters();
		}

		public function getTotalProductsActiveFilters(){
			$table = $this->table;
			
			return $table->getTotalProductsActiveFilters();
		}
	}
?>