<?php

namespace Server;

interface LoggerInterface
{
    public function save($table, $field, $value);
}

interface DataInterface
{
    public function select($table, $field);
}
