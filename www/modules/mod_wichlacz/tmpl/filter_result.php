<div>
	<div class="container-fluid">
		<div class="row">
			<div class="wrap">                  
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 param">
				<p class="param_name">Подбор котла по параметрам</p>
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<p class="param_inf"><b>Площадь помещения:</b> <?php echo $input->get('room_space'); ?> кв.м</p>
					</div>
					<div class="col-md-3 col-sm-3">
						<p class="param_inf"><b>Тип здания:</b> <?php echo $_GET['building_type_name']; ?></p>
					</div>
					<div class="col-md-3 col-sm-3">
						<p class="param_inf"><b>Тип топлива:</b> <?php echo $_GET['type_flue_name']; ?></p>
					</div>
					<div class="col-md-3 col-sm-3">  
						<p class="param_inf"><b>Подача топлива:</b> <?php echo (isset($_GET['flue_supply'])) ? $_GET['flue_supply'] : ''; ?></p>
						<div>
							<a href="" class="btn_blue">Изменить</a>
						</div>
					</div>
				</div>                   
			</div>
		</div>
		<div class="row box-container">
			<div class="table-responsive" style="border: 0px;">
				<table class="table table-condensed table-hover inform">
						<?php foreach($boilersResult as $boiler){?>
						<?php }?>
					<tr>
						<td></td>
						<?php foreach($boilersResult as $boiler){?>
							 <td><a href="<?php echo $boiler['path']; ?>" class="img_a">
								<img src="<?php echo $boiler['image']; ?>" class="img_kot">
							 </a></td>
						<?php }?>
					</tr>
					<tr>
						<td>Цена, грн</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><span class="money"><?php echo $boiler['price']; ?></span></td>
						<?php }?>
					</tr>
					<tr>
						<td>Мощность, кВт</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['power']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Макс. рабочее давление, МПа</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['max_working_pressure']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Ширина дверцы топки, мм</td>
					   <?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['width_furnace_door']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Высота дверцы топки, мм</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['height_furnace_door']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Длина топки, мм</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['length_furnace']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Ширина, мм</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['width_furnace']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Высота, мм</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['height_furnace']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Глубина, мм</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['depth_furnace']; ?></td>
						<?php }?>​
					</tr>
					<tr>
						<td>Объем топки, дм3</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['volume_furnace']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Объем воды, л</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['volume_water']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Высота д. т. мин.</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['height_d_t_min']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Сечение дымохода, мм</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['cross_section_chimney']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Толщина метала топки, мм</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['thickness_metal_furnace']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td>Подключение</td>
						<?php foreach($boilersResult as $boiler){?>
							<td><?php echo $boiler['connection']; ?></td>
						<?php }?>
					</tr>
					<tr>
						<td></td>
						<?php foreach($boilersResult as $boiler){?>
							<td><a href="<?php echo $boiler['path']; ?>" class="btn_blue">Подробнее</a></td>
						<?php }?>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>