<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="UserResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="username", type="string", example="john.doe"),
 *     @OA\Property(property="national_code", type="string", example="1234567890"),
 *     @OA\Property(property="role_type", type="string", example="student", description="student, instructor, admin")
 * )
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'national_code' => $this->national_code,
            'role_type' => $this->role_type,
        ];
    }
}
