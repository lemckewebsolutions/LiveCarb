<?
$bolusInformation = $facebookUser->getBolusInformation();

$targetSugar = 0;
$ratio = 0;
$sensitivity = 0;
$class = "";
?>
<div class="widget-header">
	<p class="text-center">Bolus wizard instellingen</p>
</div>
<div class="widget-body js-bolus-wizard">
<?
if ($bolusInformation !== null)
{
	$targetSugar = $bolusInformation->getTargetSugar();
	$ratio = $bolusInformation->getRatio();
	$sensitivity = $bolusInformation->getSensitivity();
?>
	<div class="js-bolus-table">
		<table class="">
			<tr>
				<th>Streefwaarde:&nbsp;</th>
				<td><?=$targetSugar?></td>
			</tr>
			<tr>
				<th>KH-Ratio:&nbsp;</th>
				<td>1:<?=$ratio?></td>
			</tr>
			<tr>
				<th>Gevoeligheid:&nbsp;</th>
				<td><?=$sensitivity?></td>
			</tr>
		</table>
		<p class="text-right js-bolus-edit">
			<a href="#" title="Bolus wizard instellingen wijzigen">
				Aanpassen
			</a>
		</p>
	</div>
<?
	$class = "hidden";
}
else
{
?>
	<p class="notification bg-info">Vul alsjeblieft je bolus wizard gegevens in. <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></p>
<?
}
?>
	<form class="<?=$class?> js-bolus-form" method="POST" action="<?=WebSite_UrlPatterns::PROFIEL?>">
		<input type="hidden" name="action" value="saveBolusWizard">
		<div class="form-group">
			<label for="targetSugar">Streefwaarde</label>
			<input name="targetSugar" type="number" class="form-control" id="targetSugar" step="0.5" value="<?=$targetSugar?>">
		</div>
		<div class="form-group">
			<label for="ratio">KH-Ratio</label>
			1:<input name="ratio" type="number" class="form-control" id="ratio" step="1" value="<?=$ratio?>">
		</div>
		<div class="form-group">
			<label for="sensitivity">Gevoeligheid</label>
			<input name="sensitivity" type="number" class="form-control" id="sensitivity" step="0.1" value="<?=$sensitivity?>">
		</div>
		<button type="submit" class="btn btn-primary js-bolus-submit">Opslaan</button>
<?
if ($bolusInformation !== null)
{
?>
		<p class="text-right js-bolus-cancel-edit">
			<a href="#" title="Annuleer bolus wizard instellingen wijzigen">
				Annuleren
			</a>
		</p>
<?
}
?>
	</form>
</div>