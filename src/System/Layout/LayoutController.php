<?php

namespace MrEssex\CubexSkeleton\System\Layout;

use Cubex\Controller\AuthedController;
use Cubex\Middleware\MiddlewareHandler;
use MrEssex\CubexSkeleton\System\Layout\DefaultLayout\DefaultLayout;
use MrEssex\CubexSkeleton\System\Layout\LayoutWrap\LayoutWrap;
use MrEssex\CubexSkeleton\System\Ui\AbstractView;
use MrEssex\CubexSkeleton\System\Ui\Views\ErrorView\ErrorView;
use Packaged\Context\Context;
use Packaged\Dispatch\Dispatch;
use Packaged\Http\Responses\JsonResponse;
use Packaged\I18n\TranslatableTrait;
use Packaged\I18n\TranslatorAware;
use Packaged\I18n\TranslatorAwareTrait;
use Packaged\I18n\Translators\Translator;
use Packaged\Routing\Handler\FuncHandler;
use Packaged\Routing\Handler\Handler;
use Packaged\Ui\Element;
use Packaged\Ui\Html\HtmlElement;
use PackagedUI\Pagelets\PageletResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class LayoutController extends AuthedController implements TranslatorAware
{
  use TranslatableTrait;
  use TranslatorAwareTrait;

  public function __construct(protected Dispatch $dispatch, protected Translator $translator) { }

  public function processError(): Response
  {
    $cubex = @$this->_cubex();
    /** @var ErrorView $error */
    $error = $cubex->resolve(ErrorView::class);

    return Response::create($error->render(), 404);
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

    if($this->_isAjaxRequest())
    {
      if($this->_isPageletRequest())
      {
        $result = $result instanceof PageletResponse ? $result : PageletResponse::i()->setContent($result);
      }

      $result = JsonResponse::prefixed($result);
      return parent::_prepareResponse($c, $result, $buffer);
    }

    $theme = $this->getTheme()->setContent($result);
    $wrap = $this->_getLayoutWrap()->setContent($theme);

    return parent::_prepareResponse($c, $wrap, $buffer);
  }

  public function getTheme(): AbstractLayout
  {
    $cubex = @$this->_cubex();
    /** @var DefaultLayout $layout */
    $layout = $cubex->resolve(DefaultLayout::class);
    return $layout;
  }

  protected function _getLayoutWrap(): LayoutWrap
  {
    $cubex = @$this->_cubex();
    /** @var LayoutWrap $layout */
    $layout = $cubex->resolve(LayoutWrap::class);
    return $layout;
  }

  public function handle(Context $c): Response
  {
    $middleware = new MiddlewareHandler(
      new FuncHandler(fn(Context $c): Response => parent::handle($c))
    );
    foreach($this->_getMiddleware() as $m)
    {
      $middleware->add($m);
    }

    return $middleware->handle($c);
  }

  protected function _getMiddleware(): array
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

  protected function _isAjaxRequest(): bool
  {
    $c = $this->getContext();
    return $c->request()->isXmlHttpRequest();
  }

  protected function _isPageletRequest(): bool
  {
    $c = $this->getContext();
    return $c->request()->headers->has('x-pagelet-request');
  }

  protected function _getHandler(Context $context): callable|string|Handler|null
  {
    return parent::_getHandler($context) ?: 'error';
  }
}
