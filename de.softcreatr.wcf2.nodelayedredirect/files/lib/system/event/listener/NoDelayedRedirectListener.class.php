<?php
namespace wcf\system\event\listener;
use wcf\system\event\IEventListener;
use wcf\system\request\LinkHandler;
use wcf\util\HeaderUtil;
use wcf\system\WCF;

/**
 * Prevent default behavior (delayed redirect after login/logout)
 * 
 * @author	Sascha Greuel <sascha@softcreatr.de>
 * @copyright	2013 Sascha Greuel
 * @license	Creative Commons BY-SA <http://creativecommons.org/licenses/by-sa/3.0/>
 * @package	de.softcreatr.wcf2.nodelayedredirect
 * @subpackage	system.event.listener
 * @category	Community Framework
 */
class NoDelayedRedirectListener implements IEventListener {
	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		// Delayed redirect is enabled, do nothing
		if (LOGIN_LOGOUT_REDIRECT) {
			return;
		}
		
		// Login
		if ($className == 'wcf\form\LoginForm') {
			HeaderUtil::redirect($eventObj->url);
		}
		
		// Logout
		if ($className == 'wcf\action\LogoutAction') {
			HeaderUtil::redirect(LinkHandler::getInstance()->getLink());
		}
	}
}
