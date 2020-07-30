<?php

abstract class BaseApplicationService
{
    abstract public function execute(ApplicationRequest $request);
}