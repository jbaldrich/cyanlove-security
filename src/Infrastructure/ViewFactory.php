<?php declare( strict_types=1 );

/**
 * Cyan Love Security.
 *
 * @package   CyanLove\Security
 * @author    Cyan Lovers <hello@cyanlove.com>
 * @license   MIT
 * @link      https://cyanlove.com/security/
 * @copyright 2019 Cyan Lovers
 */

namespace CyanLove\Security\Infrastructure;

/**
 * The ViewFactory interface is the main access point to the rendering system.
 *
 * The way this works is that you declare a dependency on the ViewFactory
 * interface in the constructor of a class that needs to render something. If
 * this class is instantiated through the dependency injector, it will receive
 * whatever concrete ViewFactory has been configured and can just use that one
 * to create one or more view and subsequently render them.
 */
interface ViewFactory {

	/**
	 * Create a new view object for a given relative path.
	 *
	 * @param string $relative_path Relative path to create the view for.
	 * @return View Instantiated view object.
	 */
	public function create( string $relative_path ): View;
}
