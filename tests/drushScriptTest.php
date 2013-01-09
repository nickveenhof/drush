<?php

/*
 * @file
 *   Tests for the 'drush' script itself
 */
class drushScriptCase extends Drush_CommandTestCase {

  /*
   * Test drush ssh --simulate. No additional bash passed.
   */
  public function testPhpOptionsTest() {
    // todo: could probably run this test on mingw
    if ($this->is_windows()) {
      $this->markTestSkipped('environment variable tests not currently functional on Windows.');
    }

    $options = array(
    );
    $env = array(
      'PHP_OPTIONS' => '-d default_mimetype="text/drush"',
    );
    $this->drush('ev', array('print ini_get("default_mimetype");'), $options, NULL, NULL, self::EXIT_SUCCESS, NULL, $env);
    $output = $this->getOutput();
    $expected = sprintf('Calling proc_open(ssh -o PasswordAuthentication=no %s@%s);', self::escapeshellarg('user'), self::escapeshellarg('server'));
    $this->assertEquals('text/drush', $output);
  }
}
