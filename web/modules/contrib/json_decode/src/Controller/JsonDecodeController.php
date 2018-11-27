<?php
use Drupal\Component\Serialization\Json;
namespace Drupal\Json_decode\Controller;

class JsonDecodeController {
	public function biology(string $search) {

			
		$ser = array('biology','movements','threats','flagship','genetics','education','monitoring');
			

		if(in_array($search,$ser)) 
		{ 
		$search1 = "flatbacks_" . $search;
		$uri = "https://sdis.dpaw.wa.gov.au/api/projects/?search=" . $search1;

		try {
		$response = \Drupal::httpClient()->get($uri,array('headers' => array('Accept' => 'application/json')));
		$data = (string) $response->getBody();
			if(empty($data)) {
				return FALSE;
			}else {

//			$html_code = process_code($data);	
				$decoded = json_decode($data);
				$count=0;
				foreach($decoded as $key => $value) {
//					if($count <= 10){
						if($value->image == '') {$value->image = 'https://flatbacks.dbca.wa.gov.au/sites/default/files/2018-10/flatback-default-800x600.jpg';

						$html_code .= "<div class='row'><div class='col-sm-3'><img class='img-responsive' src='" .  $value->image ."'/></div> ";
						}
						else
						$html_code .= "<div class='row'><div class='col-sm-3'><img class='img-responsive' src='https://sdis.dpaw.wa.gov.au/media/" .  $value->image ."'/></div> ";
		
				
						if($value->tagline_plain == '')
							$html_code .= "<div class='col-sm-9'><h4> ". $value->title_plain . "</h4>"  ;
						else
							$html_code .="<div class='col-sm-9'><h4>" . $value->tagline_plain . "</h4>" ;


if($value->start_date != '')     { $html_code .= "<small class='field field--name-field-article-date field--type-datetime'><strong>Project lifecycle</strong><time class='datetime'>  Start: " . $value->start_date . "</time></small>" ; }

						if($value->end_date != '')	{ $html_code .= " <small class='field field--name-field-article-date field--type-datetime'><time class='datetime'>  End:  " .$value->end_date . "</time></small> ";}

						$aims  = explode('</p>',$value->comments);
						$aims[0] = str_replace('<p>','',$aims[0]);
						$aims[1] = str_replace('<p>','',$aims[1]);
						$aims[2] = str_replace('<p>','',$aims[2]);
						$aims[3] = str_replace('<p>','',$aims[3]);
						$aims[4] = str_replace('<p>','',$aims[4]);
						str_replace('Aims',"Description of the project: ",$aims[1]);
						$html_code .=  "<br />". $aims[0] . "</p>" ;
			$html_code .= "<a class='btn btn-sm'><div class='togglecontent'>Read more...</div></a><p class='morecontent'><span>". $aims[1] .  "<br />". $aims[2] . "<br />" . $aims[3] . "<br />". $aims[4]  . "</span></p></div></div>";
						$count++;
//					}
//				else
//					break;

				}
 
			}
			$title = "Flatback  " . $search;
				return array (
					'#title' => $title,
					'#markup' => $html_code 
	 			);
			

		}
		catch (RequestedException $e) {
			return FALSE;
		}
		}
		else
			return array (
					'#title' => $title,
					'#markup' => "No project found with keyword in search. Please contact flatbacks@dbca.wa.gov.au " 
	 			);

	}
}
