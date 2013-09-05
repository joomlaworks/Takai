<?php
/**
 * @version		1.0.0
 * @package		GetK2Demo
 * @author		Nuevvo - http://nuevvo.com
 * @copyright Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license		http://nuevvo.com/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/* -------------------- API Calls & Assignments -------------------- */
$app					= JFactory::getApplication();
$document 		= JFactory::getDocument();
$language			= JFactory::getLanguage();

$sitename			= $app->getCfg('sitename');
$sitetemplate	= $app->getTemplate();

$siteurl			= JURI::base();
$siterelpath	= $this->baseurl;
$siteabspath	= JPATH_SITE;
$templatePath = JURI::base(true).'/templates/'.$this->template;



/* -------------------- Requests -------------------- */
$option 			= JRequest::getCmd('option');
$view 				= JRequest::getCmd('view');
$layout 			= JRequest::getCmd('layout');
$page 				= JRequest::getCmd('page');
$task 				= JRequest::getCmd('task');
$id 					= JRequest::getInt('id');
$itemid 			= JRequest::getInt('Itemid');
$tmpl 				= JRequest::getCmd('tmpl');



/* -------------------- Helper Functions -------------------- */
// Convert language strings to a JSON friendly format for the error/offline pages
function nuText($str){
	return str_replace("'","\\'",JText::_($str));
}



/* -------------------- Frontpage Check -------------------- */
$menu = $app->getMenu();
if($menu->getActive() == $menu->getDefault()) $isFrontpage = true; else $isFrontpage = false;



/* -------------------- HTML5 Document for Joomla! 3.x -------------------- */
if(version_compare(JVERSION, '3.0', 'ge')!==false){
	$document->setHtml5(true);
}



/* -------------------- Meta Information -------------------- */
if(version_compare(JVERSION, '3.0', 'ge')!==false){
	$document->setMetaData('X-UA-Compatible', 'IE=edge,chrome=1', true);
	$document->setMetaData('imagetoolbar', 'false', true);
} else {
	$topMetaTags = '
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
		<meta http-equiv="imagetoolbar" content="false" />
	';
}

$document->setMetaData('viewport', 'width=device-width, user-scalable=0, initial-scale=1.0');
$document->setMetaData('apple-mobile-web-app-capable', 'yes');

$document->setMetaData('distribution', $this->params->get('nutpMetaDistribution'));

$document->setMetaData('designer', $this->params->get('nutpCreditsName').' - '.$this->params->get('nutpCreditsLink'));
$creditsMessage = '<a target="_blank" title="'.htmlentities($this->params->get('nutpCreditsName', 'Designed by Nuevvo'), ENT_QUOTES, 'utf-8').'" href="'.$this->params->get('nutpCreditsLink', 'http://nuevvo.com').'">'.$this->params->get('nutpCreditsName', 'designed by Nuevvo').'</a>';

if($this->params->get('nutpCopyrightStartYear') && $this->params->get('nutpCopyrightStartYear') < date('Y')){
	$metaCopyrightMessage = 'Copyright (c) '.$this->params->get('nutpCopyrightStartYear').' - '.date('Y').' '.htmlentities($this->params->get('nutpCopyright', $sitename), ENT_QUOTES, 'utf-8');
	$copyrightMessage = 'Copyright &copy; '.$this->params->get('nutpCopyrightStartYear').' - '.date('Y').' '.$this->params->get('nutpCopyright', $sitename);
} else {
	$metaCopyrightMessage = 'Copyright (c) '.date('Y').' '.htmlentities($this->params->get('nutpCopyright', $sitename), ENT_QUOTES, 'utf-8');
	$copyrightMessage = 'Copyright &copy; '.date('Y').' '.$this->params->get('nutpCopyright', $sitename);
}
$document->setMetaData('copyright', $metaCopyrightMessage);

if($this->params->get('nutpGoogleVerificationID'))	$document->setMetaData('verify-v1', $this->params->get('nutpGoogleVerificationID'));
if($this->params->get('nutpBingVerificationID')) 		$document->setMetaData('msvalidate.01', $this->params->get('nutpBingVerificationID'));
if($this->params->get('nutpAlexaVerificationID')) 	$document->setMetaData('alexaVerifyID', $this->params->get('nutpAlexaVerificationID'));

// Custom global RSS/Atom feeds
if($this->params->get('nutpFeedLink1') && $this->params->get('nutpFeedLink1Title')){
	$document->addHeadLink($this->params->get('nutpFeedLink1'), 'alternate', 'rel', array('type'=>'application/rss+xml', 'title'=>$this->params->get('nutpFeedLink1Title')));
}
if($this->params->get('nutpFeedLink2') && $this->params->get('nutpFeedLink2Title')){
	$document->addHeadLink($this->params->get('nutpFeedLink2'), 'alternate', 'rel', array('type'=>'application/rss+xml', 'title'=>$this->params->get('nutpFeedLink2Title')));
}
if($this->params->get('nutpFeedLink3') && $this->params->get('nutpFeedLink3Title')){
	$document->addHeadLink($this->params->get('nutpFeedLink3'), 'alternate', 'rel', array('type'=>'application/rss+xml', 'title'=>$this->params->get('nutpFeedLink3Title')));
}

// Open Graph
if($isFrontpage){
	$ogMetaTags = '
	<!-- Open Graph -->
	<meta property="og:title" content="'.$this->params->get('nutpOpenGraphTitle', $sitename).'" />
	<meta property="og:description" content="'.$this->params->get('nutpOpenGraphDescription', $app->getCfg('MetaDesc')).'" />
	<meta property="og:url" content="'.$this->params->get('nutpOpenGraphURL', $siteurl).'" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="'.$siteurl.$this->params->get('nutpOpenGraphImage','templates/'.$this->template.'/includes/images/facebook/facebook.jpg').'" />
	<meta property="fb:app_id" content="'.$this->params->get('nutpFacebookAppID','').'" />
	';
	$document->setMetaData('twitter:card', 'summary');
	if($this->params->get('nutpSocialTwitter')) $document->setMetaData('twitter:creator', '@'.$this->params->get('nutpSocialTwitter'));
	$document->setMetaData('twitter:title', $this->params->get('nutpOpenGraphTitle', $sitename));
	$document->setMetaData('twitter:description', $this->params->get('nutpOpenGraphDescription', $app->getCfg('MetaDesc')));
	$document->setMetaData('twitter:image', $siteurl.$this->params->get('nutpOpenGraphImage','templates/'.$this->template.'/images/defaults/facebook.jpg'));
}

// Apple Touch Icons
$document->addHeadLink($this->params->get('nutpIconIOS57x57', $templatePath.'/includes/images/ios/icon.png'), 'apple-touch-icon', 'rel');
$document->addHeadLink($this->params->get('nutpIconIOS72x72', $templatePath.'/includes/images/ios/icon-72.png'), 'apple-touch-icon', 'rel', array('sizes'=>'72x72'));
$document->addHeadLink($this->params->get('nutpIconIOS114x114', $templatePath.'/includes/images/ios/icon@2x.png'), 'apple-touch-icon', 'rel', array('sizes'=>'114x114'));
$document->addHeadLink($this->params->get('nutpIconIOS144x144', $templatePath.'/includes/images/ios/icon-72@2x.png'), 'apple-touch-icon', 'rel', array('sizes'=>'144x144'));

// Remove the canonical meta tag in Joomla! 3.x
if(version_compare(JVERSION, '3.0', 'ge')!==false && $this->params->get('nutpRemoveCanonicalMeta', 0)){
	foreach($document->_links as $key => $link){
		if ($link['relation']=='canonical'){
			unset($document->_links[$key]);
		}
	}
}

// Force load Bootstrap
if(version_compare(JVERSION, '3.0', 'ge')!==false && $this->params->get('nutpForceLoadBootstrap', 0)){
	JHtml::_('bootstrap.framework');
}

/* -------------------- Set the <body> class -------------------- */
$bodyClass = '';
if($isFrontpage) 				$bodyClass .= ' isFrontpage';
if($view) 							$bodyClass .= ' viewIs'.ucfirst($view);
if($layout) 						$bodyClass .= ' layoutIs'.ucfirst($layout);
if($page) 							$bodyClass .= ' pageIs'.ucfirst($page);
if($task) 							$bodyClass .= ' taskIs'.ucfirst($task);
if($id) 								$bodyClass .= ' idIs'.ucfirst($id);
if($itemid) 						$bodyClass .= ' itemIdIs'.ucfirst($itemid);
if($tmpl) 							$bodyClass .= ' tmplIs'.ucfirst($tmpl);
if($tmpl=='component') 	$bodyClass .= ' contentpane component componentWrapper';
if($tmpl=='raw')				$bodyClass .= ' rawWrapper';
$bodyClass = trim($bodyClass);

/* -------------------- Special Template Positions -------------------- */
$nuHeadTop = ($this->params->get('nutpHeadTop')) ? $this->params->get('nutpHeadTop')."\n" : '';
if(version_compare(JVERSION, '3.0', 'ge')===false) $nuHeadTop .= $topMetaTags;

$nuHeadBottom = $this->params->get('nutpHeadBottom');
$nuHeadBottom .= ($ogMetaTags) ? $ogMetaTags : '';
$nuHeadBottom .= '
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
	<![endif]-->
';
if($this->params->get('nutpGAID')){
	$nuHeadBottom .= '
	<!-- Google Analytics -->
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push([\'_setAccount\', \'UA-'.$this->params->get('nutpGAID').'\']);';
		if($this->params->get('nutpGADomain')){
		$nuHeadBottom .= '
		_gaq.push([\'_setDomainName\', \'.'.$this->params->get('nutpGADomain').'\']);';
		}
		$nuHeadBottom .= '
		_gaq.push([\'_trackPageview\']);

		(function() {
			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	';
}
$nuHeadBottom = ($nuHeadBottom) ? $nuHeadBottom."\n" : '';

$nuBodyId = $option;

$nuBodyClass = $bodyClass;

$nuBodyTop = ($this->params->get('nutpBodyTop')) ? $this->params->get('nutpBodyTop')."\n" : '';

$nuBodyBottom = ($this->params->get('nutpBodyBottom')) ? $this->params->get('nutpBodyBottom')."\n" : '';



/* -------------------- Sub-templates -------------------- */
/* component.php */
if($tmpl=='component'){
	// do stuff here for the component sub-template
}

/* raw.php */
if($tmpl=='raw'){
	// do stuff here for the raw sub-template
}

/* -------------------- JS Handling -------------------- */
if(!in_array($tmpl, array('error','offline','raw')) && $app->getCfg('offline')!=1){
	// Load jQuery
	$nutpJqueryHandling = $this->params->get('nutpJqueryHandling','1.10.1');
	if(version_compare(JVERSION, '3.0', 'ge')!==false){
		JHtml::_('jquery.framework');
	} else {
		if($nutpJqueryHandling){
			$document->addScript('//ajax.googleapis.com/ajax/libs/jquery/'.$nutpJqueryHandling.'/jquery.min.js');
		}
	}
	// Template JS
	$document->addScript(JURI::base(true).'/templates/'.$this->template.'/js/behaviour.js');
}

/* -------------------- CSS Handling [CAN EDIT] -------------------- */
// Google Web Fonts

// Load additional Google Web Fonts per language
switch($language->getTag()){
	case 'el-GR';
		$document->addStyleSheet('//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,700,800&subset=latin,greek-ext,greek');
		break;
	case 'vi-VN';
		$document->addStyleSheet('//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,700,800&subset=latin,vietnamese');
		break;
	default:
		$document->addStyleSheet('//fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic|Istok+Web:400,700,400italic,700italic&subset=latin,cyrillic');
}


// Template CSS
switch($tmpl){
	case 'index';
		$document->addStyleSheet(JURI::base(true).'/templates/'.$this->template.'/css/template.css');
		break;
	case 'component';
		$document->addStyleSheet(JURI::base(true).'/templates/'.$this->template.'/css/component.css');
		break;
	case 'raw';
		// No CSS for the raw.php sub-template
		break;
	default:
		if($app->getCfg('offline')!=1){
			$document->addStyleSheet(JURI::base(true).'/templates/'.$this->template.'/css/template.css');
		}
}

// Variations
if($app->getCfg('offline')!=1){
	include_once(dirname(__FILE__).'/variations.php');
}

// Custom CSS
$document->addStyleSheet(JURI::base(true).'/templates/'.$this->template.'/css/custom.css');

/* -------------------- Social Links/Icons -------------------- */
$socialProviders = array(
	"siteSocialFacebook" => "https://www.facebook.com/",
	"siteSocialTwitter" => "https://twitter.com/",
	"siteSocialGooglePlus" => "https://plus.google.com/",
	"siteSocialFoursquare" => "https://foursquare.com/",
	"siteSocialYouTube" => "http://www.youtube.com/",
	"siteSocialVimeo" => "http://vimeo.com/",
	"siteSocialDailymotion" => "http://www.dailymotion.com/",
	"siteSocialSoundCloud" => "https://soundcloud.com/",
	"siteSocialMixCloud" => "http://www.mixcloud.com/",
	"siteSocialFlickr" => "http://www.flickr.com/photos/",
	"siteSocialInstagram" => "http://instagram.com/",
	"siteSocialPinterest" => "http://pinterest.com/",
	"siteSocial500px" => "http://500px.com/",
	"siteSocialDribbble" => "http://dribbble.com/",
	"siteSocialBehance" => "http://www.behance.net/",
	"siteSocialGithub" => "https://github.com/"
);
$social = array();
foreach($socialProviders as $socialProviderParam => $socialProviderURL){
	if($this->params->get($socialProviderParam)!=''){
		$socialObject = new JObject;
		$socialObject->name = str_replace('siteSocial', '', $socialProviderParam);
		$socialObject->url = $socialProviderURL.$this->params->get($socialProviderParam);
		$socialObject->class = strtolower($socialObject->name);
		$social[] = $socialObject;
	}
}
/* Usage: loop through the $social array of objects */


/* -------------------- Meta Tag Processing -------------------- */
// Sort meta tags (for the purists)
//ksort($document->_metaTags['standard']);


/* -------------------- Template Constants -------------------- */
if(!defined('NU_HEAD_TOP')) 		define('NU_HEAD_TOP', $nuHeadTop);
if(!defined('NU_HEAD_BOTTOM')) 	define('NU_HEAD_BOTTOM', $nuHeadBottom);
if(!defined('NU_BODY_ID')) 			define('NU_BODY_ID', $nuBodyId);
if(!defined('NU_BODY_CLASS')) 	define('NU_BODY_CLASS', $nuBodyClass);
if(!defined('NU_BODY_TOP')) 		define('NU_BODY_TOP', $nuBodyTop);
if(!defined('NU_BODY_BOTTOM')) 	define('NU_BODY_BOTTOM', $nuBodyBottom);
if(!defined('NU_COPYRIGHTS')) 	define('NU_COPYRIGHTS', $copyrightMessage);
if(!defined('NU_CREDITS')) 			define('NU_CREDITS', $creditsMessage);
if(!defined('NU_CDN')) 					define('NU_CDN', 'http://cdn.nuevvo.net');

/* -------------------- Layout Check (template specific) -------------------- */
$viewCheck 		= ($this->countModules('getK2-Inner-Right'))?' large-8 indexLeft':' large-12 itemlistColumn';
$layoutCheck 	= ((!$isFrontpage))?'threeColLayout':'twoColLayout';
$sideBarCheck	=	($this->countModules('getK2-SideBarLower or SideModulesLeft or SideModulesRight or SideBarLower'))?'large-8':'';
