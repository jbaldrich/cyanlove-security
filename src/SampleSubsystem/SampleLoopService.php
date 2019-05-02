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

namespace CyanLove\Security\SampleSubsystem;

use CyanLove\Security\Infrastructure\{
	Conditional,
	Delayed,
	Registerable,
	Service,
	ViewFactory
};
use WP_Post;

final class SampleLoopService implements Service, Registerable, Conditional, Delayed {

	/**
	 * We only want to register this service once the loop has been set up, as
	 * we want to use smart injection to retrieve the current post.
	 */
	private const REGISTRATION_HOOK = 'wp';

	/** @var ViewFactory */
	private $view_factory;

	/** @var WP_Post */
	private $post;

	/**
	 * Check whether the conditional service is currently needed.
	 *
	 * @return bool Whether the conditional service is needed.
	 */
	public static function is_needed(): bool {
		/*
		 * We only load this sample service on the frontend when a singular post
		 * is shown.
		 * If this conditional returns false, the service is never even
		 * instantiated.
		 */
		return \is_singular();
	}

	/**
	 * Get the action to use for registering the service.
	 *
	 * @return string Registration action to use.
	 */
	public static function get_registration_action(): string {
		return self::REGISTRATION_HOOK;
	}

	/**
	 * Instantiate a SampleLoopService object.
	 *
	 * @param ViewFactory $view_factory View factory to use for instantiating
	 *                                  the views.
	 * @param WP_Post     $post         WordPress post object to use.
	 */
	public function __construct( ViewFactory $view_factory, WP_Post $post ) {
		/*
		 * We request a view factory from the injector so that we can create a
		 * new view to be rendered when we want to show our sample notice.
		 */
		$this->view_factory = $view_factory;

		/*
		 * We also use the injector to retrieve the current post in the loop, to
		 * demonstrate how delegation and delayed registration works.
		 *
		 * Although we use "up-front" dependency injection, we have our service
		 * be registered in a delayed fashion to only do the actual injection
		 * after the WordPress loop has been set up, a requirement for the
		 * delegation to be able to retrieve the "current" post.
		 */
		$this->post = $post;
	}

	/**
	 * Register the service.
	 *
	 * @return void
	 */
	public function register(): void {
		/*
		 * The register method now hooks our actual sample functionality into
		 * the WordPress execution flow.
		 */
		\add_filter( 'the_content', [ $this, 'prepend_post_header' ] );
	}

	/**
	 * Prepend a post header to the content.
	 *
	 * @param string $content The content to be filtered.
	 * @return string Filtered content prepended with a post header.
	 */
	public function prepend_post_header( $content ): string {
		/*
		 * As we already have an instance of the view factory available, it is
		 * now easy to create a new view and render it.
		 */
		$post_header = $this->view_factory->create( 'views/test-loop-service' )
		                                  ->render( [ 'post' => $this->post ] );

		return $post_header . $content;
	}
}
