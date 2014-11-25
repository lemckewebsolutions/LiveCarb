<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 footer text-center">
		<span>
			Gebruik op eigen risco.<br>
			LiveCarb&copy; is een initiatief van Lemcke Websolutions&copy; <?=date("Y")?>
		</span>
	</div>
</div>
<?
foreach ($footerJsFiles as $footerJsFile)
{
?>
		<script src="js/<?=$footerJsFile?>"></script>
<?
}
?>
	</body>
</html>