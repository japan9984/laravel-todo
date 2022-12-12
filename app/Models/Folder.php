<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getMyFolder(){
        $user_id = auth()->id();
        $folders = Folder::where('user_id', $user_id)
        ->orderBy('id', 'DESC')
        ->get();

        return $folders;
    }

    public function memo()
    {
        return $this->hasMany('App\Models\Memo');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected $fillable = [
        'folder', 'user_id'
    ];

}
