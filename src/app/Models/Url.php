<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rorecek\Ulid\HasUlid;


class Url extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUlid;

    protected $fillable = ['tag', 'destination', 'qr_code', 'visits', 'active'];

}
