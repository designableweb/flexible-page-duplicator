# Flexible Page Duplicator
A simple WordPress plugin to duplicate pages along with their Advanced Custom Fields (ACF) and content, including flexible content fields.

<h2>Description</h2>
<p>Flexible Page Duplicator is a WordPress plugin designed to quickly and easily duplicate pages along with their associated ACF fields and content, including flexible content fields. This plugin is a valuable tool for developers and content managers who often need to duplicate pages with complex ACF structures.</p>

When a user clicks the "Duplicate" link, the plugin does the following:
<ol>
    <li>Retrieves the original page's data, including the title, content, and post type.</li>
    <li>Creates a new page as a draft with the same title, content, and post type as the original page.</li>
    <li>Retrieves the ACF field objects associated with the original page using get_field_objects.</li>
    <li>Loops through the ACF field objects and copies their values to the new page using update_field. This includes fields inside flexible content fields.</li>
    <li>Copies the original page's template to the new page using update_post_meta.</li>
</ol>

<h2>Installation</h2>
Download the plugin files and extract them to a folder on your computer.
Upload the extracted flexible-page-duplicator folder to the /wp-content/plugins/ directory of your WordPress installation.
Activate the plugin through the 'Plugins' menu in WordPress.
Note: Flexible Page Duplicator requires the Advanced Custom Fields plugin to be installed and activated.

<h2>Usage</h2>
Once the plugin is activated, a 'Duplicate' action link will be added to the 'Pages' menu in the WordPress admin area. To duplicate a page, simply click the 'Duplicate' link next to the page you wish to copy. A new draft version of the page will be created, containing all of the original page's content and ACF fields.

<h2>Contributing</h2>
If you would like to contribute to the development of this plugin, please feel free to submit a pull request or report any issues you encounter.

<h2>Authors</h2>
GPT4 with bill@designableweb.com (holding the lug nuts)

<h2>License</h2>
This project is licensed under the GNU General Public License v3.0. Please see the LICENSE file for details.
