<?php
defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

class JFormFieldListContent extends JFormField{
	protected $type = 'accordionContent';
	private $modName = 'mod_wichlacz';
	
	public function getLabel(){
		return str_replace($this->id, $this->id . '_id', parent::getLabel());
	}
	
	public function getInput(){
			// Check data                    /modules/mod_accordion_content/assets/fields/data/data.txt
		$accordionData = file_get_contents(__DIR__ . "/../assets/fields/data/data.txt");
		//$data = (array)json_decode($accordionData);
		$data = (array)json_decode($this->value);
		$dataLen = count($data);
		
		$lang =& JFactory::getLanguage();
		$doc = JFactory::getDocument();
		
			//	add css
		$doc->addStyleSheet('/modules/'.$this->modName.'/assets/fields/css/default.css');
		
		$html = '
			<div class="bairroAccordionContent_Container">
				<div class="bairroAccordionContent_toolbar">
					<a href="javascript:;" id="addNewItem" class="btn btn-primary">'.JText::_("ACCORDION_CONTENT_FIELD_ADD_ITEM").'</a>
					<a href="javascript:;" id="saveAccordion" class="btn btn-success">'.JText::_("ACCORDION_CONTENT_FIELD_SAVE").'</a>
				</div>
				<div class="hiddenData">
					<input type="hidden" name="'. $this->name .'" value=\''. $this->value .'\' class="jform_listcontent">
				</div>
				<div class="bairroAccordionContent_ItemContainer">
		';
		
		$styleDef = 'style="display: none;"';
		$styleStaticItem = 'style="display: block;"';
		$styleStaticInnerItem = 'style="display: flex;"';
		
		for($i = -1; $i < $dataLen; $i++){
			if($i != -1){
				$itemData = (array)$data[$i];
				$innerData = (array)$itemData["data"];
			}
			
			$html .= '
					<div class="bairroAccordionContent_Item bairroAccordionContent_commonParentClass" '.(($i == -1) ? $styleDef : $styleStaticItem) .'">
						<div class="bairroAccordionContent_ItemWrap">
							<div class="bairroAccordionContent_toolbar">
								<a href="javascript:;" class="addNewInnerItem btn btn-primary">'.JText::_("ACCORDION_CONTENT_FIELD_ADD_INNER_ITEM").'</a>
								<a href="javascript:;" class="removeItem btn btn-delete">'.JText::_("ACCORDION_CONTENT_FIELD_REMOVE_INNER_ITEM").'</a>
							</div>
							<div>
								<div class="bairroAccordionContent_draDropHand">
								</div>
								<div class="bairroAccordionContent_expandRoll_up">
									<a href="javascript:;">'.JText::_("ACCORDION_CONTENT_FIELD_ITEM_ROLL_UP").'</a>
									<a href="javascript:;" style="display: none">'.JText::_("ACCORDION_CONTENT_FIELD_ITEM_EXPAND").'</a>
								</div>
								<div class="bairroAccordionContent_title">
									<p>'.JText::_("ACCORDION_CONTENT_FIELD_TITLE").'</p>
									<input type="text" value="'.(($i != -1) ? $itemData["title"] : '').'">
									<p>'.JText::_("ACCORDION_CONTENT_FIELD_NAME").'</p>
									<input type="text" value="'.(($i != -1) ? $itemData["title_name"] : '').'">
								</div>
							</div>
							<div>
							';
								for($j = -1; $j < count($innerData); $j++){
									$oneInnerData = (array)$innerData[$j];
									
									$html .= '
										<div class="bairroAccordionContent_InnerItem bairroAccordionContent_commonParentClass" '.(($j == -1) ? $styleDef : $styleStaticInnerItem) .'>
											<div class="bairroAccordionContent_draDropHand">
											</div>
											<div class="bairroAccordionContent_field">
												<div>
													<p>'.JText::_("ACCORDION_CONTENT_FIELD_ITEM_DATA").'</p>
													<input type="text" value="'.(($j != -1) ? $oneInnerData["text"] : '').'">
												</div>
												<div>
													<p>'.JText::_("ACCORDION_CONTENT_FIELD_ITEM_OPTION_VALUE").'</p>
													<input type="text" value="'. $oneInnerData["value"] .'">
												</div>
												<div class="deleteInnerItem">
												</div>
											</div>
										</div>
									';
								}
							$html .= '
							</div>
						</div>
					</div>
			';
		}
		
		$html .= '
				</div>
			</div>
			<script src="/modules/'.$this->modName.'/assets/fields/js/accordionContent.js"></script>
			<script src="/modules/'.$this->modName.'/assets/js/json.js"></script>
		';
		
		return $html;
		
	}
	
	protected function transformstrBoolean($str, $inputType = ''){
		$str = strtolower($str);
		$checkStr = ($str == '1') ? true : false;
		$res = '';
		
		switch($inputType){
			case 'checkbox':
				$res = ($checkStr) ? 'checked' : 'fff';
				
				break;
		}
		
		return $res;
	}
}
?>