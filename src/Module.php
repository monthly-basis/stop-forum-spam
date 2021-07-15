<?php
namespace MonthlyBasis\StopForumSpam;

use MonthlyBasis\StopForumSpam\Model\Service as StopForumSpamService;
use MonthlyBasis\StopForumSpam\Model\Table as StopForumSpamTable;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                ],
                'factories' => [
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                \MonthlyBasis\StopForumSpam\Service\IpAddress\Toxic::class => function ($sm) {
                    return new \MonthlyBasis\StopForumSpam\Service\IpAddress\Toxic(
                        $sm->get(\MonthlyBasis\StopForumSpam\Table\ListedIp365::class)
                    );
                },
                \MonthlyBasis\StopForumSpam\Table\ListedIp365::class => function ($sm) {
                    return new \MonthlyBasis\StopForumSpam\Table\ListedIp365(
                        $sm->get('stop-forum-spam')
                    );
                },
                StopForumSpamService\IpAddress\Toxic::class => function ($sm) {
                    return new StopForumSpamService\IpAddress\Toxic(
                        $sm->get(StopForumSpamTable\ListedIp365::class)
                    );
                },
                StopForumSpamTable\ListedIp365::class => function ($sm) {
                    return new StopForumSpamTable\ListedIp365(
                        $sm->get('stop-forum-spam')
                    );
                },
            ],
        ];
    }
}
