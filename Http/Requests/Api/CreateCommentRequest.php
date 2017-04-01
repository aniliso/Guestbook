<?php

namespace Modules\Guestbook\Http\Api\Requests;

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
            'first_name' => 'required|min:2',
            'last_name' => 'required:min:2',
            'phone' => 'required|integer',
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
}
