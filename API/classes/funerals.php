<?php
require_once "tableModule.php";

class Funerals extends TableModule
{
    protected function getTableName(): string
    {
        return "funerals";
    }
}