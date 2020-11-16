<?php
namespace LeoGalleguillos\StopForumSpamTest\Service\IpAddress;

use Laminas\Db\Adapter\Driver\Pdo\Result;
use LeoGalleguillos\StopForumSpam\Service as StopForumSpamService;
use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;
use MonthlyBasis\LaminasTest\Hydrator as TestHydrator;
use MonthlyBasis\LaminasTest\TableTestCase;
use PHPUnit\Framework\TestCase;

class ToxicTest extends TestCase
{
    protected function setUp(): void
    {
        $this->listedIp365TableMock = $this->createMock(
            StopForumSpamTable\ListedIp365::class
        );
        $this->toxicService = new StopForumSpamService\IpAddress\Toxic(
            $this->listedIp365TableMock
        );
    }

    public function test_isIpAddressToxic_emptyResult_false()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $resultHydrator = new TestHydrator\CountableIterator();

        $resultHydrator->hydrate(
            $resultMock,
            []
        );
        $this->listedIp365TableMock
            ->method('selectWhereIpAddress')
            ->willReturn($resultMock);
        $this->assertFalse(
            $this->toxicService->isIpAddressToxic('1.2.3.4')
        );
    }

    public function test_isIpAddressToxic_nonEmptyResult_true()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $resultHydrator = new TestHydrator\CountableIterator();
        $resultHydrator->hydrate(
            $resultMock,
            [
                [
                    'ip_address' => '1.2.3.4',
                ],
            ]
        );
        $this->listedIp365TableMock
            ->method('selectWhereIpAddress')
            ->willReturn($resultMock);
        $this->assertTrue(
            $this->toxicService->isIpAddressToxic('1.2.3.4')
        );
    }
}
