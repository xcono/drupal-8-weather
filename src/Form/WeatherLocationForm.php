<?php

namespace Drupal\xweather\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WeatherLocationForm.
 *
 * @package Drupal\xweather\Form
 */
class WeatherLocationForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $weather_location = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $weather_location->label(),
      '#description' => $this->t("Label for the Weather location."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $weather_location->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\xweather\Entity\WeatherLocation::load',
      ),
      '#disabled' => !$weather_location->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $weather_location = $this->entity;
    $status = $weather_location->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Weather location.', [
          '%label' => $weather_location->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Weather location.', [
          '%label' => $weather_location->label(),
        ]));
    }
    $form_state->setRedirectUrl($weather_location->urlInfo('collection'));
  }

}
