<?php

namespace Drupal\inspirational_tunnel\Form\Backoffice\Step;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class NameForm.
 */
class NameForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'name_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'machine_name',
      '#title' => $this->t('Name'),
      '#description' => $this->t("Nom de l'étape"),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#maxlength' => 64,
      '#description' => $this->t('A unique name for this block instance. Must be alpha-numeric and underscore separated.'),
      '#default_value' => 'Jasmin',
      '#machine_name' => [
        'exists' => array($this, 'exists'),
        'replace_pattern' => '[^a-z0-9_.]+',
        'source' => ['settings', 'label'],
      ],
      '#required' => TRUE,
      //'#disabled' => !$entity->isNew(),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function exists() {
    return false;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    ddm($form_state->getValues());
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }
  }

}
