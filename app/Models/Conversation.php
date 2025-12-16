<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Conversation
 *
 * يمثل جلسة محادثة واحدة بين المستخدم والذكاء الصناعي.
 * تحتوي على لغة المستخدم، اللهجة، الموضوع، والملخص.
 */
class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'lang',
        'dialect',
        'topic',
        'summary',
        'meta',
    ];

    protected $casts = [
        'summary' => 'array',
        'meta' => 'array',
    ];

    /**
     * 🔗 العلاقة مع المستخدم.
     * كل محادثة تعود إلى مستخدم واحد.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 💬 العلاقة مع الرسائل.
     * كل محادثة تحتوي على عدة رسائل.
     */
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}