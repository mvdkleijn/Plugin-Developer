<h1><img src="<?php echo URL_PUBLIC; ?>frog/plugins/plugin_developer/images/settings.png" align="bottom"> Plugin Developer Settings</h1>


<?php

global $__FROG_CONN__;

$licenses = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_settings_licenses";
$licenses = $__FROG_CONN__->prepare($licenses);
$licenses->execute();


echo '<h2>Licenses:</h2>';
while($license = $licenses->fetchObject()) {
	global $__FROG_CONN__;
	$license_id = $license->id;
	$license_type = $license->license_type;
?>

<form name="edit_license" id="edit_license" action="<?php echo get_url('plugin/plugin_developer/edit_license/'); ?>" method="POST">
<input type="hidden" name="license_id" value="<?php echo $license_id ?>" /><input class="textbox" type="text" id="license_type" name="license_type" size="30" value="<?php echo $license_type; ?>">&nbsp;
<input class="button" name="edit_license" type="submit" value="Edit License">&nbsp;
<a href="<?php echo get_url('plugin/plugin_developer/remove_license/'.$license_id); ?>" onclick="return confirm('Are you sure you wish to delete <?php echo $license_type ?> from the license list?');">Delete</a>
</form>

<?php } echo ''; ?>
<form name="add_license" id="add_license" action="<?php echo get_url('plugin/plugin_developer/addlicense/'); ?>" method="POST">
<label for="license_type">New:</label><br />
<input class="textbox" type="text" id="license_type" name="license_type" size="30">&nbsp;<input class="button" name="add_license" type="submit" value="Add License"> | <a href="<?php echo get_url('plugin/plugin_developer/index'); ?>">Cancel</a></form>



<?php
global $__FROG_CONN__;

$conditions = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_settings_condition";
$conditions = $__FROG_CONN__->prepare($conditions);
$conditions->execute();


echo '<h2>Development States:</h2>';
while($condition = $conditions->fetchObject()) {
	global $__FROG_CONN__;
	$id = $condition->id;
	$condition = $condition->dev_condition;
?>

<form name="edit_condition" id="edit_condition" action="<?php echo get_url('plugin/plugin_developer/edit_condition/'); ?>" method="POST">
<input type="hidden" name="id" value="<?php echo $id ?>" /><input class="textbox" type="text" id="condition" name="condition" size="30" value="<?php echo $condition; ?>">&nbsp;
<input class="button" name="edit_condition" type="submit" value="Edit condition">&nbsp;
<a href="<?php echo get_url('plugin/plugin_developer/remove_condition/'.$id); ?>" onclick="return confirm('Are you sure you wish to delete <?php echo $condition ?> from the condition list?');">Delete</a>
</form>

<?php } echo ''; ?>
<form name="add_condition" id="add_condition" action="<?php echo get_url('plugin/plugin_developer/add_condition/'); ?>" method="POST">
<label for="dev_condition">New:</label><br />
<input class="textbox" type="text" id="dev_condition" name="dev_condition" size="30">&nbsp;<input class="button" name="add_condition" type="submit" value="Add Condition"> | <a href="<?php echo get_url('plugin/plugin_developer/index'); ?>">Cancel</a></form></div>
