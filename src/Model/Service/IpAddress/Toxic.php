<?php
namespace MonthlyBasis\StopForumSpam\Model\Service\IpAddress;

use MonthlyBasis\StopForumSpam\Model\Table as StopForumSpamTable;

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
