<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
//use Illuminate\Support\Facades\Auth;
use App\User;

class CommentCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        $user = User::all()->first();
        $user = factory(User::class)->create();
        return [
            'id' => $this->id,
            'body' => $this->body,
            'user_name' => $user->name,
            'user_id' => $user->id
        ];
    }
}
