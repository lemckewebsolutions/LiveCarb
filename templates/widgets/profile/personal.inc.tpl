<div class="widget-header">
	<p class="text-center">Persoonlijke gegevens</p>
</div>
<div class="widget-body">
	<table>
<?
if ($user instanceof Users_FacebookUser)
{
?>
		<tr>
			<th>Profielfoto:</th>
			<td class="text-center">
				<img src="https://graph.facebook.com/<?=$user->getFacebookUserId()?>/picture">
			</td>
		</tr>
<?
}
?>
		<tr>
			<th>Naam:&nbsp;</th>
			<td>
				<?=$user->getName()?>
			</td>
		</tr>
	</table>
</div>