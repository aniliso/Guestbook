<?php

namespace Modules\Guestbook\Repositories\Eloquent;

use Modules\Core\Models\Status;
use Modules\Guestbook\Repositories\CommentRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCommentRepository extends EloquentBaseRepository implements CommentRepository
{
    public function latest($amount=5)
    {
        return $this->model->status(Status::PUBLISHED)->orderBy('created_at', 'desc')->limit($amount)->get();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->status(Status::PUBLISHED)->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
