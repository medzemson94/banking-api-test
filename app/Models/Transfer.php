<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transfer extends Model
{
    use HasFactory;
    protected $table ='transfer';
    protected $fillable = [
        'Montant_transfert',
        'destinataire',
        'account_id'
         
    ];
}
