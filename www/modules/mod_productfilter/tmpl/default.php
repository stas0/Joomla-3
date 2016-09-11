<?php
	defined('_JEXEC') or die();
?>

<div id="productfitler">
	<div class="container">
		<div class="row" style="margin-top: 20px;">
		<!--FILTER-->
			<div class="col-md-3 modul" style="padding: 20px;">
				<?php foreach ($filterCategories as $filterCategory) {
				$filterCategory = (array)$filterCategory;
				?>
				<h4 class="field_name"><?php echo $filterCategory['categorie_title']; ?></h4>
				<ul class="filter_ul">
					<?php foreach ($filterCategory['filters'] as $i => $filter) {
					$filter = (array)$filter;

					if(isset($filter['checked']) && $filter['checked'] == true){
						$checked = ' selectedFilter';
					}else{
						$checked = '';
					}

					$inert = '';

					if($filter['productCount'] == 0){
						$inert = ' inert';
					}else{
						$inert = '';
					}
					
					?>
						<li class="productFilterItem <?php echo $checked . $inert; ?>"><a class="position" data-filter="<?php echo $filter['id']; ?>"></a>
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
				<?php foreach ($products as $i => $product) {
					$product = (array)$product;

					$productLink = $menu->getItem($product['product_menu_item'])->link;
				?>
					<div class="col-md-6">
						<a href="<?php echo $productLink; ?>" class="filter_rez_img"><img src="<?php echo $product['product_img']; ?>" width="250"></a>
						<h4 style="border-bottom: 2px solid red; color: red; padding: 5px; height: 30px; font-size: 18px; text-transform: uppercase;">
							<a href="#" class="prod_title">
								<?php echo $product['product_title']; ?>
							</a>
							<span style="float: right;"><?php echo $product['product_price']; ?></span>
						</h4>
						<?php /* ?>
						<p class="productDesc">
							<?php echo $product['product_desc']; ?>
						</p>
						<?php */?>
						<table  class="table table-bordered" style="margin-left: auto; margin-right: auto; text-align: left;" cellpadding="5">
							<tr style="border-color: gray;">
								<td style=""><?php echo $product['product_desc_1']; ?></td>
								<td style=""><?php echo $product['product_desc_1_val']; ?></td>
							</tr>
							<tr style="border-color: gray; background-color: #f0f0f0;">
								<td style=""><?php echo $product['product_desc_2']; ?></td>
								<td style=""><?php echo $product['product_desc_2_val']; ?></td>
							</tr>
							<tr style="border-color: gray;">
								<td style=""><?php echo $product['product_desc_3']; ?></td>
								<td style=""><?php echo $product['product_desc_3_val']; ?></td>
							</tr>
							<tr style="border-color: gray; background-color: #f0f0f0;">
								<td style=""><?php echo $product['product_desc_4']; ?></td>
								<td style=""><?php echo $product['product_desc_4_val']; ?></td>
							</tr>
						</table>
						<p>
							<a href="#" class="click">Связаться с нами</a>
							<a href="#" class="click">Купить в один клик</a>
						</p>
					</div>
				<?php
				} ?>
				<div class="productPagination">
					<?php foreach ($pagination['paginations'] as $pagination) {
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