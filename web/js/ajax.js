$(document).ready(function() {
	
	$('#content a').each(function(){
		if ($(this).attr('href')!='#')
		{
			$(this).attr('onClick','$("#content").load("'+this+'");return false;');
		}
	});
	
});