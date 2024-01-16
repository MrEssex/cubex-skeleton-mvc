<?php

namespace MrEssex\CubexSkeleton\Api\Modules\Example\Procedures;

use Cubex\ApiFoundation\Module\Procedures\AbstractProcedure;
use MrEssex\CubexSkeleton\Api\ApiLogger;
use MrEssex\CubexSkeleton\Api\Modules\Example\Storage\Example;
use MrEssex\CubexSkeletonTransport\Modules\Example\Payloads\CreateExamplePayload;
use MrEssex\CubexSkeletonTransport\Modules\Example\Responses\ExampleResponse;

class CreateExample extends AbstractProcedure
{
  public function execute(CreateExamplePayload $pl): ExampleResponse
  {
    $example = new Example();
    $example->title = $pl->title;
    $example->description = $pl->description;

    try
    {
      $example->save();
    }
    catch(\Exception $exception)
    {
      ApiLogger::asError($exception);
      return new ExampleResponse();
    }

    /** @var ExampleResponse $res */
    $res = $example->toApiResponse();
    return $res;
  }
}
