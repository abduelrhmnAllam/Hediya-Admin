<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftIdea extends Model
{
    use HasFactory;

    protected $table = 'gifts_idea';

    protected $fillable = [
        'user_id',
        'person_id',
        'file',
        'description',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
