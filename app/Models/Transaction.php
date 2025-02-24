<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions'; // Define a tabela associada ao model

    protected $fillable = [
        'description',
        'amount',
        'date',
        'category',
        'status'
    ];

    protected $dates = ['deleted_at']; // Para Soft Delete

    // Relação com Usuário (se necessário)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
