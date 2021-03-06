<?php

namespace Drupal\graphql_query_map_entity\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for GraphQL query map forms.
 */
class QueryMapForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state = NULL) {
    $form = parent::buildForm($form, $form_state);
    $form['#title'] = $this->t('Query map version %version', ['%version' => $this->entity->id()]);

    foreach ($this->entity->queryMap as $i => $query) {
      $form['queryMap'][$i] = [
        '#title' => $this->t('ID %id', ['%id' => $i]),
        '#type' => 'textarea',
        '#default_value' => $query,
        '#disabled' => TRUE,
        '#rows' => 15,
      ];
    }

    $form['actions'] = [
      'delete' => [
        '#type' => 'link',
        '#title' => $this->t('Back'),
        '#url' => $this->entity->toUrl('collection'),
      ],
    ];

    return $form;
  }

}
