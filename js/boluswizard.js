$(document).on("submit", ".boluswizardform", function(event)
{
	event.preventDefault();

	$.ajax(
    {
        url: "boluswizard",
		type: "POST",
		data:
		{
			carbs: this.carbs.value,
			ratio: this.ratio.value
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