<?php


namespace App\Http\Transformers;


class UserTransformer extends Transformer
{
    protected $resourceName = 'user';

    public function transform($data)
    {
        return [
            'email'     => $data['email'],
            'token'     => $data['token'],
            'username'  => $data['username'],
        ];
    }

}