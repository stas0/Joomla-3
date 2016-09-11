<?php
	defined('_JEXEC') or die();

	class ProductFilterTableProductFilterData extends JTable{
		private $limit = 6;

		public function __construct(&$db){
			parent::__construct('#__productfilter_products', 'id', $db);


		}

		public function getListProducts($filters = '', $page = 0){
			$limit = $this->limit;

			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('*');
			$query->from('#__productfilter_products as pp');

			$query->where('1');

			if($filters != ''){
				$filters = explode(',', $filters);

				foreach($filters as $filter){
					$query->where("pp.id = (SELECT product_id FROM `#__productfilter_filter` as pf where pf.filter_id = ". $filter ." and pf.product_id = pp.id)");
				}
			}

			$start = $page * $limit;
			$query->setLimit($limit, $start);
			
			$db->setQuery($query);
			
			return $db->loadObjectList();
		}

		public function getProductPagination($filters = '', $page = 0){
			$limit = $this->limit;

			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('count(id) as total');
			$query->from('#__productfilter_products as pp');

			$query->where('1');

			if($filters != ''){
				$filters = explode(',', $filters);

				foreach($filters as $filter){
					$query->where("pp.id = (SELECT product_id FROM `#__productfilter_filter` as pf where pf.filter_id = ". $filter ." and pf.product_id = pp.id)");
				}
			}
			
			$db->setQuery($query);

			$count = $db->loadResult();
			$pagesCount = ceil($count/$limit);
			
			return $pagesCount;
		}

		public function getListFilters($filtersList = ''){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$filtersList = explode(',', $filtersList);

			$query->select('*');
			$query->from('#__productfilter_filter_categories');
			$query->order('ordering ASC');
			$db->setQuery($query);
			$filterCategories = (array)$db->loadObjectList();

			foreach ($filterCategories as $key => $category) {
				$query = $db->getQuery(true);
				$query->select('*');
				$query->from('#__productfilter_filters');
				$query->where('filter_categorie = ' . $category->id);
				
				$db->setQuery($query);
				$filters = (array)$db->loadObjectList();

				foreach ($filters as $k => $item) {
					foreach ($filtersList as $value) {
						if($item->id == $value){
							$filters[$k]->checked = true;

							break;
						}
					}
				}

				$filterCategories[$key]->filters = $filters;
				
			}

			return $filterCategories;
		}
	}
?>