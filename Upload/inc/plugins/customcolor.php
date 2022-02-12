<?php
/*
* MyBB: Custom Color Changer
*
* File: customcolor.php
*
* Authors: AmazOuz & Vintagedaddyo & iAndrew
*
* MyBB Version: 1.8
*
* Plugin Version: 1.2
*
*/

if(!defined("IN_MYBB"))
{
    die("Direct initialization of this file is not allowed.");
}

// hooks

$plugins->add_hook('global_start', 'customcolor_headerinclude');

$plugins->add_hook("usercp_start", "customcolor_start");

$plugins->add_hook("usercp_menu", "customcolor_usercp_menu");

function customcolor_info()
{
    global $lang;

    $lang->load("customcolor");

    // support project by donating

    $lang->desc_plugin = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' . '<input type="hidden" name="cmd" value="_s-xclick">' . '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' . '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' . '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' . '</form>' . $lang->desc_plugin;

    // info

    return array(
        "name"          => $lang->title_plugin,
        "description"   => $lang->desc_plugin,
        "website"       => "https://github.com/vintagedaddyo/MyBB_Plugin-Theme_Color_Changer",
        "author"        => "AmazOuz, Vintagedaddyo & iAndrew",
        "authorsite"    => "https://github.com/vintagedaddyo/MyBB_Plugin-Theme_Color_Changer",
        "version"       => "1.2",
        "guid"          => "",
        "codename"      => "customcolor",
        "compatibility" => "18*"
    );
}

// install

function customcolor_install()
{
    customcolor_add_table();
}

// uninstall

function customcolor_uninstall()
{
    customcolor_remove_table();
}

// is installed

function customcolor_is_installed()
{
    global $db;

    $table = TABLE_PREFIX.'users';

    $column = 'customcolor';

    $query = "SHOW COLUMNS FROM $table LIKE '$column'";

    $result = $db->query($query) or die(mysql_error());


    if($num_rows = $result->num_rows > 0)
    {
	   return true;
    }

    else
    {
	   return false;
    }
}

// activate

function customcolor_activate()
{
    customcolor_create_template();
}

// deactivate

function customcolor_deactivate()
{
    customcolor_delete_template();
}

include 'customcolor/functions.php';
