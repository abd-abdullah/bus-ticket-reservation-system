<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/libs/Database.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/helpers/Format.php");

/**
 * Admin_info class
 */
class BaseClass
{
    protected $db;
    protected $fm;

    function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

}