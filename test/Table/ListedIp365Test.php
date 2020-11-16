<?php
namespace LeoGalleguillos\StopForumSpamTest\Table;

use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;
use LeoGalleguillos\Test\TableTestCase;

class ListedIp365Test extends TableTestCase
{
    protected function setUp(): void
    {
        $this->setForeignKeyChecks(0);
        $this->dropAndCreateTable('listed_ip_365');
        $this->setForeignKeyChecks(1);

        $this->listedIp365Table = new StopForumSpamTable\ListedIp365(
            $this->getAdapter()
        );
    }

    public function testInsertIgnore()
    {
        $result = $this->listedIp365Table->insertIgnore('1.2.3.4');
        $this->assertSame(
            1,
            $result->getAffectedRows()
        );
        $this->assertSame(
            '0',
            $result->getGeneratedValue()
        );
    }

    public function test_selectWhereIpAddress()
    {
        $result = $this->listedIp365Table->selectWhereIpAddress('1.2.3.4');
        $this->assertEmpty(
            $result
        );

        $this->listedIp365Table->insertIgnore('1.2.3.4');
        $result = $this->listedIp365Table->selectWhereIpAddress('1.2.3.4');
        $this->assertSame(
            [
                0 => [
                    'ip_address' => '1.2.3.4',
                ],
            ],
            iterator_to_array($result)
        );

        $this->listedIp365Table->insertIgnore('5.6.7.8');
        $this->listedIp365Table->insertIgnore('255.255.255.255');
        $result = $this->listedIp365Table->selectWhereIpAddress('5.6.7.8');
        $this->assertSame(
            [
                0 => [
                    'ip_address' => '5.6.7.8',
                ],
            ],
            iterator_to_array($result)
        );
    }
}
