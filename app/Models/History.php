<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;
    protected $table ='history';
    protected $fillable = [
        'account_id',
        'transfer_id',
        'user_id'
    ];
}
