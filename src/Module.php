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
                StopForumSpamTable\Ip::class => function ($sm) {
                    return new StopForumSpamTable\Ip(
                        $sm->get('stop-forum-spam')
                    );
                },
            ],
        ];
    }
}
