<?php
namespace MonthlyBasis\StopForumSpam\Service\IpAddress;

use MonthlyBasis\StopForumSpam\Table as StopForumSpamTable;

class Toxic
{
    public function __construct(
        StopForumSpamTable\ListedIp365 $listedIp365Table
    ) {
        $this->listedIp365Table = $listedIp365Table;
    }

    public function isIpAddressToxic(string $ipAddress): bool
    {
        return (bool) count(
            $this->listedIp365Table->selectWhereIpAddress($ipAddress)
        );
    }
}
