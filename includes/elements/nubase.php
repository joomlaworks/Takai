<?php

/**
 * @version     2.0 (July 19th, 2013)
 * @package     Akhtarma
 * @author      Nuevvo - http://nuevvo.com
 * @copyright   Copyright (c) 2010 - 2013 Nuevvo Webware Ltd. All rights reserved.
 * @license     http://nuevvo.com/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldNuBase extends JFormField
{
    public $type = 'NuBase';

    public function getInput()
    {
        $template = $this->form->getValue('template');
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root(true).'/templates/'.$template.'/includes/elements/assets/css/style.css');
        JHtml::_('jquery.framework');

        $document->addScript(JURI::root(true).'/templates/'.$template.'/includes/elements/assets/js/behaviour.js');
        $document->addScriptDeclaration('
			WebFontConfig = {
				custom: {
					families: [\'entypoftp\'],
					urls: [\'//cdn.nuevvo.net/webfonts/entypoftp/css/fontello.css\']
				}
			};
			(function() {
				var wf = document.createElement(\'script\');
				wf.src = (\'https:\' == document.location.protocol ? \'https\' : \'http\') + \'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js\';
				wf.type = \'text/javascript\';
				wf.async = \'true\';
				var s = document.getElementsByTagName(\'script\')[0];
				s.parentNode.insertBefore(wf, s);
			})();
		');
        ob_start();
        include dirname(__FILE__).'/tmpl/settings.php';
        $contents = ob_get_clean();
        $this->form->removeGroup('params');
        return $contents;
    }

    public function getLabel()
    {
        return null;
    }

}
