=== Disable Plugins ===
Contributors: kynatro
Donate link: http://www.kynatro.com/
Tags: plugin manager, mu plugin, plugin filtering, disable plugin, specific page, plugin organizer
Requires at least: 2.9.0
Tested up to: 3.1.2
Stable tag: trunk

Manage which plugins load on what page with simple regular expression pattern matches similar to an Apache .htaccess file

== Description ==
One of WordPress' biggest bottlenecks is that it loads every single plugin that 
is active on your WordPress installation on every single post/page no matter 
whether they are needed for that post/page or not. This plugin will allow you 
to create simple rewrite rules to exclude a plugin or plugins from any URI 
pattern match. This is a great way to reduce the memory footprint, SQL queries 
run at page load, load times, and improve site response speed.

This is NOT a normal WordPress plugin, but an *mu* (must use) plugin and requires
special installation instructions. Please see the [installation section](http://wordpress.org/extend/plugins/disable-plugins) for more
information.

**Requirements:** PHP5+, WordPress 2.9.x+

== Installation ==
Create a `/wp-content/mu-plugins/disable-plugins-rules` directory if the plugin
has not created one for you already. Create a rules file for each site your
WordPress installation is running, naming the file after the host name for
the site followed by a `.rules` extension. For example `mywordpresssite.com.rules`
would be a rules set for `mywordpresssite.com`.

Populate your rules using regular expression pattern matches and plugin base
names on each line of your rules file. For example, to exclude the *Hello Dolly*
and *Akisment* plugins from being loaded on your home page, you would write 
a rules file that looks like:

<code># Prevent the Hello Dolly plugin from loading on the home page
^\/$ hello
# Prevent the Akisment plugin from loading on the home page
^\/$ akismet</code>

You will need to write a rule for each plugin that will be excluded for each
pattern that you wish to exclude that plugin from. C style comments are 
allowed in your rules file to document your rules.

== Frequently Asked Questions ==
**Q. How do I format my exception rule?**

This is pretty easy to do, just two pieces to each line - the regular expression pattern and the plugin's basename (usually the folder or file name of the plugin). See the installation section for an example of how this might look.

**Q. Will this work on a multisite installation?**

This plugin is made to run with multisite in mind, but it has not been tested with a multisite installation yet.

**Q. How do you write regular expressions and do you have any good tools for writing them?**

If you're asking this question, you may want to consider a different plugin to help manage your site's plugin use, but you can check out the following resources:

* Good information on regular expressions - [Regular Expressions](http://www.regular-expressions.info/)
* A nice cheat sheet for writing regular expressions - [Regular Expressions Cheat Sheet](http://www.addedbytes.com/cheat-sheets/regular-expressions-cheat-sheet/)
* A great library of regular expression patterns - [Regular Expression Library](http://regexlib.com/)
* An excellent tool for testing patterns - [RegexPal Testing Tool](http://www.regexpal.com/)

Unfortunately, I really can't do much support for this plugin, but time permitting I will continue to develop it. I am considering an admin interface for easier management, but thats down the road a bit.

== Changelog ==

= 1.0.0 =
* Initial release
