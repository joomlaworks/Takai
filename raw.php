<?php
/**
 * @version		2.0
* @package		Takai
 * @author		Nuevvo - http://nuevvo.com
 * @copyright Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license		http://nuevvo.com/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).'/includes/helper.php');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#">
	<head>
		<?php echo NU_HEAD_TOP; ?>
		<jdoc:include type="head" />
		<?php echo NU_HEAD_BOTTOM; ?>
	</head>
	<body id="<?php echo NU_BODY_ID; ?>" class="<?php echo NU_BODY_CLASS; ?>">
		<?php echo NU_BODY_TOP; ?>
		<jdoc:include type="message" />
		<jdoc:include type="component" />
		<?php echo NU_BODY_BOTTOM; ?>
	</body>
</html>
