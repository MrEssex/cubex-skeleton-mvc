<?php
declare(strict_types=1);

use Arkitect\ClassSet;
use Arkitect\CLI\Config;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\NotHaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\Rule;
use MrEssex\CubexSkeleton\Modules\Module;

return static function (Config $config): void {
  $mvcClassSet = ClassSet::fromDir(__DIR__ . '/src');

  $rules = [];

  // Classes that implement the Module interface should have a name that ends with "Module"
  $rules[] = Rule::allClasses()
    ->that(new ResideInOneOfTheseNamespaces('MrEssex\CubexSkeleton\Modules'))
    ->andThat(new Implement(Module::class))
    ->should(new HaveNameMatching('*Module'))
    ->because('Modules that implement the Module interface should have a name that ends with "Module"');

  // Classes in the Services namespace should end with "Service"
  $rules[] = Rule::allClasses()
    ->that(new ResideInOneOfTheseNamespaces('MrEssex\CubexSkeleton\Services'))
    ->should(new HaveNameMatching('*Service'))
    ->because('Modules that implement the Module interface should have a name that ends with "Service"');

  // Classes in Services\Interfaces should end with "Service" and not include the word "Interface"
  $rules[] = Rule::allClasses()
    ->that(new ResideInOneOfTheseNamespaces('MrEssex\CubexSkeleton\Services\Interfaces'))
    ->should(new HaveNameMatching('*Service'))
    ->because('Modules that implement the Module interface should have a name that ends with "Service"');

  $rules[] = Rule::allClasses()
    ->that(new ResideInOneOfTheseNamespaces('MrEssex\CubexSkeleton\Services\Interfaces'))
    ->should(new NotHaveNameMatching('*Interface'))
    ->because('Modules that implement the Module interface should have a name that ends with "Service"');

  // Anything that implements abstract view should be have view suffix
  $rules[] = Rule::allClasses()
    ->that(new ResideInOneOfTheseNamespaces('MrEssex\CubexSkeleton\Views'))
    ->andThat(new Implement('MrEssex\CubexSkeleton\Views\AbstractView'))
    ->should(new HaveNameMatching('*View'))
    ->because('Anything that implements abstract view should be have view suffix');

  $config->add($mvcClassSet, ...$rules);
};
