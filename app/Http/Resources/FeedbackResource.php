<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'message'      => $this->message,
            'status'       => $this->status,
            'priority' => $this->priority,
            'category'     => $this->whenLoaded('category', fn () => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
            ]),
            'tags' => $this->whenLoaded('tags', fn () => $this->tags->map(fn ($tag) => [
                'id'   => $tag->id,
                'name' => $tag->name,
            ])),
            'notes' => $this->whenLoaded('notes', fn () => $this->notes->map(fn ($note) => [
                'id'   => $note->id,
                'body' => $note->body,
            ])),
            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}