<?php

namespace Drupal\pdf_using_mpdf\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\pdf_using_mpdf\Conversion\ConvertToPdf;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GeneratePdf extends ControllerBase {

  /**
   * {@inheritdoc}
   */
	public static function create(ContainerInterface $container) {
		//		var_dump($container->get('pdf_using_mpdf.conversion'));
//	print_r("test1");
    return new static(
      $container->get('pdf_using_mpdf.conversion')
    );
  }

  /**
   * Inject ConvertToPdf service.
   */
  public function __construct(ConvertToPdf $convert) {
	  $this->convert = $convert;
//	$convert->convert("sdfdsfs"); 
//	print_r("test3");
 
  }

  /**
   * Generate a PDF file from an entity.
   */
  public function generate($node) {
    // TODO: remove anything dependent on node, everything must be
	  // specific to Entity level as a whole in general.	i
//	  $convert->convert("test");
    return [];
  }
}
