<?php
namespace LeoGalleguillos\StopForumSpam\Service\IpAddress;

use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;

class Toxic
{
    public function __construct(
        StopForumSpamTable\ListedIpLegacy $listedIpLegacyTable
    ) {
        $this->listedIpLegacyTable = $listedIpLegacyTable;
    }

    public function isIpAddressToxic(string $ipAddress): bool
    {
        return (bool) count(
            $this->listedIpLegacyTable->selectWhereIpAddress($ipAddress)
        );
    }
}
