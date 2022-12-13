<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memo extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * 認証ユーザーのメモを取得します
     *
     * @return void
     */
    public function getMyMemo()
    {
        $user_id = auth()->id();
        $memos = Memo::where('user_id', $user_id)
        ->orderBy('updated_at', 'DESC')
        ->get();
        return $memos;
    }

    public function folder()
    {
        return $this->belongsTo('App\Models\Folder');
    }

    protected $fillable = [
        'content', 'folder_id', 'status', 'deadline', 'user_id'
    ];
}
