<div class="container-fluid" style="padding-left: 5px; padding-right: 5px;">    
		<!-- Скрытые поля -->
	<div>
        <input type="hidden" id="wichlaczFilterData_filterResultUrl" value="<?php echo $filterResultPage; ?>" />
    </div>    
	<div class="row wichlaczFilter_wrap">
	  <div id="wichlacz_module_filter_send_mail" class="col-md-4 col-sm-4 col-xs-12" data-toggle="validator" role="form">
		<div>
			<h3 id="myHeader">Ищем дилеров!</h3>
			<div class="form_style">
			  <p>
				<h5>Ваше имя:</h5>
				<input name="name" type="text" class="inp_sel" required>
			  </p>
			  <p>
				<h5>Ваш телефон:</h5>
				<input name="phone" type="text" class="inp_sel" required>
			  </p>
			  <h5>Ваша область:</h5>
			  <p style="margin-top: 10px; margin-bottom: 20px;">
				<select name="region" class="inp_sel" required>
				  <option value="">-выберите область-</option>
				  <option value="Запорожская">Запорожская</option>
				  <option value="Киевская">Киевская</option>
				  <option value="Сумская">Сумская</option>
				  <option value="Днепропетровская">Днепропетровская</option>
				  <option value="Одесская">Одесская</option>
				  <option value="Харьковская">Харьковская</option>
				  <option value="..">...</option>
				</select>
			  </p>
			  <p>
				<h5>Ваш город:</h5>
				<input name="city" type="text" class="inp_sel" required>
			  </p>
			  <p>
				<input type="hidden" name="mailRecipient" id="wichlaczFilterData_filterRecipientEmail" value="<?php echo $filterRecipientMail; ?>" />
				<input type="hidden" name="mailSender" id="wichlaczFilterData_filterRecipientEmail" value="<?php echo $filterSenderMail; ?>" />
				<button id="wichlacz_module_filter_send_mail_btn" class="btn btn_blue" type="submit">Отправить</button>
			  </p>
			</div>
		</div>
	  </div>
	  <div class="col-md-4 col-sm-4 col-xs-12">
		<div>
			<h3 id="myTriggerHover">Подобрать котел</h3>
			<div id="wichlacz_module_filter" class="form_style" data-toggle="validator" role="form">
				<p>
					<h5>Площадь помещения (м2):</h5>
					<input type="text" name="room_space" class="floatVal" required>
				</p>
			  <?php
				$i = 0;
				$flag = false;
				foreach($filterData as $filter){
					if($i == 1){
						$i = 0;
					?>
						</p>
						<p>
					<?php
					}
					
					$filter = (array)$filter;
					?>
					<h5><?php echo $filter['title']; ?></h5>
					<p class="param_inf">
						<select class="select" name="<?php echo $filter['title_name']; ?>" required>
							<?php
							foreach($filter['data'] as $dataItem){
							?>
								<option value="<?php echo $dataItem->value?>" data-name="<?php echo $dataItem->text; ?>"><?php echo $dataItem->text; ?></option>
							<?php
							}
							?>
						</select>
					</p>
				<?php
					$i++;
				}
				?>
				<h5>Подача топлива: </h5>
				<p>
					<input type="checkbox" name="flue_supply" value="Ручная" class="check" style="display: inline;"> Ручная 
					<input type="checkbox" name="flue_supply" value="Авто" class="check" style="display: inline;"> Авто 
				</p>
				<p style="margin-top: 20px;">
					<button type="submit"  id="bairo_boiler_filter_btn" class="btn disable btn_blue_">Подобрать котел</button>
				</p>
			</div>
		</div>
	  </div>
	  <div class="col-md-4 col-sm-4 col-xs-12">
		<div>
			 <h3>Где купить?</h3>
			 <div class="form_style">                   
			   <p class="city_style"><a href="">Запорожье >></a></p>
			   <p class="city_style"><a href="">Днепропетровск >></a></p>
			   <p class="city_style"><a href="">Киев >></a></p>
			   <p class="city_style"><a href="">Одесса >></a></p>
			   <p class="city_style"><a href="">Полтава >></a></p>
			   <p class="city_style"><a href="">Суммы >></a></p>
			   <p class="city_style"><a href="">Кировоград >></a></p>
			   <p class="city_style"><a href="">Другие города >></a></p>
			 </div>
		</div>
	  </div>
	</div>
</div>