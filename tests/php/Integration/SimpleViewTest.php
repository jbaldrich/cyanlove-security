<?php

namespace CyanLove\Security\Tests\Integration;

use CyanLove\Security\Infrastructure\View\SimpleView;
use CyanLove\Security\Infrastructure\View\SimpleViewFactory;
use CyanLove\Security\Tests\ViewHelper;

final class SimpleViewTest extends TestCase {

	public function test_it_loads_partials_across_overrides(): void {
		$view = new SimpleView(
			ViewHelper::VIEWS_FOLDER . 'static-view',
			new SimpleViewFactory()
		);

		$this->assertStringStartsWith(
			'<p>Rendering works.</p>',
			$view->render()
		);
	}
}
