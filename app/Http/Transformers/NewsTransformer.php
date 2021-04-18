<?php


namespace App\Http\Transformers;


class NewsTransformer extends Transformer
{
    protected $resourceName = 'news';

    public function transform($data)
    {
        return [
            'title'             => $data['title'],
            'body'              => $data['body'],
            'user' => [
                'username'  => $data['user']['username'],
                'email'  => $data['user']['email'],
            ]
        ];
    }

}