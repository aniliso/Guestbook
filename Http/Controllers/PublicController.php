<?php

namespace Modules\Guestbook\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Guestbook\Http\Requests\CreateCommentRequest;
use Modules\Guestbook\Mail\GuestbookCommentCreated;
use Modules\Guestbook\Repositories\CommentRepository;
use Modules\Media\Services\FileService;
use Breadcrumbs;

class PublicController extends BasePublicController
{
    /**
     * @var CommentRepository
     */
    private $comment;
    /**
     * @var FileService
     */
    private $fileService;

    private $perPage = 9;

    /**
     * PublicController constructor.
     * @param CommentRepository $comment
     */
    public function __construct(CommentRepository $comment, FileService $fileService)
    {
        parent::__construct();
        $this->comment = $comment;
        $this->fileService = $fileService;

        /* Start Default Breadcrumbs */
        if(!app()->runningInConsole()) {
            Breadcrumbs::register('guestbook.index', function ($breadcrumbs) {
                $breadcrumbs->push(trans('themes::guestbook.title'), route('guestbook.comment.index'));
            });
        }
        /* End Default Breadcrumbs */
    }

    public function index()
    {
        $reviews = $this->comment->paginate($this->perPage);

        $title = trans('themes::guestbook.title');
        $url = route('guestbook.comment.index');

        $this->setTitle($title)
             ->setDescription($title);

        $this->setUrl($url)
             ->addMeta('robots','follow,index');

        return view('guestbook::index', compact('reviews'));
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function form()
    {
        $title = trans('themes::guestbook.form');
        $url = route('guestbook.comment.form');

        $this->setTitle($title)
            ->setDescription($title);

        $this->setUrl($url)
            ->addMeta('robots','follow,index');

        /* Start Breadcrumbs */
        Breadcrumbs::register('guestbook.form', function($breadcrumbs) {
            $breadcrumbs->parent('guestbook.index');
            $breadcrumbs->push(trans('themes::guestbook.form'), route('guestbook.comment.add'));
        });
        /* End Breadcrumbs */

        return view('guestbook::form');
    }

    public function approve($code='')
    {
        try
        {
            $comment = $this->comment->find(decrypt($code));
            if($this->comment->update($comment, ['status'=>1])) {
                return redirect()->route('guestbook.comment.index');
            }
        }
        catch (DecryptException $exception)
        {
            return redirect()->route('guestbook.comment.index');
        }
    }

    public function addComment(CreateCommentRequest $request)
    {
        try
        {
            $requestData = $request->all();
            if($request->hasFile('attachment')) {
                $file = $this->fileService->store($request->attachment);
                $requestData['attachment'] = $file->id;
            } else {
                $requestData['attachment'] = null;
            }
            if ($comment = $this->comment->create($requestData)) {
                \Mail::to(setting('theme::email'))->queue(new GuestbookCommentCreated($comment));
            }
            return response()->json([
                'success' => true,
                'data' => ['message'=>'Eklendi']
            ], Response::HTTP_OK);
        }
        catch (\Exception $exception)
        {
            return response()->json([
                'success' => false,
                'message'  => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
