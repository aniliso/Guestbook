<?php

namespace Modules\Guestbook\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Guestbook\Entities\Comment;

class GuestbookCommentCreated extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Comment
     */
    private $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->comment->attachment()->exists()) {
            $this->attach($this->comment->attachment()->first()->path);
        }
        return $this->view('guestbook::emails.comment')
                    ->subject($this->comment->id . ' No.lu Ziyaretçi Yorumu')
                    ->replyTo($this->comment->email, $this->comment->fullname)
                    ->with(['comment'=>$this->comment]);
    }
}
