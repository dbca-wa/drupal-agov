<?php  
/**  
 * @file  
 * Contains Drupal\json_decode\Form\MessagesForm.  
 */  
namespace Drupal\json_decode\Form;
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  

class MessagesForm extends ConfigFormBase {  

 protected function getEditableConfigNames() {  
    return [  
      'json_decode.adminsettings',  
    ];  
  }  

  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'json_decode_form';  
  }  

/**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  
    $config = $this->config('json_decode.adminsettings');  

    $form['json_decode_message'] = [  
      '#type' => 'textarea',  
      '#title' => $this->t('Json Decode message'),  
      '#description' => $this->t('Welcome Json Decode display to users when they login'),  
      '#default_value' => $config->get('json_decode_message'),  
    ];  
  $form['json_decode_url'] = [  
      '#type' => 'url',  
      '#title' => $this->t('Json Decode URL including the keyword'),  
      '#description' => $this->t('Json Decode display to users when they login'),  
      '#default_value' => $config->get('json_decode_url'),  
    ]; 
    return parent::buildForm($form, $form_state);  
  }  
/**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  

    $this->config('json_decode.adminsettings')  
      ->set('json_decode_message', $form_state->getValue('json_decode_message'))  
      ->set('json_decode_url', $form_state->getValue('json_decode_url'))
      ->save();  
  }


}  
