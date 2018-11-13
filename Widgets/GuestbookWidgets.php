<?php

namespace Modules\Guestbook\Widgets;

use Modules\Guestbook\Repositories\CommentRepository;

class GuestbookWidgets
{
    /**
     * @var CommentRepository
     */
    private $comment;

    public function __construct(
        CommentRepository $comment
    )
    {
        $this->comment = $comment;
    }

    public function latest($limit=4, $view='comment')
    {
        $comments = $this->comment->latest($limit);
        if($comments->count()>0) {
            return view('guestbook::widgets.'.$view, compact('comments'));
        }
        return null;
    }
}