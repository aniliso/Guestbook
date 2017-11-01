<?php

namespace Modules\Guestbook\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Guestbook\Entities\Comment;
use Modules\Guestbook\Http\Requests\CreateCommentRequest;
use Modules\Guestbook\Http\Requests\UpdateCommentRequest;
use Modules\Guestbook\Repositories\CommentRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Services\FileService;

class CommentController extends AdminBaseController
{
    /**
     * @var CommentRepository
     */
    private $comment;
    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(CommentRepository $comment, FileService $fileService)
    {
        parent::__construct();

        $this->comment = $comment;
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = $this->comment->all();

        return view('guestbook::admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('guestbook::admin.comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(CreateCommentRequest $request)
    {
        $requestData = $request->all();
        if($request->hasFile('attachment')) {
            $file = $this->fileService->store($request->file('attachment'));
            $requestData['attachment'] = $file->id;
        } else {
            $requestData['attachment'] = null;
        }

        $this->comment->create($requestData);

        return redirect()->route('admin.guestbook.comment.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('guestbook::comments.title.comments')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Comment $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        return view('guestbook::admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Comment $comment
     * @param  Request $request
     * @return Response
     */
    public function update(Comment $comment, UpdateCommentRequest $request)
    {
        $requestData = $request->all();
        if($request->hasFile('attachment')) {
            $file = $this->fileService->store($request->file('attachment'));
            $requestData['attachment'] = $file->id;
        } else {
            $requestData['attachment'] = null;
        }

        $this->comment->update($comment, $requestData);

        return redirect()->route('admin.guestbook.comment.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('guestbook::comments.title.comments')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        $this->comment->destroy($comment);

        return redirect()->route('admin.guestbook.comment.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('guestbook::comments.title.comments')]));
    }
}
