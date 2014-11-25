<?php
/**
 * @var Framework_Views_PageView $this
 */
echo $this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "default/header.inc.tpl");
echo $this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "default/navigation.inc.tpl");
?>
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-8 widget">
			<?=$this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "widgets/bolusWizard.inc.tpl")?>
		</div>
		<div class="col-sm-4 col-md-4 widget">
			<?=$this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "widgets/login.inc.tpl")?>
		</div>
	</div>
</div>
<?
echo $this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "default/footer.inc.tpl");