$(".js-bolus-wizard").on("click", ".js-bolus-edit", function(event)
{
	event.preventDefault();

	$(".js-bolus-form").removeClass("hidden");
	$(".js-bolus-table").addClass("hidden");
});

$(".js-bolus-wizard").on("click", ".js-bolus-cancel-edit", function(event)
{
	event.preventDefault();

	$(".js-bolus-form").addClass("hidden");
	$(".js-bolus-table").removeClass("hidden");
});