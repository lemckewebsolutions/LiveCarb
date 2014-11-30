<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="LiveCarb is de site voor mensen met Diabetes. Bereken eenvoudig je koolhydraten en de benodigde insuline.">
		<meta name="keyword" content="diabetes, koolhydraten, livecarb, ratio, bolus, wizard">
		<title><?=$title?></title>

<?
foreach ($cssFiles as $cssFile)
{
?>
		<link rel="stylesheet" type="text/css" href="css/<?=$cssFile?>">
<?
}
?>

<?
foreach ($headerJsFiles as $headerJsFile)
{
?>
		<script src="js/<?=$headerJsFile?>"></script>
<?
}
?>
	</head>
	<body>
		<?=$this->includeFile(WebSite_IndexPageController::TEMPLATE_PATH . "default/navigation.inc.tpl")?>
		<div class="container">
			<div class="content col-xs-12 col-sm-12 col-md-8">