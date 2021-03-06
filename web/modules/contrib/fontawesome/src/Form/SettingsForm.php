<?php

namespace Drupal\fontawesome\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Asset\LibraryDiscovery;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Defines a form that configures fontawesome settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * Drupal LibraryDiscovery service container.
   *
   * @var Drupal\Core\Asset\LibraryDiscovery
   */
  protected $libraryDiscovery;

  /**
   * {@inheritdoc}
   */
  public function __construct(LibraryDiscovery $library_discovery) {
    $this->libraryDiscovery = $library_discovery;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('library.discovery')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'fontawesome_admin_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'fontawesome.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get current settings.
    $fontawesome_config = $this->config('fontawesome.settings');

    // Load the fontawesome libraries so we can use its definitions here.
    $fontawesome_library = $this->libraryDiscovery->getLibraryByName('fontawesome', 'fontawesome.svg');

    $form['tag'] = [
      '#type' => 'select',
      '#title' => $this->t('Font Awesome Tag'),
      '#options' => [
        'i' => $this->t('&lt;i&gt;'),
        'span' => $this->t('&lt;span&gt;'),
      ],
      '#default_value' => empty($fontawesome_config->get('tag')) ? 'i' : $fontawesome_config->get('tag'),
      '#description' => $this->t('Font Awesome works with any consistent HTML element. By default, Font Awesome uses the &lt;i&gt; tag for its icons. However, in some cases you may want to use a different tag for your Font Awesome icons, such as a &lt;span&gt; tag. Changing the value here will change the way the tags are inserted into your site. Manually created Font Awesome tags can use any HTML element you like. Note that changing this setting will require clearing the site cache.'),
    ];

    $form['method'] = [
      '#type' => 'select',
      '#title' => $this->t('Font Awesome Method'),
      '#options' => [
        'svg' => $this->t('SVG with JS'),
        'webfonts' => $this->t('Web Fonts with CSS'),
      ],
      '#default_value' => $fontawesome_config->get('method'),
      '#description' => $this->t('This setting controls the way Font Awesome works. SVG with JS is the modern, easy, and powerful version with the most backwards compatibility. Web Fonts with CSS is the classic Font Awesome icon method that you have seen in earlier versions of Font Awesome. We recommend SVG with JS. Please note that the Webfonts with CSS version does not allow backwards compatibility with Font Awesome 4. That means you will need to check your code base to be certain that the icons are all updated to work with version 5. See @gettingStartedLink for more information.', [
        '@gettingStartedLink' => Link::fromTextAndUrl($this->t('the Font Awesome guide'), Url::fromUri('https://fontawesome.com/get-started'))->toString(),
      ]),
    ];

    $form['allow_pseudo_elements'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow CSS pseudo-elements?'),
      '#description' => $this->t('If you do not want to add icons directly in code, you can add them through CSS pseudo-elements. Font Awesome has leveraged the ::before pseudo-element to add icons to a page since the very beginning. For more information on how to use pseudo-elements, see the @pseudoElementsLink. Note that this feature is always available with the Webfonts version of Font Awesome. If you turn this feature on for SVG with JS, it will slow your site down noticeably.', [
        '@pseudoElementsLink' => Link::fromTextAndUrl($this->t('Font Awesome guide to pseudo-elements'), Url::fromUri('https://fontawesome.com/how-to-use/web-fonts-with-css#pseudo-elements'))->toString(),
      ]),
      '#default_value' => $fontawesome_config->get('allow_pseudo_elements'),
    ];

    $form['external'] = [
      '#type' => 'details',
      '#open' => TRUE,
      '#title' => $this->t('External file configuration'),
      '#description' => $this->t('These settings control the method by which the Font Awesome library is loaded. You can choose to use an external (full URL) or local (relative path) library by selecting a URL / path below, or you can use a local version of the file by leaving the box unchecked and downloading the library <a href=":remoteurl">:remoteurl</a> and installing locally at %installpath. See the README for more information.', [
        ':remoteurl' => $fontawesome_library['remote'],
        '%installpath' => '/libraries',
      ]),
      'use_cdn' => [
        '#type' => 'checkbox',
        '#title' => $this->t('Use external file (CDN) / local file?'),
        '#description' => $this->t('Checking this box will cause the Font Awesome library to be loaded from the given source rather than from the local library file.'),
        '#default_value' => $fontawesome_config->get('use_cdn'),
      ],
      'external_svg_location' => [
        '#type' => 'textfield',
        '#title' => $this->t('External File Location'),
        '#default_value' => $fontawesome_config->get('external_svg_location'),
        '#size' => 80,
        '#description' => $this->t('Enter a source URL for the external Font Awesome library file you wish to use. Note that this is designed for use with the <strong>SVG with JS</strong> method. Use for the Webfonts method at your own risk. This URL should point to the Font Awesome JS svg file when using <strong>SVG with JS</strong> or it should point to the Font Awesome CSS file when using <strong>Web Fonts with CSS</strong>. Leave blank to use the default Font Awesome CDN.'),
        '#states' => [
          'disabled' => [
            ':input[name="use_cdn"]' => ['checked' => FALSE],
          ],
          'visible' => [
            ':input[name="use_cdn"]' => ['checked' => TRUE],
          ],
        ],
      ],
    ];

    $form['shim'] = [
      '#type' => 'details',
      '#open' => TRUE,
      '#title' => $this->t('Version 4 Backwards Compatibility'),
      '#description' => $this->t('Version 5 of Font Awesome has some changes which require modifications to the way you declare many of your icons. The settings below are designed to ease that transition. See @upgradingLink for more information.', [
        '@upgradingLink' => Link::fromTextAndUrl($this->t('the Font Awesome guide to upgrading version 4 to version 5'), Url::fromUri('https://fontawesome.com/how-to-use/upgrading-from-4'))->toString(),
      ]),
      'use_shim' => [
        '#type' => 'checkbox',
        '#title' => $this->t('Use version 4 shim file?'),
        '#description' => $this->t('Rather than editing all of your Font Awesome declarations to use the new Font Awesome syntax, you can choose to include a shim file above. This file will allow you to use Font Awesome version 5 with Font Awesome version 4 syntax. This prevents you from needing to modify your existing code and syntax.'),
        '#default_value' => $fontawesome_config->get('use_shim'),
      ],
      'external_shim_location' => [
        '#type' => 'textfield',
        '#title' => $this->t('External / local Library Location'),
        '#default_value' => $fontawesome_config->get('external_shim_location'),
        '#size' => 80,
        '#description' => $this->t('Enter a source URL for the external / local (relative path) Font Awesome v4 shim file you wish to use. This URL should point to the Font Awesome JS shim file. Leave blank to use the default Font Awesome CDN.'),
        '#states' => [
          'disabled' => [
            ':input[name="use_cdn"]' => ['checked' => FALSE],
            ':input[name="use_shim"]' => ['checked' => FALSE],
          ],
          'visible' => [
            ':input[name="use_cdn"]' => ['checked' => TRUE],
            ':input[name="use_shim"]' => ['checked' => TRUE],
          ],
        ],
      ],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    // Validate URL.
    if (!empty($values['fontawesome_external_location']) && !UrlHelper::isValid($values['fontawesome_external_location'])) {
      $form_state->setErrorByName('fontawesome_external_location', $this->t('Invalid external library location.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    // Clear the library cache so we use the updated information.
    $this->libraryDiscovery->clearCachedDefinitions();

    // Set external file defaults.
    $default_location = 'https://use.fontawesome.com/releases/v5.3.0/';
    $default_svg_location = $default_location . 'js/all.js';
    $default_webfonts_location = $default_location . 'css/all.css';
    $default_svg_shimfile_location = $default_location . 'js/v4-shims.js';
    $default_webfonts_shimfile_location = $default_location . 'css/v4-shims.css';

    // Use default values if CDN is checked and the locations are blank.
    if ($values['use_cdn']) {
      if (empty($values['external_svg_location']) || $values['external_svg_location'] == $default_webfonts_location || $values['external_svg_location'] == $default_svg_location) {
        // Choose the default depending on method.
        $values['external_svg_location'] = ($values['method'] == 'webfonts') ? $default_webfonts_location : $default_svg_location;
      }
      if ($values['use_shim'] && (empty($values['external_shim_location']) || $values['external_shim_location'] == $default_webfonts_shimfile_location || $values['external_shim_location'] == $default_svg_shimfile_location)) {
        // Choose the default depending on method.
        $values['external_shim_location'] = ($values['method'] == 'webfonts') ? $default_webfonts_shimfile_location : $default_svg_shimfile_location;
      }
    }

    // Save the updated settings.
    $this->config('fontawesome.settings')
      ->set('tag', $values['tag'])
      ->set('method', $values['method'])
      ->set('use_cdn', $values['use_cdn'])
      ->set('external_svg_location', (string) $values['external_svg_location'])
      ->set('use_shim', $values['use_shim'])
      ->set('external_shim_location', (string) $values['external_shim_location'])
      ->set('allow_pseudo_elements', $values['allow_pseudo_elements'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
