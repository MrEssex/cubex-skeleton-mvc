<?php

namespace MrEssex\CubexSkeleton\Ui\Layout;

use Cubex\Controller\AuthedController;
use Cubex\Middleware\MiddlewareHandler;
use MrEssex\CubexSkeleton\Ui\AbstractView;
use MrEssex\CubexSkeleton\Ui\ErrorView\ErrorView;
use MrEssex\CubexSkeleton\Ui\Layout\DefaultLayout\DefaultLayout;
use Packaged\Context\Context;
use Packaged\Dispatch\Dispatch;
use Packaged\I18n\TranslatableTrait;
use Packaged\I18n\TranslatorAware;
use Packaged\I18n\TranslatorAwareTrait;
use Packaged\I18n\Translators\Translator;
use Packaged\Routing\Handler\FuncHandler;
use Packaged\Routing\Handler\Handler;
use Packaged\Ui\Element;
use Packaged\Ui\Html\HtmlElement;
use Symfony\Component\HttpFoundation\Response;

abstract class LayoutController extends AuthedController implements TranslatorAware
{
  use TranslatableTrait;
  use TranslatorAwareTrait;

  public function __construct(protected Dispatch $dispatch, protected Translator $translator) { }

  public function processError(): ErrorView
  {
    $cubex = @$this->_cubex();
    /** @var ErrorView $error */
    $error = $cubex->resolve(ErrorView::class);
    return $error;
  }

  protected function _prepareResponse(Context $c, $result, $buffer = null)
  {
    // Send the raw response if it's an ajax request or not appropriate for the layout
    if(!$this->_isAppropriateResponse($result))
    {
      return parent::_prepareResponse($c, $result, $buffer);
    }

    if($result instanceof AbstractView)
    {
      $result->requireResources($this->dispatch);
      $result = $result->render();
    }

    if($this->_isAjaxResponse())
    {
      return parent::_prepareResponse($c, $result, $buffer);
    }

    $theme = $this->getTheme();
    $theme->setContent($result);

    return parent::_prepareResponse($c, $theme, $buffer);
  }

  public function getTheme(): DefaultLayout
  {
    $cubex = @$this->_cubex();
    /** @var DefaultLayout $layout */
    $layout = $cubex->resolve(DefaultLayout::class);
    return $layout;
  }

  public function handle(Context $c): Response
  {
    $middleware = new MiddlewareHandler(
      new FuncHandler(fn(Context $c): Response => parent::handle($c))
    );
    foreach($this->_middleware() as $m)
    {
      $middleware->add($m);
    }

    return $middleware->handle($c);
  }

  protected function _middleware(): array
  {
    return [];
  }

  protected function _isAppropriateResponse($result): bool
  {
    return $result instanceof AbstractView ||
      $result instanceof Element ||
      $result instanceof HtmlElement ||
      is_scalar($result) ||
      is_array($result);
  }

  protected function _isAjaxResponse(): bool
  {
    $c = $this->getContext();
    return $c->request()->isXmlHttpRequest();
  }

  protected function _getHandler(Context $context): callable|string|Handler|null
  {
    return parent::_getHandler($context) ?: 'error';
  }
}
