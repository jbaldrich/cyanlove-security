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

namespace CyanLove\Security\Tests;

interface ViewHelper {

	public const VIEWS_FOLDER = 'tests/php/Fixture/views/';

	public const CHILD_THEME_FOLDER  = self::VIEWS_FOLDER . 'child_theme';
	public const PARENT_THEME_FOLDER = self::VIEWS_FOLDER . 'parent_theme';
	public const PLUGIN_FOLDER       = self::VIEWS_FOLDER . 'plugin';

	public const LOCATIONS = [
		self::CHILD_THEME_FOLDER,
		self::PARENT_THEME_FOLDER,
		self::PLUGIN_FOLDER,
	];
}
