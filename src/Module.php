<?php
namespace LeoGalleguillos\StopForumSpam;

use LeoGalleguillos\StopForumSpam\Service as StopForumSpamService;
use LeoGalleguillos\StopForumSpam\Table as StopForumSpamTable;

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
                StopForumSpamTable\ListedIpLegacy::class => function ($sm) {
                    return new StopForumSpamTable\ListedIpLegacy(
                        $sm->get('stop-forum-spam')
                    );
                },
            ],
        ];
    }
}
