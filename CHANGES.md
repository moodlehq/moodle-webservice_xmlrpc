All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

The format of this change log follows the advice given at [Keep a CHANGELOG](http://keepachangelog.com).

## [Unreleased]

## [1.0.4] - 2023-09-20
### Fixed
- Better behaviour when the external functions return null results, by providing and "acceptable" empty (xmlrpc-compliant) response.

## [1.0.3] - 2023-09-16
### Added
- Provide compatibility with Moodle 4.2 and the changes to external subsystem.
- PHP 8.2 compatibility

### Fixed
- Fix a few Changelog links to show the correct diffs.

## [1.0.2] - 2022-11-08
### Changed
- GHA CI moved to run against upstream moodle.git (now that the plugin has been removed from core).
- Reorganisation of README and CHANGES, towards easier publishing of new versions.

## [1.0.1] - 2022-11-07
### Changed
- Adjusted to require 20221106 (removed from core) or later.

## 1.0.0 - 2022-10-26
### New
- First release published as standalone plugin.

[Unreleased]: https://github.com/moodlehq/moodle-webservice_xmlrpc/compare/1.0.4...main
[1.0.3]: https://github.com/moodlehq/moodle-webservice_xmlrpc/compare/1.0.3...1.0.4
[1.0.3]: https://github.com/moodlehq/moodle-webservice_xmlrpc/compare/1.0.2...1.0.3
[1.0.2]: https://github.com/moodlehq/moodle-webservice_xmlrpc/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/moodlehq/moodle-webservice_xmlrpc/compare/1.0.0...1.0.1
