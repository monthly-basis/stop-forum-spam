<?php
namespace LeoGalleguillos\StopForumSpamTest\Table;

use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;
use LeoGalleguillos\Test\TableTestCase;

class IpLegacyTest extends TableTestCase
{
    protected function setUp()
    {
        $this->setForeignKeyChecks(0);
        $this->dropAndCreateTable('ip_legacy');
        $this->setForeignKeyChecks(1);

        $this->ipLegacyTable = new StopForumSpamTable\IpLegacy(
            $this->getAdapter()
        );
    }

    public function testInsertIgnore()
    {
        $result = $this->ipLegacyTable->insertIgnore('1.2.3.4');
        $this->assertSame(
            1,
            $result->getAffectedRows()
        );
        $this->assertSame(
            '0',
            $result->getGeneratedValue()
        );
    }

    public function test_selectWhereAddress()
    {
        $result = $this->ipLegacyTable->selectWhereAddress('1.2.3.4');
        $this->assertEmpty(
            $result
        );

        $this->ipLegacyTable->insertIgnore('1.2.3.4');
        $result = $this->ipLegacyTable->selectWhereAddress('1.2.3.4');
        $this->assertSame(
            [
                0 => [
                    'address' => '1.2.3.4',
                ],
            ],
            iterator_to_array($result)
        );

        $this->ipLegacyTable->insertIgnore('5.6.7.8');
        $this->ipLegacyTable->insertIgnore('255.255.255.255');
        $result = $this->ipLegacyTable->selectWhereAddress('5.6.7.8');
        $this->assertSame(
            [
                0 => [
                    'address' => '5.6.7.8',
                ],
            ],
            iterator_to_array($result)
        );
    }
}
