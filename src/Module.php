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
                StopForumSpamService\Ip\Toxic::class => function ($sm) {
                    return new StopForumSpamService\Ip\Toxic(
                        $sm->get(StopForumSpamTable\IpLegacy::class)
                    );
                },
                StopForumSpamTable\IpLegacy::class => function ($sm) {
                    return new StopForumSpamTable\IpLegacy(
                        $sm->get('stop-forum-spam')
                    );
                },
            ],
        ];
    }
}
