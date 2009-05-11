<?php


Plugin::setInfos(array(
    'id'          => 'plugin_developer',
    'title'       => 'Plugin Developer',
    'description' => 'Helps you track plugins you develop and generates an update.xml file',
    'version'     => '0.0.9',
	'update_url'  => 'http://www.band-x.org/downloads/open-source/update.xml',
    'author'      => 'Andrew Waters',
    'website'     => 'http://www.band-x.org'));

Plugin::addController('plugin_developer', 'Plugin Developer', 'administrator');

function plugin_developer_xml() {
	
	global $__FROG_CONN__;
	$sql = "SELECT * FROM ".TABLE_PREFIX."plugin_developer_plugins WHERE plugin_status='1'";
	$sql = $__FROG_CONN__->prepare($sql);
	$sql->execute();

	echo '<?xml version="1.0" encoding="iso-8859-1"?>
<frog-plugins>';

	while($plugin_details = $sql->fetchObject()){
		$plugin_name = $plugin_details->plugin_name;
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
		$plugin_date_updated = $plugin_details->plugin_date_updated;
		$plugin_created_by = $plugin_details->plugin_created_by;
		$plugin_updated_by = $plugin_details->plugin_updated_by;
		$plugin_condition = $plugin_details->plugin_condition;
		$plugin_url = $plugin_details->plugin_url;
		$plugin_downloads = $plugin_details->plugin_downloads;
		$plugin_status = $plugin_details->plugin_status;

		echo '
	<frog-plugin>';
		echo '
		<id>'.$plugin_id.'</id>
		<version>'.$plugin_version_1.'.'.$plugin_version_2.'.'.$plugin_version_3.'</version>
		<status>'.$plugin_condition.'</status>';
		echo '
	</frog-plugin>';
	}

	echo '
</frog-plugins>';

}