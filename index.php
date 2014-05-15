<?php

$server_os = php_uname('s');

session_start();

if(isset($_GET['lang'])) {
	$def_lang = strtolower($_GET['lang']);
	if ($def_lang=='si' OR $def_lang=='en' OR $def_lang=='de') {
		//OK
	}
	else {
		$def_lang = "si";
	}
	
}
else
	$def_lang = "si";

if (!isset($_SESSION['lang']))  {
	$_SESSION['lang'] = $def_lang;
}

if (isset($_SESSION['user_is_logged_in'])) {

	//Setting some global variables
	$user = "".$_SESSION['user_name'];
	$project = "".$_SESSION['project'];
	$data = json_decode($_SESSION['data']);
	
	//PAZI!!!čez json_decode in encode ne gre, ne vem zakaj, to je sedaj varnostni problem
	$search = str_replace(array("\r","\n"),"",$_SESSION['search']);
	
	//OK open application
	?>
	
	<!DOCTYPE HTML>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
		<!--<title></title>-->
		<link rel="stylesheet" type="text/css" href="client/site/libs/ext/resources/css/ext-all-notheme.css"/>
		<link rel="stylesheet" type="text/css" href="client/site/libs/ext/resources/css/xtheme-blue.css"/>
		<link rel="stylesheet" type="text/css" href="client/site/libs/ext/ux/css/ux-all.css" />
		<link rel="stylesheet" type="text/css" href="client/site/css/TriStateTreeAndCheckbox.css" />
		<link rel="stylesheet" type="text/css" href="client/site/css/ThemeSwitcherDataView.css" />
		<link rel="stylesheet" type="text/css" href="client/site/css/popup.css" />
		<link rel="stylesheet" type="text/css" href="client/site/css/layerOrderTab.css" />
		
		<script type="text/javascript">
			
			//get project data from DB
			var projectData = {};
			
			//bind PHP --> JS
			GLOBAL_USER = '<?php echo $user?>';
			GLOBAL_SERVER_OS = '<?php echo $server_os?>';
			
			projectData.client_name = '<?php echo $data->client_name?>';
			projectData.client_display_name = '<?php echo $data->client_display_name?>';
			projectData.base_layers = eval(<?php echo json_encode($data->base_layers)?>);
			projectData.overview_layer = '<?php echo $data->overview_layer[0]?>';
			projectData.search = eval(<?php echo $search?>);
			projectData.project = '<?php echo $project?>';
			
			//TODO zrihtaj preko cssja!
			var userLogoImg = '/gisapp/admin/resources/images/user_gray.png';

		</script>
	
		<script type="text/javascript" src="admin/languages/<?php echo $def_lang?>.js"></script>
	
		<script src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false"></script>
		<script type="text/javascript" src="client/site/libs/ext/adapter/ext/ext-base.js"></script>
		<script type="text/javascript" src="client/site/libs/ext/ext-all.js"></script>
		<script type="text/javascript" src="client/site/libs/ext/ux/ux-all.js"></script>
		<script type="text/javascript" src="client/site/libs/proj4js/proj4js-compressed.js"></script>
		<script type="text/javascript" src="client/site/libs/openlayers/OpenLayers.js"></script>
		<script type="text/javascript" src="client/site/libs/geoext/script/GeoExt.js"></script>
		<script type="text/javascript" src="client/site/js/Translations.js"></script>
		<script type="text/javascript" src="client/site/js/LoadAppProjectData.js"></script>
		<script type="text/javascript" src="client/site/js/Customizations.js"></script>
		<script type="text/javascript" src="client/site/js/GetUrlParams.js"></script>
		<script type="text/javascript" src="client/site/js/TriStateTree.js"></script>
		<script type="text/javascript" src="client/site/js/GUI.js"></script>
		<script type="text/javascript" src="client/site/js/QGISExtensions.js"></script>
		<script type="text/javascript" src="client/site/js/GeoNamesSearchCombo.js"></script>
		<script type="text/javascript" src="client/site/js/FeatureInfoDisplay.js"></script>
		<script type="text/javascript" src="client/site/js/LegendAndMetadataDisplay.js"></script>
		<script type="text/javascript" src="client/site/js/WebgisInit.js"></script>
	<style type="text/css">
	#dpiDetection {
	  height: 1in;
	  left: -100%;
	  position: absolute;
	  top: -100%;
	  width: 1in;
	}

	#panel_header_title {
	  float: left;
	  font-size: 20px;
	}
	#panel_header_link {
	  float: left;
	}
	#panel_header_terms_of_use {
	  float: right;
	  font-weight: normal;
	}
	#panel_header_user {
	  float: right;
	  font-weight: bold;
	}
	</style>
	</head>
	<body>
	<!-- this empty div is used for dpi-detection - do not remove it -->
	<div id="dpiDetection"></div>
	</body>
	</html>
<?php
	
}
else {
	//no session, open login panel
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
		<link rel="stylesheet" type="text/css" href="client/site/libs/ext/resources/css/ext-all.css"/>
		<link rel="stylesheet" type="text/css" href="admin/logindialog/css/overrides.css" />
        <link rel="stylesheet" type="text/css" href="admin/logindialog/css/flags.css" />
        <link rel="stylesheet" type="text/css" href="admin/logindialog/css/virtualkeyboard.css" />
   		
		<script type="text/javascript" src="client/site/libs/ext/adapter/ext/ext-base.js"></script>
		<script type="text/javascript" src="client/site/libs/ext/ext-all.js"></script>
        
		<script type="text/javascript">
			//bind PHP --> JS
			GLOBAL_LANG = '<?php echo $def_lang?>';
			GLOBAL_SERVER_OS = '<?php echo $server_os?>';
		</script>
		
		<script type="text/javascript" src="admin/languages/<?php echo $def_lang?>.js"></script>

		<script type="text/javascript" src="admin/logindialog/js/overrides.js"></script>

        <script type="text/javascript" src="admin/logindialog/js/virtualkeyboard.js"></script>
        <script type="text/javascript" src="admin/logindialog/js/plugins/virtualkeyboard.js"></script>
        <script type="text/javascript" src="admin/logindialog/js/Ext.ux.Crypto.SHA1.js"></script>
        <script type="text/javascript" src="admin/logindialog/js/Ext.ux.form.IconCombo.js"></script>
		<script type="text/javascript" src="admin/logindialog/js/Ext.ux.form.LoginDialog.js"></script>
        <script type="text/javascript" src="admin/logindialog/js/login.js"></script>
				
		</head>
		<body></body>
	</html>
	<?php
}
?>

