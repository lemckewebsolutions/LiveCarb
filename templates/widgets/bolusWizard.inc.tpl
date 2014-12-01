<div class="widget-header">
	<p class="text-center">Bolus wizard</p>
</div>
<div class="widget-body">
	<p>
		Bereken hier je hoeveel insuline je nodig hebt voor je maaltijd.
	</p>
	<form method="POST" action="#" role="form" class="boluswizardform">
<?
if ($user !== null)
{
?>
		<div class="form-group">
			<label for="sugar">Bloedsuiker</label>
			<input name="sugar" type="number" class="form-control" id="sugar" min="0" value="5.5" step="0.1" required>
			<input name="targetSugar" type="hidden" value="<?=$targetSugar?>">
			<input name="sensitivity" type="hidden" value="<?=$sensitivity?>">
		</div>
<?
}
?>
		<div class="form-group">
			<label for="koolhydraten">Gegeten koolhydraten</label>
			<input name="carbs" type="number" class="form-control" id="koolhydraten" min="0" value="0" required>
		</div>
		<div class="form-group">
			<label for="ratio">Aantal koolhydraten voor 1 eenheid insuline</label>
<?
$readOnly = "";
if ($ratioCanBeChanged === false)
{
	$readOnly = "readonly";
}
?>
			<input name="ratio" type="number" class="form-control" id="ratio" min="0" value="10" required <?=$readOnly?>>
<?
if ($ratioCanBeChanged === false)
{
?>
			<p class="notification bg-info">
				Je kan je bolus wizard instellingen aanpassen in je <a href="<?=WebSite_UrlPatterns::PROFIEL?>" title="Profiel">profiel</a>
			</p>
<?
}
?>
		</div>
		<div class="js-bolus-wizard-submit">
			<button type="submit" class="btn btn-primary">Bereken</button>
		</div>
	</form>
</div>