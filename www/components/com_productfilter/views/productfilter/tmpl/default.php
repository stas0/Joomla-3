<?php
	defined('_JEXEC') or die();
?>

<div id="productfitler">
	<div class="container">
		<div class="row" style="margin-top: 20px;">
		<!--FILTER-->
			<div class="col-md-3 modul" style="padding: 20px;">
				<?php foreach ($this->filterCategories as $filterCategory) {
				$filterCategory = (array)$filterCategory;
				?>
				<h4 class="field_name"><?php echo $filterCategory['categorie_title']; ?></h4>
				<ul class="filter_ul">
					<?php foreach ($filterCategory['filters'] as $i => $filter) {
					$filter = (array)$filter;

					if(isset($filter['checked']) && $filter['checked'] == true){
						$checked = 'selectedFilter';
					}else{
						$checked = '';
					}
					?>
						<li class="productFilterItem <?php echo $checked; ?>"><a class="position" data-filter="<?php echo $filter['id']; ?>"></a>
							<?php echo $filter['filter_title']; ?>
						</li> 
					<?php
					} ?>
				</ul>
				<?php
				} ?>
				<p style="margin-top: 20px;" id="resetFilters"><a class="filter">сбросить фильтр</a></p>
			</div>	
		<!--END FILTER-->	
		<!--REZULTAT-->		
			<div class="col-md-9">
				<?php foreach ($this->products as $i => $product) {
					$product = (array)$product;
					$productLink = $this->menu->getItem($product['product_menu_item'])->link;
				?>
					<div class="col-md-4">
						<a href="<?php echo $productLink; ?>" class="filter_rez_img"><img src="<?php echo $product['product_img']; ?>" width="250"></a>
						<h5><a href="<?php echo $productLink; ?>" class="filter_rez_name">
							<?php echo $product['product_title']; ?>
						</a></h5>
						<p class="productDesc">
							<?php echo $product['product_desc']; ?>
						</p>
						<p><a href="<?php echo $productLink; ?>" class="click">Купить в один клик</a></p>
					</div>
				<?php
				} ?>
				<div class="productPagination">
					<?php foreach ($this->pagination['paginations'] as $pagination) {
					?>
						<a href="<?php echo $pagination['url']; ?>"><?php echo $pagination['page']+1; ?></a>
					<?
					} ?>
				</div>
			</div>
		<!--END REZULTAT-->	
		</div>
	</div>
	<script type="text/javascript">	
		(function($){
				$('a.position').click(function () {
					$(this).parent().toggleClass('selectedFilter');
				});
		})(jQuery)				
	</script>
</div>