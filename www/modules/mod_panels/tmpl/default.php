<?php

defined('_JEXEC') or die;

?>
<div id="panels-module">
    <div class="container">
        <h3 style="border-bottom: 2px solid red;">Секционные ворота</h3>
        <div class="row">
            <div class="col-md-5" style="padding-top: 20px;">
                <div class="img_prod">
                    <img class="mainImage" src="<?php echo $defaultPanel->image; ?>" width="400">
                </div>
            </div>
            <div class="col-md-7" style="padding-top: 20px;">
                <!--WIDTH HEIGHT-->
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <span class="mod_text">Ширина, мм : </span>
                            <input type="number" class="mod_inp panelWidthParam"><input type="button" value="?" class="mod_btn" data-toggle="modal" data-target=".modal-sw">
                        </p>
                    </div>
                    <div class="modal fade modal-sw" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="text-align: center;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Ширина</h4>
                                </div>
                                <img src="img/width.png" width="400" style="margin-top: 20px;">
                                <p>A - ширина в мм</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <span class="mod_text">Высота, мм : </span>
                            <input type="number" class="mod_inp panelHeightParam"><input type="button" value="?" class="mod_btn" data-toggle="modal" data-target=".modal-sh">
                        </p>
                    </div>
                    <div class="modal fade modal-sh" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="text-align: center;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Высота</h4>
                                </div>
                                <img src="img/height.png" width="400" style="margin-top: 20px;">
                                <p>B - высота в мм</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END WIDTH HEIGHT-->
                <hr style="border-top: 1px solid #dddddd;">
                <!--TYPE COLOR-->
                <div class="row">
                    <div class="col-md-12">
                        <p>
                                <!-- Panel -->
                            <select class="mod_sel selectPanel">
                                <?php foreach($panelList as $item): ?>
                                    <option value="<?php echo $item->id; ?>" data-image="<?php echo $item->image; ?>"
                                            data-price="<?php echo $item->price; ?>"
                                            data-automation_price="<?php echo $item->automationPrice; ?>"
                                        <?php echo $item->id == $paramsData['defaultPanel'] ? 'selected' : ''; ?>>
                                        <?php echo $item->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="button" value="?" class="mod_btn" data-toggle="modal" data-target=".modal-st" style="margin-left: -5px;">
                            <span class="mod_text"> - Тип панели</span>
                        </p>
                        <div class="modal fade modal-st" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="text-align: center;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Тип панели</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php foreach($panelList as $item): ?>
                                            <div class="row col-md-6 listItem" style="margin-top: 20px;">
                                                <div class="">
                                                    <img src="<?php echo $item->image; ?>" width="80">
                                                    <p>
                                                        <?php echo $item->name; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>
                            <select class="mod_sel selectColor">
                                <option value="-1" selected>Выберите цвет</option>
                                <?php foreach($panelStylesList as $item): ?>
                                    <option value="<?php echo $item->id; ?>" data-image="<?php echo $item->image; ?>"
                                        data-price="<?php echo $item->price; ?>" class="panelStyle"
                                    >
                                        <?php echo $item->color; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="button" value="?" class="mod_btn" data-toggle="modal" data-target=".modal-color" style="margin-left: -5px;">
                            <span class="mod_text"> - Цвет</span>
                        </p>
                        <div class="modal fade modal-color" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="text-align: center;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Цвет</h4>
                                    </div>
                                    <div class="modal-body selectColor-viewBox">
                                        <?php foreach($panelStylesList as $item): ?>
                                            <div class="row col-md-6 listItem panelStyle" style="margin-top: 20px;">
                                                <div class="">
                                                    <img src="<?php echo $item->image; ?>" width="80">
                                                    <p>
                                                        <?php echo $item->color; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox">
                            <input type="checkbox" id="check"" class="automationToggle">
                            <label for="check" style="font-size: 16px;">Автоматика</label>
                        </div>
                    </div>
                </div>
                <!--END TYPE COLOR-->
                <hr style="border-top: 1px solid #dddddd;">
                <!--PRICE-->
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <span class="mod_text">Цена: </span><a href="#" class="price">1000$</a><input type="button" value="Сохранить" class="mod_btn save">
                    </div>
                </div>
                <!--END PRICE-->
            </div>
        </div>
    </div>
</div>