<?php

namespace Modules\Guestbook\Http\Requests;

use Illuminate\Http\Response;
use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCommentRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'           => 'required|min:2',
            'last_name'            => 'required:min:2',
            'phone'                => 'required|numeric',
            'email'                => 'required|email',
            'subject'              => 'required|min:10|max:250',
            'message'              => 'required|min:50|max:500',
            'captcha_guestbook'    => 'required|captcha',
            'attachment'           => 'mimes:jpeg,jpg,png,gif,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar'
        ];
    }

    public function attributes()
    {
        return trans('guestbook::comments.form');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function response(array $errors)
    {
        return response()->json([
            'success' => false,
            'message' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
