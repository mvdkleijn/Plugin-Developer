<?php

global $__CMS_CONN__;


$check_db = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_plugins";
$check_db = $__CMS_CONN__->prepare($check_db);
$check_db->execute();
$check_db = $check_db->rowCount();

if ($check_db != 0) {
}
else {

// Let's create the tables
$create_plugins = 'CREATE TABLE `'.TABLE_PREFIX.'plugin_developer_plugins` (
  `id` int(5) NOT NULL auto_increment,
  `plugin_name` varchar(100) default NULL,
  `plugin_author` varchar(100) default NULL,
  `plugin_email` varchar(100) default NULL,
  `plugin_website` varchar(100) default NULL,
  `plugin_overview` varchar(5000) default NULL,
  `plugin_version_1` int(2) default NULL,
  `plugin_version_2` int(2) default NULL,
  `plugin_version_3` int(2) default NULL,
  `wolf_required_1` int(2) default NULL,
  `wolf_required_2` int(2) default NULL,
  `wolf_required_3` int(2) default NULL,
  `plugin_license` varchar(50) default NULL,
  `plugin_date_created` varchar(10) default NULL,
  `plugin_date_updated` varchar(10) default NULL,
  `plugin_created_by` int(5) default NULL,
  `plugin_updated_by` int(5) default NULL,
  `plugin_id` varchar(100) default NULL,
  `plugin_condition` varchar(100) default NULL,
  `plugin_file_url` varchar(500) default NULL,
  `plugin_downloads` int(5) default NULL,
  `plugin_status` int(5) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;';

$create_plugin_conditions = 'CREATE TABLE `'.TABLE_PREFIX.'plugin_developer_settings_condition` (
  `id` int(5) NOT NULL auto_increment,
  `dev_condition` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;';


$create_plugin_licenses = 'CREATE TABLE `'.TABLE_PREFIX.'plugin_developer_settings_licenses` (
  `id` int(5) NOT NULL auto_increment,
  `license_type` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;';

$stmt = $__CMS_CONN__->prepare($create_plugins);
$stmt->execute();
$stmt = $__CMS_CONN__->prepare($create_plugin_conditions);
$stmt->execute();
$stmt = $__CMS_CONN__->prepare($create_plugin_licenses);
$stmt->execute();




$plugin_conditions_insert = "INSERT INTO `".TABLE_PREFIX."plugin_developer_settings_condition` (`id`,`dev_condition`)
VALUES
	(1,'Alpha'),
	(2,'Beta'),
	(3,'Stable');";


$plugin_licenses_insert = "INSERT INTO `".TABLE_PREFIX."plugin_developer_settings_licenses` (`id`,`license_type`)
VALUES
	(1,'APL'),
	(2,'BSD'),
	(3,'GNU'),
	(4,'MIT'),
	(5,'GNU Affero GPL');";

$stmt = $__CMS_CONN__->prepare($plugin_conditions_insert);
$stmt->execute();
$stmt = $__CMS_CONN__->prepare($plugin_licenses_insert);
$stmt->execute();





}
?>



<h1><img src="<?php echo URL_PUBLIC; ?>wolf/plugins/plugin_developer/images/viewplugins.png" align="bottom"> Plugin Developer</h1>
<p>Plugin Developer will help you keep track of your developed plugins and can automatically update the XML file you use to let users know about updates. You can also use the content here to display information on your site.</p>

<table class="index" cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th>Plugin</th>
      <th>ID</th>
      <th>Latest Version</th>
      <th>Created</th>
      <th>Status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php
	global $__CMS_CONN__;
	$sql = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_plugins ORDER BY plugin_name";
	$sql = $__CMS_CONN__->prepare($sql);
	$sql->execute();

	echo '<?xml version="1.0" encoding="iso-8859-1"?>
<wolf-plugins>';

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
		$wolf_required_1 = $plugin_details->wolf_required_1;
		$wolf_required_2 = $plugin_details->wolf_required_2;
		$wolf_required_3 = $plugin_details->wolf_required_3;
		$plugin_license = $plugin_details->plugin_license;
		$plugin_date_created = $plugin_details->plugin_date_created;
		$plugin_date_updated = $plugin_details->plugin_date_updated;
		$plugin_created_by = $plugin_details->plugin_created_by;
		$plugin_updated_by = $plugin_details->plugin_updated_by;
		$plugin_condition = $plugin_details->plugin_condition;
		$plugin_file_url = $plugin_details->plugin_file_url;
		$plugin_downloads = $plugin_details->plugin_downloads;
		$plugin_status = $plugin_details->plugin_status;
?>

<tr class="node <?php echo odd_even(); ?>">
	<td><p><img src="<?php echo URL_PUBLIC; ?>wolf/plugins/plugin_developer/images/plugin.png" align="middle" alt="user icon" /> <a href="<?php echo get_url('plugin/plugin_developer/editplugin/'.$id); ?>"><?php echo $plugin_name ?></a></p></td>
	<td><small><?php echo $plugin_id ?></small></td>
	<td><small><?php echo $plugin_version_1 ?>.<?php echo $plugin_version_2 ?>.<?php echo $plugin_version_3 ?> <?php echo $plugin_condition ?> (<?php echo $plugin_license ?>)</small></td>
	<td><small><?php echo $plugin_date_created ?> by <?php echo $plugin_author ?></small></td>
	<td><small><?php if ($plugin_status == '0') { echo 'Not Released'; } else { echo 'Published'; } ?></small></td>
	<td><p><a href="<?php echo get_url('plugin/plugin_developer/deleteplugin_db/'.$id); ?>" onclick="return confirm('Would you like to delete your <?php echo $plugin_name ?> plugin?');"><img src="<?php echo URL_PUBLIC; ?>wolf/plugins/plugin_developer/images/delete.png" align="middle" alt="user icon" /></a></p></td>
</tr>

<?php
	}
?>



  </tbody>
</table>
