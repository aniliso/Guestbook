<?php namespace Modules\Guestbook\Presenters;

use Modules\Core\Models\Status;
use Modules\Core\Presenters\BasePresenter;

class CommentPresenter extends BasePresenter
{
    protected $zone     = 'commentImage';
    protected $slug     = 'slug';
    protected $transKey = 'guestbook::routes.comment.index';
    protected $routeKey = 'guestbook.index';

    public function status()
    {
        return app(Status::class)->get($this->entity->status);
    }

    public function firstImage($width, $height, $mode, $quality)
    {
        if($file = $this->entity->attachment()->first()) {
            return \Imagy::getImage($file->filename, $this->zone, ['width' => $width, 'height' => $height, 'mode' => $mode, 'quality' => $quality]);
        }
        return false;
    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        switch ($this->entity->status) {
            case Status::DRAFT:
                return 'bg-red';
                break;
            case Status::PUBLISHED:
                return 'bg-green';
                break;
            default:
                return 'bg-red';
                break;
        }
    }

    public function fullname()
    {
        return $this->entity->first_name . ' ' . substr($this->entity->last_name, 0,1).preg_replace('/[A-Za-zĞÜŞİÇğüşöç]/', '*', substr($this->entity->last_name, 1));
    }
}