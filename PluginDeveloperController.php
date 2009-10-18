<?php
class PluginDeveloperController extends PluginController {

	public function __construct() {
		$this->setLayout('backend');
		$this->assignToLayout('sidebar', new View('../../plugins/plugin_developer/views/sidebar'));  
	}

	public function index() {
		$this->display('plugin_developer/views/index');
	}

	public function documentation() {
		$this->display('plugin_developer/views/documentation');
	}

	function settings() {
		$this->display('plugin_developer/views/settings');
	}

	function addplugin() {
		$this->display('plugin_developer/views/addplugin');
	}

	function editplugin($id) {
		$this->display('plugin_developer/views/editplugin', array('id' => $id));
	}

	function addplugin_db() {

		global $__CMS_CONN__;

		$plugin_name = mysql_escape_string($_POST['plugin_name']);
		$plugin_id = mysql_escape_string($_POST['plugin_id']);
		$plugin_author = mysql_escape_string($_POST['plugin_author']);
		$plugin_email = mysql_escape_string($_POST['plugin_email']);
		$plugin_website = mysql_escape_string($_POST['plugin_website']);
		$plugin_overview = mysql_escape_string($_POST['plugin_overview']);
		$plugin_version_1 = mysql_escape_string($_POST['plugin_version_1']);
		$plugin_version_2 = mysql_escape_string($_POST['plugin_version_2']);
		$plugin_version_3 = mysql_escape_string($_POST['plugin_version_3']);
		$wolf_required_1 = mysql_escape_string($_POST['wolf_required_1']);
		$wolf_required_2 = mysql_escape_string($_POST['wolf_required_2']);
		$wolf_required_3 = mysql_escape_string($_POST['wolf_required_3']);
		$plugin_license = mysql_escape_string($_POST['plugin_license']);
		$plugin_date_created = mysql_escape_string($_POST['plugin_date_created']);
		$plugin_date_updated = '';
		$plugin_created_by = mysql_escape_string($_POST['plugin_created_by']);
		$plugin_updated_by = '';
		$plugin_condition = mysql_escape_string($_POST['plugin_condition']);
		$plugin_file_url = mysql_escape_string($_POST['plugin_file_url']);
		$plugin_status = mysql_escape_string($_POST['plugin_status']);

		$sql = "INSERT INTO ".TABLE_PREFIX."plugin_developer_plugins 
(id, plugin_name, plugin_author, plugin_email, plugin_website, plugin_overview, plugin_version_1, plugin_version_2, plugin_version_3, wolf_required_1, wolf_required_2, wolf_required_3, plugin_license, plugin_date_created, plugin_date_updated, plugin_created_by, plugin_updated_by, plugin_id, plugin_condition, plugin_file_url, plugin_downloads, plugin_status)
VALUES
('', '".$plugin_name."', '".$plugin_author."', '".$plugin_email."', '".$plugin_website."', '".$plugin_overview."', '".$plugin_version_1."', '".$plugin_version_2."', '".$plugin_version_3."', '".$wolf_required_1."', '".$wolf_required_2."', '".$wolf_required_3."', '".$plugin_license."', '".$plugin_date_created."', '".$plugin_date_updated."', '".$plugin_created_by."', '".$plugin_updated_by."', '".$plugin_id."', '".$plugin_condition."', '".$plugin_file_url."', '0', '".$plugin_status."')";
		$sql = $__CMS_CONN__->prepare($sql);
        $sql->execute(); 

		Flash::set('success', __(''.$plugin_name.' has been added to the Plugin List'));
		redirect(get_url('plugin/plugin_developer/index'));

	}

	function deleteplugin_db($id) {
		global $__CMS_CONN__;
		$sql = "DELETE FROM ".TABLE_PREFIX."plugin_developer_plugins WHERE id='".$id."'";
		$sql = $__CMS_CONN__->prepare($sql);
		$sql->execute();
		Flash::set('success', __('This Plugin has been deleted'));
		redirect(get_url('plugin/plugin_developer/'));
	}

	function editplugin_db() {

		global $__CMS_CONN__;

		$id = mysql_escape_string($_POST['id']);
		$plugin_name = mysql_escape_string($_POST['plugin_name']);
		$plugin_id = mysql_escape_string($_POST['plugin_id']);
		$plugin_author = mysql_escape_string($_POST['plugin_author']);
		$plugin_email = mysql_escape_string($_POST['plugin_email']);
		$plugin_website = mysql_escape_string($_POST['plugin_website']);
		$plugin_overview = mysql_escape_string($_POST['plugin_overview']);
		$plugin_version_1 = mysql_escape_string($_POST['plugin_version_1']);
		$plugin_version_2 = mysql_escape_string($_POST['plugin_version_2']);
		$plugin_version_3 = mysql_escape_string($_POST['plugin_version_3']);
		$wolf_required_1 = mysql_escape_string($_POST['wolf_required_1']);
		$wolf_required_2 = mysql_escape_string($_POST['wolf_required_2']);
		$wolf_required_3 = mysql_escape_string($_POST['wolf_required_3']);
		$plugin_license = mysql_escape_string($_POST['plugin_license']);
		$plugin_date_created = mysql_escape_string($_POST['plugin_date_created']);
		$plugin_date_updated = mysql_escape_string($_POST['plugin_date_updated']);
		$plugin_created_by = mysql_escape_string($_POST['plugin_created_by']);
		$plugin_updated_by = mysql_escape_string($_POST['plugin_updated_by']);
		$plugin_condition = mysql_escape_string($_POST['plugin_condition']);
		$plugin_file_url = mysql_escape_string($_POST['plugin_file_url']);
		$plugin_status = mysql_escape_string($_POST['plugin_status']);

		$sql = "UPDATE ".TABLE_PREFIX."plugin_developer_plugins SET
			`id`='".$id."',
			`plugin_name`='".$plugin_name."',
			`plugin_id`='".$plugin_id."',
			`plugin_author`='".$plugin_author."',
			`plugin_email`='".$plugin_email."',
			`plugin_website`='".$plugin_website."',
			`plugin_overview`='".$plugin_overview."',
			`plugin_version_1`='".$plugin_version_1."',
			`plugin_version_2`='".$plugin_version_2."',
			`plugin_version_3`='".$plugin_version_3."',
			`wolf_required_1`='".$wolf_required_1."',
			`wolf_required_2`='".$wolf_required_2."',
			`wolf_required_3`='".$wolf_required_3."',
			`plugin_license`='".$plugin_license."',
			`plugin_date_created`='".$plugin_date_created."',
			`plugin_date_updated`='".$plugin_date_updated."',
			`plugin_created_by`='".$plugin_created_by."',
			`plugin_updated_by`='".$plugin_updated_by."',
			`plugin_condition`='".$plugin_condition."',
			`plugin_file_url`='".$plugin_file_url."',
			`plugin_status`='".$plugin_status."'
		WHERE id='$id'";
		
		$sql = $__CMS_CONN__->prepare($sql);
        $sql->execute(); 

		Flash::set('success', __(''.$plugin_name.' has been edited'));
		redirect(get_url('plugin/plugin_developer/index'));

	}

	function addlicense() {
		global $__CMS_CONN__;

		$license_type = mysql_escape_string($_POST['license_type']);

		$sql = "INSERT INTO ".TABLE_PREFIX."plugin_developer_settings_licenses 
(id, license_type)
VALUES
('', '".$license_type."')";
		$sql = $__CMS_CONN__->prepare($sql);
        $sql->execute(); 
	
		Flash::set('success', __(''.$license_type.'has been added'));
		redirect(get_url('plugin/plugin_developer/settings'));		
	}

	function remove_license($id) {
		global $__CMS_CONN__;
		$sql = "DELETE FROM ".TABLE_PREFIX."plugin_developer_settings_licenses WHERE id='".$id."'";
		$sql = $__CMS_CONN__->prepare($sql);
		$sql->execute();
		Flash::set('success', __('This License Type has been deleted'));
		redirect(get_url('plugin/plugin_developer/settings'));
	}

	function edit_license() {
		global $__CMS_CONN__;
		$license_id = mysql_escape_string($_POST['license_id']);
		$license_type = mysql_escape_string($_POST['license_type']);
		if ($license_type == "") {
			Flash::set('error', __('There was a problem updating this license'));
			redirect(get_url('plugin/plugin_developer/settings/'));
		}
		else {
			$sql = "UPDATE ".TABLE_PREFIX."plugin_developer_settings_licenses SET `license_type`='".$license_type."' WHERE id='".$license_id."'";
			$sql = $__CMS_CONN__->prepare($sql);
			$sql->execute();
			Flash::set('success', __(''.$license_type.' has been edited'));
			redirect(get_url('plugin/plugin_developer/settings'));
		}
	}

	function add_condition() {

		global $__CMS_CONN__;
		$condition = mysql_escape_string($_POST['dev_condition']);

		$sqlo = "INSERT INTO ".TABLE_PREFIX."plugin_developer_settings_condition (id, dev_condition) VALUES ('', '".$condition."')";
		$sqlo = $__CMS_CONN__->prepare($sqlo);
        $sqlo->execute(); 
	
		Flash::set('success', __(''.$condition.'has been added'));
		redirect(get_url('plugin/plugin_developer/settings'));		
	}




	function remove_condition($id) {
		global $__CMS_CONN__;
		$sql = "DELETE FROM ".TABLE_PREFIX."plugin_developer_settings_condition WHERE id='".$id."'";
		$sql = $__CMS_CONN__->prepare($sql);
		$sql->execute();
		Flash::set('success', __('This Condition Type has been deleted'));
		redirect(get_url('plugin/plugin_developer/settings'));
	}

	function edit_condition() {
		global $__CMS_CONN__;
		$id = mysql_escape_string($_POST['id']);
		$condition = mysql_escape_string($_POST['condition']);
		if ($condition == "") {
			Flash::set('error', __('There was a problem updating this condition'));
			redirect(get_url('plugin/plugin_developer/settings/'));
		}
		else {
			$sql = "UPDATE ".TABLE_PREFIX."plugin_developer_settings_condition SET `dev_condition`='".$condition."' WHERE id='".$id."'";
			$sql = $__CMS_CONN__->prepare($sql);
			$sql->execute();
			Flash::set('success', __(''.$condition.' has been edited'));
			redirect(get_url('plugin/plugin_developer/settings'));
		}
	}

}