**Status:** No longer active / archived


Plugin Developer for Wolf CMS
by Andrew Waters
andrew@band-x.org
@andrew_waters

Thanks for downloading my Plugin Developer plugin!



------------
INSTALLATION
------------

Very simple to install:

1. Unzip the files
2. Upload the 'plugin_developer' folder to your plugins directory
3. Go to your admin panel and activate the plugin
4. Click the new 'Plugin Developer' tab and read the documentation instructions



-----
USAGE
-----

This is a plugin for Wolf Plugin Developers who would like to have a quick interface for generating the XML file that allows Wolf to check for the latest update to your plugin wherever it is installed.

Wolf allows developers have the additional field in the plugin settings array:

'update_url'  => 'http://path/to/your/updates.xml'
That XML file contains the following data:

<?xml version="1.0" encoding="iso-8859-1"?>
<wolf-plugins>
    <wolf-plugin>
        <id>pluginid</id>
        <version>1.0.0</version>
        <status>stable</status>
    </wolf-plugin>
</wolf-plugins>

To create the XML file dynamically, simply create a new layout (say, "XML Update", type: "text/xml"). Add this to the layout body:
<?php echo $this->content(); ?>

Then create a page for your file, set the layout to "XML Update" and include the following code in the page:
<?php plugin_developer_xml() ?>

Be sure to change the slug of your page so that it contains the .xml extension.

That page will then update automatically when you update this plugin, saving you time and hassle mucking around in site code.

Extending the XML format

If the XML update function in the core CMS gets updated in the future it is quite easy to add additional fields to the XML file. Just edit the 'plugin_developer/index.php' file inside the plugin_developer_xml() function.



---------
CHANGELOG
---------

1.0.0
+	First Import of source management and updated to work with Wolf CMS
