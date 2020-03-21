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
}
