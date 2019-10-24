<?php

namespace Drupal\charts_overrides\Plugin\views\style;

use Drupal\charts\Plugin\views\style\ChartsPluginStyleChart;
use Drupal\core\form\FormStateInterface;



/**
 * Style plugin to render view as a chart.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "chart_overrides",
 *   title = @Translation("Chart Overrides"),
 *   help = @Translation("Render a chart of your data."),
 *   theme = "views_view_charts",
 *   display_types = { "normal" }
 * )
 */
class ChartsOverridesPluginStyleChart extends ChartsPluginStyleChart {

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['credits'] = [
      '#title' => t('Chart Credits'),
      '#type' => 'textarea',
      '#default_value' => $this->options['credits'],
      '#weight' => -2
    ];

    $form['subtitle'] = [
      '#title' => t('Subtitle'),
      '#type' => 'textfield',
      '#default_value' => $this->options['subtitle'],
      '#size' => 60,
      '#maxlength' => 355,
      '#weight' => -1
    ];

    $form['xaxis_min'] = [
      '#title' => t('X-Axis Min'),
      '#type' => 'textfield',
      '#default_value' => $this->options['xaxis_min'],
      '#size' => 30,
      '#maxlength' => 50,
      '#weight' => -3
    ];

    $form['xaxis_max'] = [
      '#title' => t('X-Axis Max'),
      '#type' => 'textfield',
      '#default_value' => $this->options['xaxis_max'],
      '#size' => 30,
      '#maxlength' => 50,
      '#weight' => -4
    ];

    $form['xaxis_interval'] = [
      '#title' => t('X-Axis Interval'),
      '#type' => 'textfield',
      '#default_value' => $this->options['xaxis_interval'],
      '#size' => 30,
      '#maxlength' => 50,
      '#weight' => -5
    ];

    $form['scatter_colors'] = [
      '#title' => t('Scatter Colors'),
      '#type' => 'textarea',
      '#weight' => -6,
      '#default_value' => $this->options['scatter_colors'],
    ];

    $form['reverse_series'] = [
      '#title' => t('Use reverse series'),
      '#type' => 'checkbox',
      '#weight' => -7,
      '#default_value' => $this->options['reverse_series']
    ];

    $form['percent_format'] = [
      '#title' => t('Use percent format'),
      '#type' => 'checkbox',
      '#weight' => -8,
      '#default_value' => $this->options['percent_format']
    ];

    //New code
    $form['cfields'] = [
      '#title' => $this->t('For custom lines'),
      '#type' => 'fieldset',
      '#weight' => 1,
    ];
    $data_fields = [];
    foreach ($form['fields']['table'] as $key => $value) {
      //$value have key 'data_fields'
      if (array_key_exists('data_fields',$value)) {
       array_push($data_fields,array_keys($value['data_fields'])[0]);
      }
    }

      $form['cfields']['line_fields'] = [
        '#type' => 'radios',
        '#title' => $this->t('Field for lines'),
        '#options' => $data_fields + ['' => $this->t('No data field')],
        //'#default_value' => $data_fields[0],
        '#weight' => -10,
        '#parents' => ['line_fields'],
        '#column' => 'one',
      ];

      $form['cfields']['ind_fields'] = [
        '#type' => 'radios',
        '#title' => $this->t('Indicator field'),
        '#options' => $data_fields + ['' => $this->t('No data field')],
        //'#default_value' => $data_fields[1],
        '#weight' => -9,
        '#parents' => ['ind_fields'],
        '#column' => 'two',
      ];
      //End


    $form_state->set('default_options', $this->options);

  }
}
