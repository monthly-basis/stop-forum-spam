<?php
namespace LeoGalleguillos\StopForumSpamTest\Table;

use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;
use LeoGalleguillos\Test\TableTestCase;

class ListedIpLegacyTest extends TableTestCase
{
    protected function setUp()
    {
        $this->setForeignKeyChecks(0);
        $this->dropAndCreateTable('listed_ip_legacy');
        $this->setForeignKeyChecks(1);

        $this->listedIpLegacyTable = new StopForumSpamTable\ListedIpLegacy(
            $this->getAdapter()
        );
    }

    public function testInsertIgnore()
    {
        $result = $this->listedIpLegacyTable->insertIgnore('1.2.3.4');
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
        $result = $this->listedIpLegacyTable->selectWhereIpAddress('1.2.3.4');
        $this->assertEmpty(
            $result
        );

        $this->listedIpLegacyTable->insertIgnore('1.2.3.4');
        $result = $this->listedIpLegacyTable->selectWhereIpAddress('1.2.3.4');
        $this->assertSame(
            [
                0 => [
                    'ip_address' => '1.2.3.4',
                ],
            ],
            iterator_to_array($result)
        );

        $this->listedIpLegacyTable->insertIgnore('5.6.7.8');
        $this->listedIpLegacyTable->insertIgnore('255.255.255.255');
        $result = $this->listedIpLegacyTable->selectWhereIpAddress('5.6.7.8');
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
