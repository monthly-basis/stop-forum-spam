<?php
namespace LeoGalleguillos\StopForumSpamTest;

use LeoGalleguillos\StopForumSpam\Module;
use LeoGalleguillos\Test\ModuleTestCase;

class ModuleTest extends ModuleTestCase
{
    protected function setUp()
    {
        $this->module = new Module();
    }
}
