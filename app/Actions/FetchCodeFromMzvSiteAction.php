<?php

namespace App\Actions;

use App\repositories\MzvCodeRepository;

final class FetchCodeFromMzvSiteAction
{
    private MzvCodeRepository $repository;

    public function __construct(MzvCodeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(): array
    {
        $code = $this->repository->getVerificationCode();

        return [
            'success' => !empty($code),
            'code' => $code,
        ];
    }
}
