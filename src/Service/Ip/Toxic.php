<?php
namespace LeoGalleguillos\StopForumSpam\Service\Ip;

use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;

class Toxic
{
    public function __construct(
        StopForumSpamTable\IpLegacy $ipLegacyTable
    ) {
        $this->ipLegacyTable = $ipLegacyTable;
    }

    public function isToxic(string $ipAddress): bool
    {
        return (bool) count(
            $this->ipLegacyTable->selectWhereAddress($ipAddress)
        );
    }
}
