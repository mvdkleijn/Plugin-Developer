<h1><img src="<?php echo URL_PUBLIC; ?>frog/plugins/plugin_developer/images/documentation.png" align="bottom"> Plugin Developer Documentation</h1>
<p>This is a plugin for Frog Plugin Developers who would like to have a quick interface for generating the XML file that allows Frog to check for the latest update to your plugin wherever it is installed.</p>
<p>Frog allows developers have the additional field in the plugin settings array:</p>
<pre>'update_url'  => 'http://path/to/your/updates.xml'</pre>
<p>That XML file contains the following data:</p>
<pre>
&lt;?xml version="1.0" encoding="iso-8859-1"?&gt;
&lt;frog-plugins&gt;
    &lt;frog-plugin&gt;
        &lt;id&gt;pluginid&lt;/id&gt;
        &lt;version&gt;1.0.0&lt;/version&gt;
        &lt;status&gt;stable&lt;/status&gt;
    &lt;/frog-plugin&gt;
&lt;/frog-plugins&gt;
</pre>
<p>To create the XML file dynamically, simply create a new layout (say, "<strong>XML Update</strong>", type: "<strong>text/xml</strong>"). Add this to the layout body:
<pre>&lt;?php echo $this->content(); ?&gt;</pre>
<p>Then create a page for your file, set the layout to "XML Update" and include the following code in the page:</p>
<pre>&lt;?php plugin_developer_xml() ?&gt;</pre>
<p><strong>Be sure to change the slug of your page so that it contains the .xml extension.</strong></p>
<p>That page will then update automatically when you update this plugin, saving you time and hassle mucking around in site code.</p>
<h2>Extending the XML format</h2>
<p>If the XML update function in the core CMS gets updated in the future it is quite easy to add additional fields to the XML file. Just edit the 'plugin_developer/index.php' file inside the <small>plugin_developer_xml()</small> function.</p>