<?php

namespace MrEssex\CubexSkeleton\Api\Modules\Event\Procedures;

use Cubex\ApiFoundation\Module\Procedures\AbstractProcedure;
use DeviceDetector\Cache\PSR16Bridge;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use Exception;
use MrEssex\CubexSkeleton\Api\Modules\Event\Storage\Event;
use MrEssex\CubexSkeleton\System\ErrorLogger;
use MrEssex\CubexSkeletonTransport\Modules\Event\Payloads\CreateEventPayload;
use MrEssex\CubexSkeletonTransport\Modules\Event\Responses\EventResponse;
use MrEssex\FileCache\ApcuCache;
use Packaged\Helpers\Arrays;
use Packaged\QueryBuilder\Predicate\EqualPredicate;
use Packaged\QueryBuilder\Predicate\GreaterThanPredicate;

class CreateEvent extends AbstractProcedure
{
  public function execute(CreateEventPayload $pl): EventResponse
  {

    if($this->_trackedInLastHour($pl))
    {
      return new EventResponse();
    }

    try
    {
      $device = $this->_deviceDetector();
      $ip = $this->_getClientIp();

      $event = new Event();
      $event->ip = $ip;
      $event->page = $this->_getPage($pl);
      $event->type = $pl->n;
      $event->save();

      /** @var EventResponse $res */
      $res = $event->toApiResponse();
      return $res;
    }
    catch(Exception $exception)
    {
      ErrorLogger::asError($exception);
      return new EventResponse();
    }
  }

  private function _deviceDetector(): DeviceDetector
  {
    $userAgent = (string)$this->getContext()->request()->userAgent();
    $clientHints = ClientHints::factory($this->getContext()->request()->headers->all());

    $dd = new DeviceDetector($userAgent, $clientHints);
    $dd->setCache(new PSR16Bridge(new ApcuCache()));
    $dd->parse();
    return $dd;
  }

  private function _trackedInLastHour(CreateEventPayload $pl): bool
  {
    try
    {
      $existing = Event::loadOneWhere(
        [
          GreaterThanPredicate::create('createdAt', time() - 3600),
          EqualPredicate::create('ip', $this->_getClientIp()),
          EqualPredicate::create('page', $this->_getPage($pl)),
        ]
      );
    }
    catch(Exception $exception)
    {
      ErrorLogger::asError($exception);
      return false;
    }

    return $existing !== null;
  }

  private function _getClientIp(): string
  {
    return $this->getContext()->request()->getClientIp();
  }

  private function _getPage(CreateEventPayload $pl): string
  {
    if($pl->u === null)
    {
      return 'unknown';
    }

    $parts = explode('/', $pl->u);
    $last = Arrays::last($parts);
    if($last === '')
    {
      $last = 'index';
    }

    return $last ?? '';
  }
}
