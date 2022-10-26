XML-RPC webservice protocol
=======================
* Maintained by: Moodle HQ
* Copyright: 2009 onwards, multiple contributors.
* License: [GPL-3.0](LICENSE)

Integrate Moodle with other services using the XML-RPC protocol.

Description
===========
Using this webservice protocol plugin, other services can consume [Moodle's webservices](https://docs.moodle.org/en/Web_services) using the [XML-RPC](http://xmlrpc.com) protocol.

It supports the complete web services stack of Moodle (authentication and authorisation, tokens, services and functions, restrictions...) and has access to [all the functions](https://docs.moodle.org/dev/Web_service_API_functions) defined there.

This plugin was part of core until Moodle 4.0, finally removed for Moodle 4.1 and transferred here to become a contrib plugin. Main reason for that was the dependency on the, also [removed from PHP](https://php.watch/versions/8.0/xmlrpc) since version 8.0, [php-xmlrpc extension](https://www.php.net/manual/en/book.xmlrpc.php).

See [MDL-70889](https://tracker.moodle.org/browse/MDL-70889) for more information about the move.

Installation
============
- Via git, or direct (zip) download from the plugins directory or from GitHub.
- Add it to the `webservice/xmlrpc` directory.
- Install / upgrade the Moodle site.
- Done.

Requirements
------------
- **Moodle** site >= 4.1.
- **php-xmlrpc** extension installed and enabled.

Useful links
============
* Git repository: https://github.com/moodlehq/moodle-webservice_xmlrpc
* Moodle Plugins Directory:  [coming soon]
* Issues: https://github.com/moodlehq/moodle-webservice_xmlrpc/issues
* Contributions: https://github.com/moodlehq/moodle-webservice_xmlrpc/pulls

Roadmap
=======
No roadmap right now.

Release history
===============
- 20221026 - 1.0.0 - First release published as standalone plugin.