namespace Drupal\flatback_mod\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'flatback_mod' block.
 */
@Block(
   id = "flatback_mod_block",
   admin_label = @Translation("flatback_mod Block"),

 )

class Flatback_mod extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
  // do something
    return array(
      '#title' => 'Flatback turtle layers',
      '#description' => 'Flatback turtle layers description'
    );
  }
}