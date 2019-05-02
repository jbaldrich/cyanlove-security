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
 * Interface to make the act of instantiation extensible/replaceable.
 *
 * This way, a more elaborate mechanism can be plugged in, like using
 * ProxyManager to instantiate proxies instead of actual objects.
 */
interface Instantiator {

	/**
	 * Make an object instance out of an interface or class.
	 *
	 * @param string $class        Class to make an object instance out of.
	 * @param array  $dependencies Optional. Dependencies of the class.
	 * @return object Instantiated object.
	 */
	public function instantiate( string $class, array $dependencies = [] );
}
