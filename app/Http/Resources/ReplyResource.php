<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'reply' => $this->body,
            'question_slug' => $this->question->slug,
            'user' => $this->user->name,
            'user_id' => $this->user->id,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'likes' => array(
                'reply_id' => $this->id,
                'like_count' => $this->likes->count(),
                'liked' => !! $this->likes->where('user_id',auth()->id())->count()
            ),
            

        ];
    }
}
