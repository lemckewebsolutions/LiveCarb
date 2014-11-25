<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">LiveCarb</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
<?
foreach ($navigationItems as $navigationItem)
{
	$class = "";
	if ($navigationItem->getActive() === true)
	{
		$class = "active";
	}
?>
				<li class="<?=$class?>"><a href="<?=$navigationItem->getUrl()?>"><?=$navigationItem->getTitle()?></a></li>
<?
}
?>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>