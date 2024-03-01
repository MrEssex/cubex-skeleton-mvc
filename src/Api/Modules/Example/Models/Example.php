<?php

namespace MrEssex\CubexSkeleton\Api\Modules\Example\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $title
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Example extends Model
{
  protected $table = 'example';

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'title',
    'description',
  ];
}
