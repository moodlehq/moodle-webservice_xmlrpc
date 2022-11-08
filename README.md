XML-RPC webservice protocol
=======================
[![XMLRPC webservice CI](https://github.com/moodlehq/moodle-webservice_xmlrpc/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/moodlehq/moodle-webservice_xmlrpc/actions/workflows/ci.yml)

* Maintained by: Moodle HQ
* Copyright: 2009 onwards, multiple contributors.
* License: [GPL-3.0](LICENSE)

Integrate Moodle with other systems using the XML-RPC protocol.

Description
-----------

Using this webservice protocol plugin, other services can consume [Moodle's webservices](https://docs.moodle.org/en/Web_services) using the [XML-RPC](http://xmlrpc.com) protocol.

It supports the complete web services stack of Moodle (authentication and authorisation, tokens, services and functions, restrictions...) and has access to [all the functions](https://docs.moodle.org/dev/Web_service_API_functions) defined there.

This plugin was part of core until Moodle 4.0, finally removed for Moodle 4.1 and transferred here to become a contrib plugin. Main reason for that was the dependency on the, also [removed from PHP](https://php.watch/versions/8.0/xmlrpc) since version 8.0, [php-xmlrpc extension](https://www.php.net/manual/en/book.xmlrpc.php).

See [MDL-70889](https://tracker.moodle.org/browse/MDL-70889) for more information about the move.

Requirements
------------

- **Moodle** site >= 4.1.
- **php-xmlrpc** extension installed and enabled.

Installation
------------

- Via git, or direct (zip) download from the plugins directory or from GitHub.
- Add it to the `webservice/xmlrpc` directory.
- Install / upgrade the Moodle site.
- Follow the "[Using web services](https://docs.moodle.org/en/Using_web_services)" docs to enable and configure everything needed to start using it.

Usage
-----

(add here some examples: - authentication with token, a few calls...). Ideally curl requests.

Useful links
------------

* Git repository: https://github.com/moodlehq/moodle-webservice_xmlrpc
* Moodle Plugins Directory: https://moodle.org/plugins/webservice_xmlrpc
* Issues: https://github.com/moodlehq/moodle-webservice_xmlrpc/issues
* Contributions: https://github.com/moodlehq/moodle-webservice_xmlrpc/pulls
* Discussions: https://moodle.org/mod/forum/view.php?id=6971

Roadmap
-------

No roadmap right now.
