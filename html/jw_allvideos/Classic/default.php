<?php
/**
 * @version		1.0.0
* @package		Takai
 * @author		Nuevvo - http://nuevvo.com
 * @copyright Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license		http://nuevvo.com/license
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<div class="avPlayerWrapper">
	<div style="width:<?php echo $output->playerWidth; ?>px;" class="avPlayerContainer">
		<div id="<?php echo $output->playerID; ?>" class="avPlayerBlock">
			<?php echo $output->player; ?>
		</div>
	</div>
</div>
