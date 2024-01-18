<?php

namespace MrEssex\CubexSkeleton\Tests\Ui\Layout\DefaultLayout;

use MrEssex\CubexSkeleton\Dispatcher;
use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use MrEssex\CubexSkeleton\Ui\Layout\DefaultLayout\DefaultLayout;
use Packaged\Context\Context;

class DefaultLayoutTest extends SharedTestCase
{
  public function testDefaultLayout(): void
  {
    $ctx = $this->_testContext(null, Context::ENV_PROD);
    $dispatch = Dispatcher::create($ctx);
    $layout = new DefaultLayout($dispatch);

    self::assertEquals($dispatch, $layout->dispatch);

    // Test render fails with no content set
    try
    {
      $layout->render();
    }
    catch(\Exception $e)
    {
      self::assertMatchesRegularExpression('/\$_content must not be accessed before initialization/', $e->getMessage());
    }

    // Will render without any content
    $layout->setContent("");
    $content = $layout->render();

    // Assert the default layout contains the required resources
    self::assertStringContainsString('main.min.css', $content);
    self::assertStringContainsString('main.min.js', $content);

    // Assert the required resources are correct tags
    self::assertMatchesRegularExpression(
      '/<link href="(.*)main.min.css" rel="stylesheet" type="text\/css">/',
      $content
    );
    self::assertMatchesRegularExpression(
      '/<script src="(.*)main.min.js"><\/script>/',
      $content
    );

    // Assert the default layout contains the div tag with id="main" with no content
    self::assertMatchesRegularExpression('/<main id="main">((.|\n)*)<\/main>/', $content);

    // Assert we can add content to the layout
    $layout->setContent('Hello World');
    $content = $layout->render();

    self::assertStringContainsString('Hello World', $content);
    self::assertMatchesRegularExpression('/<main id="main">((.|\n)*)Hello World((.|\n)*)<\/main>/', $content);
  }
}
