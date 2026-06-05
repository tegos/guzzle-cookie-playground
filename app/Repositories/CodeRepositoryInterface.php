<?php

namespace App\Repositories;

interface CodeRepositoryInterface
{
    public function getVerificationCode(): ?string;
}
