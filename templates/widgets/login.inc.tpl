<div class="widget-header">
	<p class="text-center">
<?
if ($showLogin)
{
?>
		Login
<?
}
else
{
?>
		Profiel
<?
}
?>
	</p>
</div>
<div class="widget-body">
<?
if ($showLogin)
{
?>
	<a href="<?=$loginUrl?>">Login met Facebook</a>
<?
}
else
{
?>
	<img src="https://graph.facebook.com/<?=$user->getFacebookUserId()?>/picture">
	<span><?=$user->getName()?></span>
	<p class="text-right">
		<a href="<?=$logoutUrl?>">Uitloggen</a>
	</p>
<?
}
?>
</div>