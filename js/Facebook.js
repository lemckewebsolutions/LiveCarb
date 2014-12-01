window.fbAsyncInit = function() {
  FB.init({
	appId      : '1507854099474966',
	xfbml      : true,
	version    : 'v2.2'
  });
};

 (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&appId=1507854099474966&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));