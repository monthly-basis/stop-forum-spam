<?php
namespace LeoGalleguillos\StopForumSpamTest\Service\Ip;

use Laminas\Db\Adapter\Driver\Pdo\Result;
use LeoGalleguillos\StopForumSpam\Service as StopForumSpamService;
use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;
use LeoGalleguillos\Test\Hydrator as TestHydrator;
use LeoGalleguillos\Test\TableTestCase;
use PHPUnit\Framework\TestCase;

class ToxicTest extends TestCase
{
    protected function setUp()
    {
        $this->ipLegacyTableMock = $this->createMock(
            StopForumSpamTable\IpLegacy::class
        );
        $this->toxicService = new StopForumSpamService\Ip\Toxic(
            $this->ipLegacyTableMock
        );
    }

    public function test_isToxic_emptyResult_false()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $resultHydrator = new TestHydrator\Result();

        $resultHydrator->hydrate(
            $resultMock,
            []
        );
        $this->ipLegacyTableMock
            ->method('selectWhereAddress')
            ->willReturn($resultMock);
        $this->assertFalse(
            $this->toxicService->isToxic('1.2.3.4')
        );
    }

    public function test_isToxic_nonEmptyResult_true()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $resultHydrator = new TestHydrator\Result();
        $resultHydrator->hydrate(
            $resultMock,
            [
                [
                    'address' => '1.2.3.4',
                ],
            ]
        );
        $this->ipLegacyTableMock
            ->method('selectWhereAddress')
            ->willReturn($resultMock);
        $this->assertTrue(
            $this->toxicService->isToxic('1.2.3.4')
        );
    }
}
