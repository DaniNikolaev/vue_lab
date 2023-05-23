<?php
require_once "tableModule.php";


class Plots extends TableModule
{

    protected function getTableName(): string
    {
        return "plots";
    }
}