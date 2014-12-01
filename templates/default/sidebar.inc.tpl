<?
if ($user === null)
{
?>
<div class="col-xs-12 col-sm-12 col-md-12 widget">
	<?=$this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "widgets/login.inc.tpl")?>
</div>
<?
}
?>
<div class="col-xs-12 col-sm-12 col-md-12 widget">
	<?=$this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "widgets/bolusWizard.inc.tpl")?>
</div>