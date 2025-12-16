<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatMessage
 *
 * تمثل رسالة داخل المحادثة (من المستخدم أو من البوت).
 * تحتوي على النص، التحليل العاطفي، والمعلومات الوصفية (meta).
 */
class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'role',
        'content',
        'meta',
        'sentiment_score',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * 🔗 العلاقة مع المحادثة.
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * 👤 العلاقة مع المستخدم.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}