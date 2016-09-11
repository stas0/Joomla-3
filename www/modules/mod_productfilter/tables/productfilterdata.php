<?php
	defined('_JEXEC') or die();

	class ProductFilterTableProductFilterData{
		private $limit = 20;
		private $categorieId = -1;
		private $filterCategories;
		private $totalProduct;
			//	ID фильров, которые остались не выбранными
			//	Они нужны для подсчета товаров, которые могут добавлены
		private $filterCategoriesNotActive;
		private $filterCategories_query;
		private $filterCategories_sql_in;
		private $relatedFilters;
		private $productFilterQuery;

		public function setCategorieId($id){
			$this->categorieId = $id;

			$db = JFactory::getDbo();
			$q = $db->getQuery(true);
			$q->select('filter_categories');
			$q->from('#__productfilter_product_categories');
			$q->where('id = ' . $this->categorieId);
			$db->setQuery($q);

			$this->filterCategories = json_decode($db->loadResult());
			$this->filterCategories_sql_in = rtrim(implode(',', $this->filterCategories), ',');
		}

		public function getListProducts($filtersList = '', $page = 0){
			$limit = $this->limit;

			$db = JFactory::getDbo();
			$q = $this->getProductFilterQuery($filtersList);
			
			$db->setQuery($q);
			
			return $db->loadObjectList();
		}

		public function getProductPagination($filters = '', $page = 0){
			$limit = $this->limit;

			$db = JFactory::getDbo();

			$q = $this->getProductFilterQuery($filtersList);
			$q->select('count(id) as total');
			
			$db->setQuery($q);

			$count = $db->loadObject()->total;
			
			$pagesCount = ceil($count/$limit);
			
			return $pagesCount;
		}

		public function getListFilters($filtersList = ''){
			$filterCategories = $this->getListFilters_($filtersList);

			$additionalProducts = $this->getTotalProductsNotActiveFilters();

			foreach ($filterCategories as $filterCategoryKey => $filterCategory) {
				foreach ($filterCategory->filters as $filterKey => $filter) {
					if(array_key_exists($filter->id, $additionalProducts)){
						$filterCategories[$filterCategoryKey]->filters[$filterKey]->productCount = $additionalProducts[$filter->id]['productCount'];
					}else{
						$filterCategories[$filterCategoryKey]->filters[$filterKey]->productCount = $this->totalProducts;
					}
				}
			}
			//echo '<pre>';
			//print_r($filterCategories);
			//echo '</pre>';
			//die();

			return $filterCategories;
		}

		private function getProductFilterQuery($filtersList, $getExist = true){
			if($getExist && !empty($this->productFilterQuery)){
				return $this->productFilterQuery;
			}

			$filterCategories = $this->getListFilters_($filtersList);
			$filtersList = explode(',', $filtersList);
			$filterCategoriesNotActive = array();
			$this->filterCategoriesNotActive = array();

			$db = JFactory::getDbo();
			$q = $db->getQuery(true);
			$q->select("*");
			$q->from("#__productfilter_products as pp");
			$q->where('1');
			$q->where('pp.product_categorie = ' . $this->categorieId);
			$q_notActive = $db->getQuery(true);
			$q_notActive->select("count(pp.id) as total");
			$q_notActive->from("#__productfilter_products as pp");
			$q_notActive->where('1');

			foreach ($filterCategories as $filterCategory) {
				$filters = '';
				$arr = array();

				foreach ($filterCategory->filters as $filter) {
					if(in_array($filter->id, $filtersList)){
						$filters .= $filter->id . ',';
					}else{
						$arr[] = $filter->id;
					}
				}

				$filterCategoriesNotActive[] = array(
					'filters' => $arr,
					'activeFilterCategory' => !empty($filters)
				);

				if(empty($filters)){
					continue;
				}

				$filters = rtrim($filters, ',');
				$tmp = 'pp.id in(select product_id from `#__productfilter_filter` where filter_id in('.$filters.'))';
				$q->where($tmp);
				$q_notActive->where($tmp);
			}

			$qCount = clone $q;
			$qCount->select('count(pp.id) as total');
			$db->setQuery($qCount);
				//	Общее количество товаров при активных фильтрах
			$this->totalProducts = $db->loadObject()->total;

			$this->filterCategories_query = $q;

				//	Создаем запросы с возможным выбором пунктов, которые сейчас не активны
				//	Делаем подсчет, сколько будет продуктов, если выбрали один из пунктов
				//	Если < 0, то продуктов не прибавляется(а нам нужно чтобы прибавлялись),
				//	по этому ставим значение в 0
			foreach($filterCategoriesNotActive as $filters) {
				foreach ($filters['filters'] as $filterId) {
					if($filters['activeFilterCategory']){
						$queryPrefix = '1 OR ';
					}else{
						$queryPrefix = '';
					}

					$tmpQ = clone $q_notActive;
					$tmpQ->where($queryPrefix . ' pp.id in(select product_id from `#__productfilter_filter` where filter_id in('.$filterId.'))');
					$qCount = clone $q;
					$db->setQuery($tmpQ);
					$total = $db->loadObject()->total;

					//echo $tmpQ . '<br>';
					//echo $total . ' - ' . $totalProducts . ' = ' . ($total - $totalProducts) . '<br>';

					if(($this->totalProducts - $total) == 0 || $total == 0){
						$total = 0;
					}

					if($filterId == 9){
						//echo $this->totalProducts . '<br>';
						//echo $total;
					}

					$this->filterCategoriesNotActive[$filterId] = array(
						'filterId' => $filterId,
						'productCount' => $total
					);
				}
			}
			//echo $this->totalProducts . '<br>';
			//echo $q;
			$this->productFilterQuery = $q;
			
			return $q;
		}

		private function getTotalProductsNotActiveFilters(){
			//echo '<pre>';
			//print_r($this->filterCategoriesNotActive);
			//echo '</pre>';
			return $this->filterCategoriesNotActive;
		}

		public function getTotalProductsActiveFilters(){
			return $this->totalProducts;
		}

		private function getListFilters_($filtersList = '', $getExit = true){
				//	получить сущесвтующий список, если есть
			if($getExit && is_null($this->filterCategories) != false){
				return $this->filterCategories;
			}

			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$filtersList = explode(',', $filtersList);

			$query->select('*');
			$query->from('#__productfilter_filter_categories');
			$query->where('id in('. $this->filterCategories_sql_in .')');
			$query->order('ordering ASC');
			$db->setQuery($query);
			$filterCategories = (array)$db->loadObjectList();

			foreach ($filterCategories as $key => $category) {
				$query = $db->getQuery(true);
				$query->select('*');
				$query->from('#__productfilter_filters');
				$query->where('filter_categorie = ' . $category->id);
				$query->order('ordering ASC');

				$db->setQuery($query);
				$filters = (array)$db->loadObjectList();

				foreach ($filters as $k => $item) {
					$relatedListArr[$item->id] = json_decode($item->related_filters);

					foreach ($filtersList as $value) {
							//	Ставить Выбрано, если ID активного фильра совпадает с полученым списком фильтров
						if($item->id == $value){
							$filters[$k]->checked = true;

							break;
						}
					}
				}

				$filterCategories[$key]->filters = $filters;
			}

			//echo '<pre>';
			//print_r($filterCategories);
			//die();

			$this->filterCategories = $filterCategories;

			return $this->filterCategories;
		}

		public function getRelatedFilters(){
			return $this->relatedFilters;
		}
	}
?>