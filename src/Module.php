<?php
namespace LeoGalleguillos\StopForumSpam;

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
                StopForumSpamTable\IpLegacy::class => function ($sm) {
                    return new StopForumSpamTable\IpLegacy(
                        $sm->get('stop-forum-spam')
                    );
                },
            ],
        ];
    }
}
