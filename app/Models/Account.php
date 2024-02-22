<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    use HasFactory;
    protected $table ='account';
    protected $fillable = [
        'account_number',
        'solde',
        'user_id'
    ];
}
