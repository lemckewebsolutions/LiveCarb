$(document).on("submit", ".boluswizardform", function(event)
{
	event.preventDefault();

	$.ajax(
    {
        url: "boluswizard",
		type: "POST"
    })
    .done(function(data)
    {
        alert(data);
    })
});