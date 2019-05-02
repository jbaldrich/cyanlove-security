<?php

namespace CyanLove\Security\Tests\Integration;

use CyanLove\Security\Infrastructure\View;
use CyanLove\Security\Infrastructure\View\TemplatedView;
use CyanLove\Security\Infrastructure\View\TemplatedViewFactory;
use CyanLove\Security\Tests\ViewHelper;

final class TemplatedViewFactoryTest extends TestCase {

	public function test_it_can_create_views(): void {
		$factory = new TemplatedViewFactory( ViewHelper::LOCATIONS );

		$view = $factory->create( 'static-view' );
		$this->assertInstanceOf( TemplatedView::class, $view );
	}

	public function test_created_views_implement_the_interface(): void {
		$factory = new TemplatedViewFactory( ViewHelper::LOCATIONS );

		$view = $factory->create( 'static-view' );
		$this->assertInstanceOf( View::class, $view );
	}
}
