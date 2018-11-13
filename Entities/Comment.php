<?php

namespace Modules\Guestbook\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Guestbook\Presenters\CommentPresenter;
use Modules\Media\Entities\File;

class Comment extends Model
{
    use PresentableTrait;

    protected $table = 'guestbook__comments';
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'subject', 'message', 'attachment', 'position','status'];
    protected $presenter = CommentPresenter::class;
    protected $casts = [
      'status' => 'int'
    ];

    public function attachment()
    {
        if(!\App::runningInConsole()) {
            return $this->hasOne(File::class, 'id', 'attachment');
        }
        return true;
    }

    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
