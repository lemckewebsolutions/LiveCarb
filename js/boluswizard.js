$(document).on("submit", ".boluswizardform", function(event)
{
	event.preventDefault();

	var sugar = -1,
		targetSugar = -1,
		sensitivity = -1;

	if (this.sugar !== undefined &&
		this.targetSugar !== undefined &&
		this.sensitivity !== undefined)
	{
		sugar = this.sugar.value;
		targetSugar = this.targetSugar.value;
		sensitivity = this.sensitivity.value;
	}

	$.ajax(
    {
        url: "boluswizard",
		type: "POST",
		data:
		{
			carbs: this.carbs.value,
			ratio: this.ratio.value,
			sugar: sugar,
			targetSugar: targetSugar,
			sensitivity: sensitivity
		}
    })
    .done(function(data)
    {
		$(".js-bolus-wizard-submit").find(".notification").remove();
		$(".js-bolus-wizard-submit").append(
			"<p class=\"notification inline-block bg-success\">" +
				"Advies: " + data.insuline + " eenheden" +
			"</p>"
		);
    })
});