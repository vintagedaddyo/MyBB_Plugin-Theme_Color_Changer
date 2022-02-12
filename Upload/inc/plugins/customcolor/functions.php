<?php
/*
* MyBB: Custom Color Changer
*
* File: functions.php
*
* Authors: AmazOuz & Vintagedaddyo & iAndrew
*
* MyBB Version: 1.8
*
* Plugin Version: 1.2
*
*/

// add table

function customcolor_add_table()
{
    global $db, $mybb, $lang;

    $lang->load("customcolor");

    $query = "ALTER TABLE `".TABLE_PREFIX."users` ADD `customcolor` VARCHAR( 6 ) DEFAULT ''";

    $db->write_query($query);

    // setting group
    
    $setting_group = array(  
		'name'			=> 'customcolor',
		'title'			=>  $lang->customcolor_group_title,
		'description'	=>  $lang->customcolor_group_desc,
		'disporder'		=> '1'
	);

    $db->insert_query('settinggroups', $setting_group);

	$gid = $db->insert_id();
    
    // setting 1

    $setting1 = array(
		'name'			=> 'customcolor_default',
		'title'			=> $lang->customcolor_default_title,
		'description'	=> $lang->customcolor_default_desc,
		'optionscode'	=> 'text', 
		'value'			=> '008dd4', 
		'disporder'		=> '1', 
		'gid'			=> intval($gid)
	);

	$db->insert_query('settings', $setting1);
    
    // setting 2

    $setting2 = array(
		'name'			=> 'customcolor_texts',
		'title'			=> $lang->customcolor_customTexts_title,
		'description'	=> $lang->customcolor_customTexts_desc,
		'optionscode'	=> 'textarea', 
		'value'			=> '.top_links a:link, .top_links a:hover, .top_links a:focus, .top_links a:visited, .navigation a:link, .navigation a:hover, .navigation a:focus, .navigation a:visited, .trow1 a:link, .trow1 a:hover, .trow1 a:focus, .trow1 a:visited,  .trow2 a:link, .trow2 a:hover, .trow2 a:focus, .trow2 a:visited, #footer .lower span#copyright  a:link', 
		'disporder'		=> '2', 
		'gid'			=> intval($gid)
	);

	$db->insert_query('settings', $setting2);
    
    // setting 3

    $setting3 = array(
		'name'			=> 'customcolor_borders',
		'title'			=> $lang->customcolor_customBorders_title,
		'description'	=> $lang->customcolor_customBorders_desc,
		'optionscode'	=> 'textarea', 
		'value'			=> '.postbit_buttons > a:link', 
		'disporder'		=> '3', 
		'gid'			=> intval($gid)
	);

	$db->insert_query('settings', $setting3);
    
    // setting 4

    $setting4 = array(
		'name'			=> 'customcolor_backgrounds',
		'title'			=> $lang->customcolor_customElements_title,
		'description'	=> $lang->customcolor_customElements_desc,
		'optionscode'	=> 'textarea', 
		'value'			=> '#search input.button, .thead', 
		'disporder'		=> '4', 
		'gid'			=> intval($gid)
	);

	$db->insert_query('settings', $setting4);

    // rebuild

    rebuild_settings();
}

// remove table

function customcolor_remove_table()
{
    global $db, $mybb;

    $query = "ALTER TABLE `".TABLE_PREFIX."users` DROP `customcolor`";

    $db->query($query);

    $db->write_query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN ('customcolor_default','customcolor_backgrounds','customcolor_borders','customcolor_texts')");

	$db->write_query("DELETE FROM ".TABLE_PREFIX."settinggroups WHERE name = 'customcolor'");
    
    // rebuild

	rebuild_settings();
}

// template creation

function customcolor_create_template()
{   
    global $mybb, $db;

    require_once MYBB_ROOT."/inc/adminfunctions_templates.php";

    find_replace_templatesets('headerinclude', '#'.preg_quote('{$stylesheets}').'#i', '{$stylesheets}{$customcolor_headerinclude}');
    $template = '<script type="text/javascript" src="{$mybb->settings[\'bburl\']}/js/colorpicker.js"></script>
<script type="text/javascript" src="{$mybb->settings[\'bburl\']}/js/skin.js"></script>
<script type="text/javascript" src="{$mybb->settings[\'bburl\']}/js/cookie.js"></script>
<link rel=\'stylesheet\' type="text/css" href="{$mybb->settings[\'bburl\']}/skin.css.php" />
<style>
/*
@media only screen and (max-width: 760px) {
.colorpicker {
    margin-left: unset !important;
    position: absolute !important;
    top: 376px !important;
    right: 0px !important;
    left: 0px !important;
    height: 176px !important;
    line-height: 376px !important;
    vertical-align: middle !important;
 }
}
*/
.custom_theme
{
    margin-left:5px;
}
.custom_theme #colorpicker{
    height: 30px;
    width: 30px;
    padding: 0;
    margin: 0;
    cursor: pointer;
    color: transparent;
    border: 3px solid black;
    border-radius: 100%;
}
.colorpicker * {
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
.colorpicker {
    width: 356px;
    height: 176px;
    overflow: hidden;
    position: absolute;
    background: url(inc/plugins/customcolor/images/cp/colorpicker_background.png);
    font-family: Arial, Helvetica, sans-serif;
    display: none;
}
.colour_instructions{
    width: 134px;
    height: 92px;
    position: absolute;
    left: 211px;
    top: 47px;
    text-align: left;
    font-size: 10px;
    color: #898989;
}
.colorpicker_color {
    width: 150px;
    height: 150px;
    left: 14px;
    top: 13px;
    position: absolute;
    background: #f00;
    overflow: hidden;
    cursor: crosshair;
}
.colorpicker_color div {
    position: absolute;
    top: 0;
    left: 0;
    width: 150px;
    height: 150px;
    background: url(inc/plugins/customcolor/images/cp/colorpicker_overlay.png);
}
.colorpicker_color div div {
    position: absolute;
    top: 0;
    left: 0;
    width: 11px;
    height: 11px;
    overflow: hidden;
    background: url(inc/plugins/customcolor/images/cp/colorpicker_select.gif);
    margin: -5px 0 0 -5px;
}
.colorpicker_hue {
    position: absolute;
    top: 13px;
    left: 171px;
    width: 35px;
    height: 150px;
    cursor: n-resize;
}
.colorpicker_hue div {
    position: absolute;
    width: 35px;
    height: 9px;
    overflow: hidden;
    background: url(inc/plugins/customcolor/images/cp/colorpicker_indic.gif) left top;
    margin: -4px 0 0 0;
    left: 0px;
}
.colorpicker_new_color {
    position: absolute;
    /*width: 60px;*/
    width: 130px;
    height: 30px;
    left: 213px;
    top: 13px;
    background: #f00;
}
.colorpicker_current_color {
    position: absolute;
    width: 60px;
    height: 30px;
    left: 283px;
    top: 13px;
    background: #f00;
}
.colorpicker input {
    background-color: transparent;
    border: 1px solid transparent;
    position: absolute;
    font-size: 10px;
    font-family: Arial, Helvetica, sans-serif;
    color: #898989;
    top: 4px;
    right: 11px;
    text-align: right;
    margin: 0;
    padding: 0;
    height: 11px;
}
.colorpicker_hex {
    position: absolute;
    width: 72px;
    height: 22px;
    background: url(inc/plugins/customcolor/images/cp/colorpicker_hex.png) top;
    left: 212px;
    top: 142px;
}
.colorpicker_hex input {
    right: 6px;
}
.colorpicker_field {
    height: 22px;
    width: 62px;
    background-position: top;
    position: absolute;
    /*display: none; *//* Hide colour boxes */
}
.colorpicker_field span {
    position: absolute;
    width: 12px;
    height: 22px;
    overflow: hidden;
    top: 0;
    right: 0;
    cursor: n-resize;
}
.colorpicker_rgb_r {
    background-image: url(inc/plugins/customcolor/images/cp/colorpicker_rgb_r.png);
    top: 52px;
    left: 212px;
}
.colorpicker_rgb_g {
    background-image: url(inc/plugins/customcolor/images/cp/colorpicker_rgb_g.png);
    top: 82px;
    left: 212px;
}
.colorpicker_rgb_b {
    background-image: url(inc/plugins/customcolor/images/cp/colorpicker_rgb_b.png);
    top: 112px;
    left: 212px;
}
.colorpicker_hsb_h {
    background-image: url(inc/plugins/customcolor/images/cp/colorpicker_hsb_h.png);
    top: 52px;
    left: 282px;
}
.colorpicker_hsb_s {
    background-image: url(inc/plugins/customcolor/images/cp/colorpicker_hsb_s.png);
    top: 82px;
    left: 282px;
}
.colorpicker_hsb_b {
    background-image: url(inc/plugins/customcolor/images/cp/colorpicker_hsb_b.png);
    top: 112px;
    left: 282px;
}
.colorpicker_submit {
    position: absolute;
    /*width: 22px;*/    
    width: 56px;
    height: 22px;
    background: url(inc/plugins/customcolor/images/cp/colorpicker_submit.png) top;
    /*left: 322px;*/
    left: 288px;    
    top: 142px;
    overflow: hidden;
}
.colorpicker_focus {
    background-position: center;
}
.colorpicker_hex.colorpicker_focus {
    background-position: bottom;
}
.colorpicker_submit.colorpicker_focus {
    background-position: bottom;
}
.colorpicker_slider {
    background-position: bottom;
}
</style>
    ';

    $insert_array = array(
        'title' => 'customcolor_headerinclude',
        'template' => $db->escape_string($template),
        'sid' => '-1',
        'version' => '',
        'dateline' => time()
    );

    $db->insert_query('templates', $insert_array);
    
    $template = '<html>
<head>
<title>{$mybb->settings[\'bbname\']} - {$lang->ucp_themecolor}</title>
{$headerinclude}
</head>
<body>
{$header}
<table width="100%" border="0" align="center">
<tr>
	{$usercpnav}
	<td valign="top">
		<table border="0" cellspacing="{$theme[\'borderwidth\']}" cellpadding="{$theme[\'tablespace\']}" class="tborder">
			<tr>
				<td class="thead" colspan="2"><strong>{$lang->ucp_themecolor}</strong></td>
			</tr>
			<tr>
				<td class="trow1" colspan="2">
					<table cellspacing="0" cellpadding="0" width="100%">
						<tr>
							<td>
								{$lang->ucp_themecolor_notice}
								<span class="custom_theme"><input type="text" id="colorpicker" /></span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
{$footer}
</body>
</html>';

    $insert_array = array(
        'title' => 'customcolor_usercp',
        'template' => $db->escape_string($template),
        'sid' => '-1',
        'version' => '',
        'dateline' => time()
    );

    $db->insert_query('templates', $insert_array);
    
}

// delete templates

function customcolor_delete_template()
{
    global $mybb, $db;

    require_once MYBB_ROOT."/inc/adminfunctions_templates.php";

    find_replace_templatesets('headerinclude', '#'.preg_quote('{$customcolor_headerinclude}').'#i', '');

    $db->delete_query("templates", "title = 'customcolor_headerinclude'");

    $db->delete_query("templates", "title = 'customcolor_usercp'");
}

// headerinclude

function customcolor_headerinclude()
{
    global $mybb, $db, $templates, $customcolor_headerinclude;

    require_once MYBB_ROOT."/inc/adminfunctions_templates.php";

    eval("\$customcolor_headerinclude = \"".$templates->get("customcolor_headerinclude")."\";");
}

// start

function customcolor_start()
{
	global $db, $footer, $header, $navigation, $headerinclude, $themes, $mybb, $templates, $usercpnav, $theme, $lang;

    $lang->load("customcolor");

	if($mybb->input['action'] != "customcolor")
	{
		return false;
	}
	
	eval("\$output = \"".$templates->get("customcolor_usercp")."\";");

    output_page($output);
	
}

// usercp menu

function customcolor_usercp_menu()
{
	global $templates, $lang;

    $lang->load("customcolor");

	$template = "\n\t<tr><td class=\"trow1 smalltext\"><a href=\"usercp.php?action=customcolor\" class=\"usercp_nav_item usercp_nav_options\">{$lang->ucpnav_themecolor}</a></td></tr>";

	$templates->cache["usercp_nav_misc"] = str_replace("<tbody style=\"{\$collapsed['usercpmisc_e']}\" id=\"usercpmisc_e\">", "<tbody style=\"{\$collapsed['usercpmisc_e']}\" id=\"usercpmisc_e\">{$template}", $templates->cache["usercp_nav_misc"]);
}
