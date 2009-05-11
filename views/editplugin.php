<?php

// Set up some user info:

$authuser_id = AuthUser::getRecord()->id;
$authuser_name = AuthUser::getRecord()->name;
$authuser_email = AuthUser::getRecord()->email;

// Set up some defaults:

$frog_version = FROG_VERSION;

$frog_required_version_1 = '0';
$frog_required_version_2 = '9';
$frog_required_version_3 = '5';

$plugin_version_1 = '0';
$plugin_version_2 = '0';
$plugin_version_3 = '1';

$plugin_website = URL_PUBLIC;
$plugin_author = $authuser_name;
$plugin_email = $authuser_email;

$plugin_date_updated = date('Y-m-d');
$plugin_updated_by = $authuser_id;


global $__FROG_CONN__;
$sql = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_plugins WHERE ID=".$id."";
$sql = $__FROG_CONN__->prepare($sql);
$sql->execute();

while($plugin_details = $sql->fetchObject()){
	$id = $plugin_details->id;
	$plugin_name = $plugin_details->plugin_name;
	$plugin_id = $plugin_details->plugin_id;
	$plugin_author = $plugin_details->plugin_author;
	$plugin_email = $plugin_details->plugin_email;
	$plugin_website = $plugin_details->plugin_website;
	$plugin_overview = $plugin_details->plugin_overview;
	$plugin_version_1 = $plugin_details->plugin_version_1;
	$plugin_version_2 = $plugin_details->plugin_version_2;
	$plugin_version_3 = $plugin_details->plugin_version_3;
	$frog_required_1 = $plugin_details->frog_required_1;
	$frog_required_2 = $plugin_details->frog_required_2;
	$frog_required_3 = $plugin_details->frog_required_3;
	$plugin_license = $plugin_details->plugin_license;
	$plugin_date_created = $plugin_details->plugin_date_created;
	$plugin_created_by = $plugin_details->plugin_created_by;
	$plugin_date_updated = $plugin_details->plugin_date_updated;
	$plugin_updated_by = $plugin_details->plugin_updated_by;
	$plugin_condition = $plugin_details->plugin_condition;
	$plugin_file_url = $plugin_details->plugin_file_url;
	$plugin_downloads = $plugin_details->plugin_downloads;
	$plugin_status = $plugin_details->plugin_status;
}
?>
<h1><img src="<?php echo URL_PUBLIC; ?>frog/plugins/plugin_developer/images/editplugin.png" align="bottom"> Editing your "<?php echo $plugin_name ?>" Plugin</h1>

<form action="<?php echo get_url('plugin/plugin_developer/editplugin_db/'); ?>" method="POST" name="editplugin">

<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="plugin_date_updated" value="<?php echo $plugin_date_updated; ?>" />
<input type="hidden" name="plugin_updated_by" value="<?php echo $plugin_updated_by; ?>" />
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

<p><label>Require Frog Version :</label>
<input class="version" maxlength="2" type="text" name="frog_required_1" value="<?php echo $frog_required_1; ?>"> . 
<input class="version" maxlength="2" type="text" name="frog_required_2" value="<?php echo $frog_required_2; ?>"> . 
<input class="version" maxlength="2" type="text" name="frog_required_3" value="<?php echo $frog_required_3; ?>"></p>

<p><label>License Type :</label>
<select name="plugin_license">
<?php
global $__FROG_CONN__;
$licenses = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_settings_licenses";
$licenses = $__FROG_CONN__->prepare($licenses);
$licenses->execute();
while($license = $licenses->fetchObject()) {
	global $__FROG_CONN__;
	$id = $license->id;
	$license = $license->license_type; ?>
<option value="<?php echo $license ?>" <?php if ($plugin_license == $license) { echo 'selected="selected"'; } ?>><?php echo $license ?></option>
<?php } ?></select> - see <a href="http://www.opensource.org/licenses/alphabetical" target="_blank">OpenSource.org</a> for license information</p>

<p><label>Plugin Condition :</label>
<select name="plugin_condition">
<?php
global $__FROG_CONN__;
$conditions = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_settings_condition";
$conditions = $__FROG_CONN__->prepare($conditions);
$conditions->execute();
while($condition = $conditions->fetchObject()) {
	global $__FROG_CONN__;
	$id = $condition->id;
	$condition = $condition->dev_condition; ?>
<option value="<?php echo $condition ?>" <?php if ($plugin_condition == $condition) { echo 'selected="selected"'; } ?>><?php echo $condition ?></option>
<?php } ?>
</select></p>

<p><label>Published Status :</label>
<select name="plugin_status">
<option value="1" <?php if ($plugin_status == '1') { echo 'selected="selected"'; } ?>>Published</option>
<option value="0" <?php if ($plugin_status == '0') { echo 'selected="selected"'; } ?>>Not Released</option>
</select></p>

<p><label>Download Link :</label>
<?php echo URL_PUBLIC ?><input type="text" name="plugin_file_url" value="<?php echo $plugin_file_url; ?>" /></p>

<p><label>&nbsp;</label>
<small><?php echo $plugin_downloads ?> downloads so far!</small></p>


<p><label>&nbsp;</label>
<input type="submit" value="Edit this Plugin" accesskey="s" /> | <a href="<?php echo get_url('plugin/plugin_developer/index'); ?>">Cancel</a></p>

<?php
global $__FROG_CONN__;
$updated = "SELECT * FROM ".TABLE_PREFIX."user WHERE id='$plugin_updated_by'";
$updated = $__FROG_CONN__->prepare($updated);
$updated->execute();
while($update = $updated->fetchObject()) {
	$plugin_updated_name = $update->name; ?>
<p><label>&nbsp;</label><small>Last edited by <?php echo $plugin_updated_name ?> on <?php echo $plugin_date_updated ?></small></p>
<?php
}
?>




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