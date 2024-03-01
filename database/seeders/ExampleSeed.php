<?php

use MrEssex\CubexSkeleton\System\Database\Seeder;

class ExampleSeed extends Seeder
{
  protected int $count = 10;

  public function run(): void
  {
    for($i = 0; $i < $this->count; $i++)
    {
      $this->table('example')->insert(
        $this->seedDates([
          'title'       => $this->faker->sentence,
          'description' => $this->faker->paragraph,
        ])
      )->save();
    }
  }
}
