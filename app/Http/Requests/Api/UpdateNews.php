<?php


namespace App\Http\Requests\Api;


class UpdateNews extends ApiRequest
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return $this->get('news') ?: [];
    }

//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * @return bool
//     */
//    public function authorize()
//    {
//        $news = $this->route('news');
//
//        return $news->user_id == auth()->id();
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
        ];
    }
}