<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name')]
class Country extends Model
{

}