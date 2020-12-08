<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Redirect extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['tag', 'redirect_url', 'qr_code', 'visits', 'active'];


}
