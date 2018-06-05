<?php

namespace App\Http\Traits\Api;

trait JWTTrait
{
    public function getJWTIdentifier()
    {
        return $this->getKey(); //Eloquent Model method
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}