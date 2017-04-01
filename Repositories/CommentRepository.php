<?php

namespace Modules\Guestbook\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface CommentRepository extends BaseRepository
{
    public function latest($amount = 5);
}
