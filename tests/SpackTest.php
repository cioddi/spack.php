<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
 
class FleximgTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://127.0.0.1/spack/tests/testpage.php');
    }
 
    public function testLoadPage()
    {
        $this->open('http://127.0.0.1/spack/tests/testpage.php');
        $this->assertTitle('Spack Testpage');
    }

    /**
     * @depends testLoadPage
     */
    public function testInlineJavascript()
    {

        $this->open('http://127.0.0.1/spack/tests/testpage.php');
        $this->assertText('id=inlineTest','inline');
    }

    /**
     * @depends testLoadPage
     */
    public function testExternalJavascript()
    {

        $this->open('http://127.0.0.1/spack/tests/testpage.php');
        $this->assertText('id=externalTest','external');
    }

}
?>