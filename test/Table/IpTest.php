<?php
namespace LeoGalleguillos\StopForumSpamTest\Table;

use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;
use LeoGalleguillos\Test\TableTestCase;

class IpTest extends TableTestCase
{
    protected function setUp()
    {
        $this->setForeignKeyChecks(0);
        $this->dropAndCreateTables(['ip']);
        $this->setForeignKeyChecks(1);

        $this->ipTable = new StopForumSpamTable\Ip(
            $this->getAdapter()
        );
    }

    public function testInsertIgnore()
    {
        $result = $this->ipTable->insertIgnore('1.2.3.4');
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
