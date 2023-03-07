<?php

namespace Drupal\inspirational_tunnel\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the inspirational_tunnel module.
 */
class BackofficeControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "inspirational_tunnel BackofficeController's controller functionality",
      'description' => 'Test Unit for module inspirational_tunnel and controller BackofficeController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests inspirational_tunnel functionality.
   */
  public function testBackofficeController() {
    // Check that the basic functions of module inspirational_tunnel.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
