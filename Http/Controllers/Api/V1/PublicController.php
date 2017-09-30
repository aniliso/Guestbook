<?php namespace Modules\Guestbook\Http\Controllers\Api\V1;

use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Guestbook\Http\Requests\CreateCommentRequest;
use Modules\Guestbook\Repositories\CommentRepository;
use Modules\Media\Services\FileService;

class PublicController extends BasePublicController
{
    /**
     * @var FileService
     */
    private $fileService;
    /**
     * @var CommentRepository
     */
    private $comment;

    public function __construct(FileService $fileService, CommentRepository $comment)
    {
        parent::__construct();
        $this->fileService = $fileService;
        $this->comment = $comment;
    }

    public function commentForm()
    {
        return view('guestbook::ajax.form');
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
            $this->comment->create($requestData);
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
