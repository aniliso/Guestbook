<?php

namespace Modules\Guestbook\Http\Requests;

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
            'message'              => 'required|min:1|max:3000',
            'attachment'           => 'mimes:jpeg,jpg,png|max:200'
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

    public function messages()
    {
        return trans('validation');
    }
}
