<!DOCTYPE HTML>
<html>
<head>
	<title>GWPress Login</title>
	<link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">
	<!-- Loading Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">
	
</head>
<body>
	<div class="container">
	<div class="login">
        <div class="login-screen">
          <div class="login-icon">
            <img src="images/login/icon.png" alt="Welcome to Mail App" />
            <h4>Welcome to <small>GWPress</small></h4>
          </div>
		  <form method="post" action='index.php'>
          <div class="login-form">
            <div class="control-group">
              <input type="text" class="login-field" name="user_login" value="" placeholder="Enter your name" id="login-name" />
              <label class="login-field-icon fui-man-16" for="login-name"></label>
            </div>

            <div class="control-group">
              <input type="password" class="login-field" name="password" value="" placeholder="Password" id="login-pass" />
              <label class="login-field-icon fui-lock-16" for="login-pass"></label>
            </div>

            <button type="submit" class="btn btn-primary btn-large btn-block" name="action" value="Login">Login</button>
			<button type='submit' class="btn btn-primary btn-large btn-block" name="action" value="Register">Register</button>
          </div>
		  </form>
        </div>
      </div>
	</div>

	 <!-- Load JS here for greater good =============================-->
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="js/jquery.dropkick-1.0.0.js"></script>
    <script src="js/custom_checkbox_and_radio.js"></script>
    <script src="js/custom_radio.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="http://vjs.zencdn.net/c/video.js"></script>
    <script src="js/application.js"></script>
    <!--[if lt IE 8]>
      <script src="js/icon-font-ie7.js"></script>
      <script src="js/icon-font-ie7-24.js"></script>
    <![endif]-->
    <script type="text/javascript">
      var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
      document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
      try{
        var pageTracker = _gat._getTracker("UA-19972760-2");
        pageTracker._trackPageview();
        } catch(err) {}
    </script>
</body>
</html>