<?php

namespace MrEssex\CubexSkeleton\Api\Modules\Example\Procedures;

use Cubex\ApiFoundation\Module\Procedures\AbstractProcedure;
use MrEssex\CubexSkeleton\Api\ApiLogger;
use MrEssex\CubexSkeleton\Api\Modules\Example\Models\Example;
use MrEssex\CubexSkeletonTransport\Modules\Example\Payloads\CreateExamplePayload;
use MrEssex\CubexSkeletonTransport\Modules\Example\Responses\ExampleResponse;

class CreateExample extends AbstractProcedure
{
  public function execute(CreateExamplePayload $pl): ExampleResponse
  {
    $response = new ExampleResponse();

    $example = new Example();
    $example->title = $pl->title ?? "Title";
    $example->description = $pl->description ?? "description";

    try
    {
      $example->save();
      $response->hydrateFromArr($example->toArray());
    }
    catch(\Exception $exception)
    {
      ApiLogger::asError($exception);
    }

    return $response;
  }
}
