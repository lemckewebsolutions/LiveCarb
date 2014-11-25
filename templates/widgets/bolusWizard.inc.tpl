<div class="widget-header">
	<p class="text-center">Bolus wizard</p>
</div>
<div class="widget-body">
	<p>
		Bereken hier je hoeveel insuline je nodig hebt voor je maaltijd.
	</p>
	<form method="POST" action="/" role="form">
		<div class="form-group">
			<label for="koolhydraten">Gegeten koolhydraten</label>
			<input name="carbs" type="number" class="form-control" id="koolhydraten" min="0" value="<?=$carbs?>" required>
		</div>
		<div class="form-group">
			<label for="ratio">Aantal koolhydraten voor 1 eenheid insuline</label>
			<input name="ratio" type="number" class="form-control" id="ratio" min="0" value="<?=$ratio?>" required>
		</div>
		<button type="submit" class="btn btn-primary">Bereken</button>
<?
if ($insuline > 0)
{
?>
		<p>Advies: <?=$insuline?> eenheden.</p>
<?
}
?>
	</form>
</div>