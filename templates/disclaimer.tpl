<?php
/**
 * @var Framework_Views_PageView $this
 */
echo $this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "default/header.inc.tpl");
?>
<div class="col-sm-12 col-md-12 widget">
	<?=$this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "widgets/disclaimer.inc.tpl")?>
</div>
<?
echo $this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "default/footer.inc.tpl");