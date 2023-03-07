<?php

namespace Drupal\inspirational_tunnel\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;
use Drupal\Core\Url;

/**
 * Class BackofficeController.
 */
class BackofficeController extends ControllerBase {

  /**
   * Hello.
   *
   * @return array
   *   Return Hello string.
   */
  public function hello() : array {
    /*$query = Drupal::database()->select('thematic_criteria', 'tc')
    ->fields('tc', ['name', 'value', 'research_method'])
    ->execute();

    $thematicCriterias = $query->fetchAll();*/

    $headers = ['foo head'];
    $rows = ['foo', 'bar'];
    $table = [
      '#type' => 'table',
      '#header' => $headers,
      '#rows' => $rows,
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'foo',
        ],
      ],
      '#access' => !empty($rows),
    ];

    return $table;
  }

}
