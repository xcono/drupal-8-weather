<?php

/**
 * @file
 * Contains \Drupal\xcore\Form\XcoreCompanySettingsForm.
 */

namespace Drupal\xweather\Form;

use Drupal\Component\Utility\Unicode;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure text display settings for this the hello world page.
 */
class WeatherSettingsForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormID() {
        return 'xweather_settings_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
          $this->getConfigName(),
        ];
    }

    private function getConfigName() {
        return 'xweather.settings';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $config = $this->config($this->getConfigName());
        $section = 'settings';

        foreach($config->getRawData()[$section] as $key => $value) {

            $form[$key] = array(
              '#type' => 'textfield',
              '#title' => $this->t(Unicode::ucfirst(str_replace('_', ' ', $key))),
              '#default_value' => $config->get($section . '.' . $key)
            );
        }

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $config = $this->config($this->getConfigName());
        $section = 'settings';

        foreach($config->getRawData()[$section] as $key => $value) {

            $config->set($section . '.' . $key, $form_state->getValue($key));
        }

        $config->save();

        parent::submitForm($form, $form_state);
    }
}