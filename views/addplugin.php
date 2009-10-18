<?php

// Set up some user info:

$authuser_id = AuthUser::getRecord()->id;
$authuser_name = AuthUser::getRecord()->name;
$authuser_email = AuthUser::getRecord()->email;

// Set up some defaults:

$wolf_version = CMS_VERSION;

$wolf_required_version_1 = '0';
$wolf_required_version_2 = '0';
$wolf_required_version_3 = '0';

$plugin_version_1 = '0';
$plugin_version_2 = '0';
$plugin_version_3 = '1';

$plugin_website = URL_PUBLIC;
$plugin_author = $authuser_name;
$plugin_email = $authuser_email;

$plugin_date_created = date('Y-m-d');
$plugin_created_by = $authuser_id;

// Override defaults
// retrieve_plugin_details($id);

?>
<h1><img src="<?php echo URL_PUBLIC; ?>wolf/plugins/plugin_developer/images/addplugin.png" align="bottom"> Add a new Plugin</h1>

<form action="<?php echo get_url('plugin/plugin_developer/addplugin_db/'); ?>" method="POST" name="addplugin">

<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="plugin_date_created" value="<?php echo $plugin_date_created; ?>" />
<input type="hidden" name="plugin_created_by" value="<?php echo $plugin_created_by; ?>" />

<p><label>Plugin Name :</label>
<input type="text" name="plugin_name" value="<?php echo $plugin_name; ?>" /></p>

<p><label>Plugin ID :</label>
<input type="text" name="plugin_id" value="<?php echo $plugin_id; ?>" /> <small>(no spaces please!)</small></p>

<p><label>Author :</label>
<input type="text" name="plugin_author" value="<?php echo $plugin_author; ?>" /></p>

<p><label>Email :</label>
<input type="text" name="plugin_email" value="<?php echo $plugin_email; ?>" /></p>

<p><label>Website :</label>
<input type="text" name="plugin_website" value="<?php echo $plugin_website; ?>" /></p>

<p><label>Plugin Overview :</label>
<textarea name="plugin_overview" style="width:50%;height:70px;"><?php echo $plugin_overview; ?></textarea>
</p>
<p><label>Version Number :</label>
<input class="version" maxlength="2" type="text" name="plugin_version_1" value="<?php echo $plugin_version_1; ?>"> . 
<input class="version" maxlength="2" type="text" name="plugin_version_2" value="<?php echo $plugin_version_2; ?>"> . 
<input class="version" maxlength="2" type="text" name="plugin_version_3" value="<?php echo $plugin_version_3; ?>"></p>

<p><label>Require Wolf Version :</label>
<input class="version" maxlength="2" type="text" name="wolf_required_1" value="<?php echo $wolf_required_1; ?>"> . 
<input class="version" maxlength="2" type="text" name="wolf_required_2" value="<?php echo $wolf_required_2; ?>"> . 
<input class="version" maxlength="2" type="text" name="wolf_required_3" value="<?php echo $wolf_required_3; ?>"></p>


<p><label>License Type :</label>
<select name="plugin_license">
<?php
global $__CMS_CONN__;
$licenses = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_settings_licenses";
$licenses = $__CMS_CONN__->prepare($licenses);
$licenses->execute();
while($license = $licenses->fetchObject()) {
	global $__CMS_CONN__;
	$id = $license->id;
	$license = $license->license_type; ?>
<option value="<?php echo $license ?>"><?php echo $license ?></option>
<?php } ?></select> - see <a href="http://www.opensource.org/licenses/alphabetical" target="_blank">OpenSource.org</a> for license information</p>

<p><label>Plugin Condition :</label>
<select name="plugin_condition">
<?php
global $__CMS_CONN__;
$conditions = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_settings_condition";
$conditions = $__CMS_CONN__->prepare($conditions);
$conditions->execute();
while($condition = $conditions->fetchObject()) {
	global $__CMS_CONN__;
	$id = $condition->id;
	$condition = $condition->dev_condition; ?>
<option value="<?php echo $condition ?>"><?php echo $condition ?></option>
<?php } ?>
</select></p>

<p><label>Published Status :</label>
<select name="plugin_status">
<option value="1" >Published</option>
<option value="0" >Not Released</option>
</select></p>

<p><label>Download Link :</label>
<?php echo URL_PUBLIC ?><input type="text" name="plugin_file_url" value="" /></p>


<p><label>&nbsp;</label>
<input type="submit" value="Add this Plugin" accesskey="s" /> | <a href="<?php echo get_url('plugin/plugin_developer/index'); ?>">Cancel</a></p>

</form>

<style>
label {
	vertical-align: top;
	float: left;
	width:170px;
	text-align: right;
	font-weight: bold;
	padding-right: 10px;
}
input.version {
	width: 20px;
}
</style>