<?php

namespace App\Actions;

use App\Repositories\CodeRepositoryInterface;

final class FetchCodeFromMzvSiteAction
{
    private CodeRepositoryInterface $repository;

    public function __construct(CodeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(): array
    {
        try {
            $code = $this->repository->getVerificationCode();

            return [
                'success' => !empty($code),
                'code' => $code,
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'code' => null,
                'error' => $e->getMessage(),
            ];
        }
    }
}
