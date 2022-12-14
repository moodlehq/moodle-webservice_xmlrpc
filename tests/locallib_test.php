<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Unit tests for the XML-RPC web service server.
 *
 * @package    webservice_xmlrpc
 * @category   test
 * @copyright  2016 Cameron Ball
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace webservice_xmlrpc;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/webservice/xmlrpc/locallib.php');

/**
 * Unit tests for the XML-RPC web service server.
 *
 * @package    webservice_xmlrpc
 * @category   test
 * @copyright  2016 Cameron Ball
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \webservice_xmlrpc_server
 */
class locallib_test extends \advanced_testcase {

    /**
     * Setup.
     */
    public function setUp(): void {
        if (!function_exists('xmlrpc_decode')) {
            $this->markTestSkipped('XMLRPC is not installed.');
        }
    }

    /**
     * Test that the response generated is correct
     *
     * There is a bug in PHP that causes the xml_rpc library to
     * incorrectly escape multibyte characters. See https://bugs.php.net/bug.php?id=41650
     *
     * @dataProvider prepare_response_provider
     * @param string $returnsdesc  Webservice function return description
     * @param string $returns       Webservice function description
     * @param string $expected      The expected XML-RPC response
     */
    public function test_prepare_response($returnsdesc, $returns, $expected) {
        $server = $this->getMockBuilder('webservice_xmlrpc_server')
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();

        $rc = new \ReflectionClass('webservice_xmlrpc_server');
        $rcm = $rc->getMethod('prepare_response');
        $rcm->setAccessible(true);

        $func = $rc->getProperty('function');
        $func->setAccessible(true);
        $func->setValue($server, (object) ['returns_desc' => new \external_value(PARAM_RAW, $returnsdesc, VALUE_OPTIONAL)]);

        $ret = $rc->getProperty('returns');
        $ret->setAccessible(true);
        $ret->setValue($server, $returns);

        $rcm->invokeArgs($server, []);
        $response = $rc->getProperty('response');
        $response->setAccessible(true);

        $this->assertEquals($expected, $response->getValue($server));
    }

    /**
     * Test that the response generated is correct
     *
     * There is a bug in PHP that causes the xml_rpc library to
     * incorrectly escape multibyte characters. See https://bugs.php.net/bug.php?id=41650
     *
     * @dataProvider generate_error_provider
     * @param Exception $exception An exception to be provided to generate_error
     * @param string    $code      An error code to be provided to generate_error
     * @param string    $expected  The expected XML-RPC response
     */
    public function test_generate_error($exception, $code, $expected) {
        $server = $this->getMockBuilder('webservice_xmlrpc_server')
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();

        $rc = new \ReflectionClass('webservice_xmlrpc_server');
        $rcm = $rc->getMethod('generate_error');
        $rcm->setAccessible(true);

        if ($code === null) {
            $result = $rcm->invokeArgs($server, [$exception]);
        } else {
            $result = $rcm->invokeArgs($server, [$exception, $code]);
        }
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for the prepare_response testcase
     *
     * @return array of testcases
     */
    public function prepare_response_provider() {
        return [
            'Description written with Latin script' => [
                'Ennyn Durin, Aran Moria: pedo mellon a minno',
                'Mellon!',
                '<?xml version="1.0" encoding="UTF-8"?><methodResponse><params><param><value><string>Mellon!</string></value>'
                . '</param></params></methodResponse>'
            ],
            'Description with non-Latin glyphs' => [
                'What biscuits do you have?',
                // V         Unicode 9!         V.
                '???????????? ???????????????? ???????????? ???????????????????????? ???????????????????????????? ???????????????????????????????? ????????????',
                '<?xml version="1.0" encoding="UTF-8"?><methodResponse><params><param><value><string>'
                . '???????????? ???????????????? ???????????? ???????????????????????? ???????????????????????????? ???????????????????????????????? ????????????</string></value></param></params></methodResponse>'
            ]
        ];
    }

    /**
     * Data provider for the generate_error testcase
     *
     * @return array of testcases
     */
    public function generate_error_provider() {
        $glyphs = 'P????r????a????y????e????r???? ????n????o????t???? ????f????o????u????n????d????';
        return [
            'Standard exception with default faultcode' => [
                new \Exception(),
                null,
                '<?xml version="1.0" encoding="UTF-8"?><methodResponse><fault><value><struct>' .
                '<member><name>faultCode</name><value><int>404</int></value></member>' .
                '<member><name>faultString</name><value><string/></value></member>' .
                '</struct></value></fault></methodResponse>'
            ],
            'Standard exception with default faultcode and exception content' => [
                new \Exception('PC LOAD LETTER'),
                null,
                '<?xml version="1.0" encoding="UTF-8"?><methodResponse><fault><value><struct>' .
                '<member><name>faultCode</name><value><int>404</int></value></member>' .
                '<member><name>faultString</name><value><string>PC LOAD LETTER</string></value></member>' .
                '</struct></value></fault></methodResponse>'
            ],
            'Standard exception with really messed up non-Latin glyphs' => [
                new \Exception($glyphs),
                null,
                '<?xml version="1.0" encoding="UTF-8"?><methodResponse><fault><value><struct>' .
                '<member><name>faultCode</name><value><int>404</int></value></member>' .
                '<member><name>faultString</name><value><string>' . $glyphs . '</string></value></member>' .
                '</struct></value></fault></methodResponse>'
            ]
        ];
    }
}
