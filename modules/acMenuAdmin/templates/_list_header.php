Visualizza in: 
<?php 
$languaes = sfConfig::get('app_ac_menu_page_languages');
foreach ($languaes as $culture=>$language)
{
	if ($sf_user->getCulture() == $culture)
	{
		echo '<b>'.$language.'</b>';
	}
	else
	{
		echo link_to($language, '@ac_menu_change_culture?sf_culture='.$culture);
	}
	echo '&nbsp;&nbsp;';
}
?>
<br/><br/>