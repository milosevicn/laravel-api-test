<?php

namespace App\Http\Resources;

use App\Models\User as ModelsUser;
use Firebase\JWT\JWT;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'locale' => $this->when($this->locale !== null, $this->locale),
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d')
        ];
    }

    public function with($request)
    {
        $user = ModelsUser::find($this->id);
        return [
            'token' => $this->jwt($user)
        ];
    }

    protected function jwt(ModelsUser $user) {
        $payload = [
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60 // Expiration time
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    } 
}
