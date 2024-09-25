<?php

namespace MrEssex\CubexSkeleton\Api;

interface Seeder
{
  public function name(): string;

  public function count(): int;

  public function seed();
}
