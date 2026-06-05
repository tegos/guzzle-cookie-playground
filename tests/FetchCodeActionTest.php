<?php

namespace Tests;

use App\Actions\FetchCodeFromMzvSiteAction;
use App\Repositories\CodeRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class FetchCodeActionTest extends TestCase
{
    public function test_returns_success_with_code(): void
    {
        $repository = $this->createMock(CodeRepositoryInterface::class);
        $repository->method('getVerificationCode')->willReturn('G6D1S8G8');

        $action = new FetchCodeFromMzvSiteAction($repository);
        $result = $action->handle();

        $this->assertTrue($result['success']);
        $this->assertSame('G6D1S8G8', $result['code']);
    }

    public function test_returns_failure_when_exception_thrown(): void
    {
        $repository = $this->createMock(CodeRepositoryInterface::class);
        $repository->method('getVerificationCode')->willThrowException(new \RuntimeException('connection timeout'));

        $action = new FetchCodeFromMzvSiteAction($repository);
        $result = $action->handle();

        $this->assertFalse($result['success']);
        $this->assertNull($result['code']);
        $this->assertSame('connection timeout', $result['error']);
    }
}
