<?php
/**
 * @version		1.0.0
 * @package		GetK2Demo
 * @author		Nuevvo - http://nuevvo.com
 * @copyright Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license		http://nuevvo.com/license
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(dirname(__FILE__).'/includes/helper.php');

?>
<!DOCTYPE html>
<!--[if lte IE 6]>		 <html class="isIE6 isIE6 lt-ie9" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"><![endif]-->
<!--[if IE 7]>				 <html class="isIE7 isIE7 lt-ie9" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"><![endif]-->
<!--[if IE 8]>         <html class="no-js ieIE8 lt-ie9" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"> <!--<![endif]-->
	<head>
		<?php echo NU_HEAD_TOP; ?>
		<jdoc:include type="head" />
		<?php echo NU_HEAD_BOTTOM; ?>
	</head>

	<body id="<?php echo NU_BODY_ID; ?>" class="<?php echo NU_BODY_CLASS; ?>">
			<?php echo NU_BODY_TOP; ?>
			<header class="row">

				<jdoc:include type="message" />

				<?php if ($this->countModules('getK2-login')): ?>
				<div class="small-8 large-4 loginArea">
					<jdoc:include type="modules" name="getK2-login" style="" />
				</div>
				<?php endif; ?>

				<div class="column small-12 large-5 LogoArea">
					<h1 id="Logo">
						<a href="<?php echo $this->baseurl ?>" title="<?php echo $this->params->get('siteLogoAltText'); ?>">
							<?php if($this->params->get('siteLogo')): ?>
							<img src="<?php echo $this->params->get('siteLogo'); ?>" alt="<?php echo $this->params->get('siteLogoAltText'); ?>" />
							<span class="hidden"><?php echo $this->params->get('siteLogoAltText'); ?></span>
							<?php else: ?>
							<span><?php echo $this->params->get('siteTextAsLogo'); ?></span>
							<?php endif; ?>
						</a>
					</h1>
				</div>

				<?php if($this->countModules('getK2-Main-Menu')): ?>
				<a class="menuToggler hide-on-large show-on-small" href="#"></a>
				<nav class="column small-10 large-7 MenuArea" id="mainNavigation">
					<div class="menuWrapper">
						<span class="menuCloseButton"></span>
						<jdoc:include type="modules" name="getK2-Main-Menu" style="getk2" />
					</div>
				</nav>
				<?php endif; ?>

				<div class="clr"></div>

				<?php if ($this->params->get('siteTagline')): ?>
				<div class="column small-12 TagLine">
					<h2 class="MotoHeader"><?php echo htmlspecialchars($this->params->get('siteTagline'));?></h2>
				</div>
				<?php endif; ?>

				<?php if( $this->countModules('getK2-Leaderboard') ): ?>
				<div class="column small-12 Leaderboard">
					<jdoc:include type="modules" name="getK2-Leaderboard" style="getk2"/>
				</div>
				<?php endif; ?>
			</header>

			<div class="row">

				<section id="content" class="column small-12 <?php echo $sideBarCheck; ?>">
					<?php
						// The main section 'column' of the site
						// The Checks bellow add the appropriate CCS classes to the columns
						// The Classes are different for - The Home Page , the itemList View and the item View
						// the checks are included on the helper.php file
						// The catalogue check is done in the K2 Templates
					?>
					<div class="column small-12 <?php echo $viewCheck; ?> layoutGrid">

						<?php if($this->countModules('getK2-breadcrumbs')): ?>
						<div class="breadcrumbs">
							<jdoc:include type="modules" name="getK2-breadcrumbs" style=""/>
						</div>
						<?php endif; ?>

						<?php if($this->countModules('getK2-component')): ?>
						<jdoc:include type="modules" name="getK2-component" style="getk2"/>
						<?php else: ?>
						<jdoc:include type="component" />
						<?php endif; ?>

					</div>

					<?php if($this->countModules('getK2-Inner-Right')): ?>
					<div class="column small-12 large-4 innerRight">
						 <jdoc:include type="modules" name="getK2-Inner-Right" style="getk2" />
					</div>
					<?php endif; ?>

					<div class="clr"></div>

					<?php if($this->countModules('getK2-Index-Middle-Bottom')): ?>
					<div class="column small-12 large-12 indexLower">
						 <jdoc:include type="modules" name="getK2-Index-Middle-Bottom" style="getk2" />
					</div>
					<?php endif; ?>
				</section>

				<?php if($this->countModules('getK2-SideBarLower or getK2-SideModulesLeft or getK2-SideModulesRight or getK2-SideBarLower')): ?>
				<aside id="sidebar" class="column small-12 large-4">

					<?php if($this->countModules('getK2-SideBarLower')): ?>
					<jdoc:include type="modules" name="getK2-SideBar" style="getk2" />
					<?php endif; ?>

					<?php if($this->countModules('getK2-Tab1 or getK2-Tab2 or getK2-Tab3')): ?>
					<ul class="moduleTabs">
						<?php if($this->params->get('sidebartabsleft')): ?><li><?php echo htmlspecialchars($this->params->get('sidebartabsleft'));?></li> <?php endif; ?>
						<?php if($this->params->get('sidebartabsmiddle')): ?><li><?php echo htmlspecialchars($this->params->get('sidebartabsmiddle'));?></li> <?php endif; ?>
						<?php if($this->params->get('sidebartabsright')): ?><li><?php echo htmlspecialchars($this->params->get('sidebartabsright'));?></li> <?php endif; ?>
					</ul>
					<div class="tabbedModules">
						<?php if($this->countModules('getK2-Tab1')): ?>
						<div class="Moduletab">
							<jdoc:include type="modules" name="getK2-Tab1" style="getk2" />
						</div>
						<?php endif; ?>
						<?php if($this->countModules('getK2-Tab2')): ?>
						<div class="Moduletab">
							<jdoc:include type="modules" name="getK2-Tab2" style="getk2" />
						</div>
						<?php endif; ?>
						<?php if($this->countModules('getK2-Tab3')): ?>
						<div class="Moduletab">
							<jdoc:include type="modules" name="getK2-Tab3" style="getk2" />
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>

					<?php if($this->countModules('getK2-SideBarLower')): ?>
					<jdoc:include type="modules" name="getK2-SideBarLower" style="getk2" />
					<?php endif; ?>

				</aside>
				<?php endif; ?>

			</div>

		<footer class="row">
			<?php if($this->countModules('getK2-Footer-Left or getK2-Footer-Middle or getK2-Footer-Right or getK2-Footer-Top')): ?>
			<div class="column small-12 Footerwrap isFontIstok">
				<?php if($this->countModules('getK2-Footer-Top')): ?>
				<div class="FooterTop">
					<jdoc:include type="modules" name="getK2-Footer-Top" style="getk2" />
				</div>
				<div class="clr"></div>
				<?php endif; ?>

				<?php if($this->countModules('getK2-Footer-Left or getK2-Footer-Middle or getK2-Footer-Right')): ?>
				<div class="column small-12 FooterTopMiddle">
					<?php if($this->countModules('getK2-Footer-Left')): ?>
					<div class="column small-12 large-5 FooterLeft equal">
						<jdoc:include type="modules" name="getK2-Footer-Left" style="getk2" />
					</div>
					<?php endif; ?>

					<?php if($this->countModules('getK2-Footer-Middle')): ?>
					<div class="column small-6 large-5 FooterMiddle equal">
						<jdoc:include type="modules" name="getK2-Footer-Middle" style="getk2" />
					</div>
					<?php endif; ?>

					<?php if($this->countModules('getK2-Footer-Right')): ?>
					<div class="column small-6 large-2 FooterRight equal">
						<jdoc:include type="modules" name="getK2-Footer-Right" style="getk2" />
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="clr"></div>
			<?php endif; ?>

			<div class="column small-12 cwrap isFontIstok">
				<div class="column small-12 large-6 copyrights">
					<small><?php echo NU_COPYRIGHTS; ?>. <?php echo JText::_('TPL_NU_FE_ALL_RIGHTS_RESERVED'); ?>.</small>
				</div>
				<div class="column small-12 large-6 textRight credits">
					<small><?php echo NU_CREDITS; ?></small>
				</div>
			</div>
		</footer>

		<?php echo NU_BODY_BOTTOM; ?>
		<jdoc:include type="modules" name="debug" />

	</body>
</html>