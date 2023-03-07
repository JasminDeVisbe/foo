<?php

namespace Drupal\inspirational_tunnel\Form\Backoffice\Step;

use Drupal;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Url;

/**
 * Allow to update the order of the steps in the inspirational tunnel.
 */
class CollectionForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'step_listing_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $table = [];
    $table['steps'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Etape'),
        $this->t('Catégorie'),
        $this->t('Operations'),
        $this->t('Weight'),
      ],
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'weight',
        ],
      ],
      '#value_callback' => [static::class, 'setMediaTypesValue'],
    ];

    $steps = [
      [
        'title' => 'step 1',
        'categories' => 
        [
          '<front>' => 'foo',
          '<current>' => 'bar'
        ],
        'route_action' => '<front>'
      ],
      [
        'title' => 'step 2',
        'categories' => [
          '<front>' => 'foo',
          '<current>' => 'bar'
        ],
        'route_action' => '<front>'
      ]
    ];

    $weight = 0;

    foreach ($steps as $stepId => $step) {
      $categoriesLinks = [];
      foreach ($step['categories'] as $categoryRoute => $categoryLabel) {
        $categoriesLink = [
          '#type' => 'link',
          '#title' => $categoryLabel,
          '#url' => Url::fromRoute($categoryRoute)
        ];
        $categoriesLinks[] = Drupal::service('renderer')->render($categoriesLink);
      }

      $label = $step['title'];
      $table['steps'][$stepId] = [
        'label' => [
          'value' => ['#markup' => $label],
          'id' => [
            '#type' => 'hidden',
            '#title_display' => 'invisible',
            '#default_value' => $stepId,
            '#attributes' => ['class' => ['step-id']],
          ],
        ],
        'categories' => ['#markup' => implode(', ', $categoriesLinks)],
        'link' => [
          '#type' => 'link',
          '#attributes' => ['class' => ['button']],
          '#title' => $this->t('Modifier'),
          '#url' => Url::fromRoute($step['route_action'])
        ],
        'weight' => [
          '#type' => 'weight',
          '#title' => $this->t('Weight for @title', ['@title' => $label]),
          '#title_display' => 'invisible',
          '#default_value' => $weight,
          '#attributes' => ['class' => ['weight']],
        ],
        '#weight' => $weight,
        '#attributes' => ['class' => ['draggable']],
      ];

      $weight++;
    }

    return [
      'table' => $table,
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //dd($form_state->getValues());
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }
  }

}
