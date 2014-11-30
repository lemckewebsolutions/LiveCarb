<?php
/**
 * @var Framework_Views_PageView $this
 */
echo $this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "default/header.inc.tpl");
?>
<div class="col-sm-6 col-md-6 widget">
	<?=$this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "widgets/profile/personal.inc.tpl")?>
</div>
<div class="col-sm-6 col-md-6 widget">
	<?=$this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "widgets/profile/boluswizard.settings.inc.tpl")?>
</div>
<?
echo $this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "default/footer.inc.tpl");