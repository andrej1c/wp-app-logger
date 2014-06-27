WP App Logger
=============

A WordPress plugin that allows developers to log values of variables through out the flow of their plugins/themes without disrupting the flow.

To start:

1. Activate the plugin
2. Set WP_DEBUG_LOG to true in wp-config.php
3. Add some calls to the action hook in your theme, for example:

```
do_action( 'wp_app_logger', 'At the top of sidebar', $wp_query );
```

If you are logged in as "testuser" and today was 2014-06-27 a log file called "logs/print-2014-06-27-testuser.log" would be created, relative to the plugin folder.

It will contain this line:

At the top of sidebar :{json encoded string of $wp_query}; --17:12:47
