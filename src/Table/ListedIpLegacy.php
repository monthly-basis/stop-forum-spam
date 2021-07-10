<?php
namespace MonthlyBasis\StopForumSpam\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\Driver\Pdo\Result;

class ListedIpLegacy
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(
        Adapter $adapter
    ) {
        $this->adapter = $adapter;
    }

    public function insertIgnore(
        string $address
    ): Result {
        $sql = '
            INSERT IGNORE
              INTO `listed_ip_legacy` (`ip_address`)
            VALUES (?)
                 ;
        ';

        $parameters = [
            $address,
        ];
        return $this->adapter
            ->query($sql)
            ->execute($parameters);
    }

    public function selectWhereIpAddress(
        string $ipAddress
    ): Result {
        $sql = '
            SELECT `ip_address`
              FROM `listed_ip_legacy`
             WHERE `ip_address` = ?
                 ;
        ';
        $parameters = [
            $ipAddress,
        ];
        return $this->adapter->query($sql)->execute($parameters);
    }
}
