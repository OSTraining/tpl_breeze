/**
 * @package     Joomla.Site
 * @subpackage  Templates.breeze
 * @copyright   Copyright (C) 2009, 2013 OSTraining.com
 * @license     GNU General Public License version 2 or later; see license.txt
 * @since       3.2
 */

(function($)
{
	$(document).ready(function()
	{
		$('#mainmenu').mobileMenu({
            defaultText: 'Menu',
            className: 'mobilemenu',
            subMenuDash: '&ndash;'
        });
        $(".mobilemenu").each(function(){
            $(this).wrap('<div class="mobilemenu_wrapper">');
        });
	})
})(jQuery);