<?php
namespace LeoGalleguillos\StopForumSpam\Table;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo\Result;

class Ip
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
              INTO `ip` (`address`)
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
}
