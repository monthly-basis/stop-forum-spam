<?php
namespace LeoGalleguillos\StopForumSpamTest;

use LeoGalleguillos\StopForumSpam\Module;
use LeoGalleguillos\Test\ModuleTestCase;

class ModuleTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        $this->module = new Module();
    }
}
