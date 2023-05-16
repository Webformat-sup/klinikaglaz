<?php
function stringMicromarkingJson($url, $desc, $name = '', $numberTelephon = 2){

	if(empty($name)) $name = 'Клиника Глаз';
	$arrayNumberTelephon = [
		1 => '+7(343)270-00-30', 
		2 => '+73432700030, +7(343)328-88-45'
	];

	$mictoFormatJson = '{
		"@context": "http://www.schema.org",
		"@type": "MedicalClinic",
		"name": "'.$name.'",
		"url": "https://' . $url . '",
		"logo": "https://klinikaglaz.ru/logo.svg",
		"description": "' . $desc . '",
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "Николая Никонова,18",
			"addressLocality": "г.Екатеринбург",
			"postalCode": "620027",
			"addressCountry": "Россия"
		},
		"openingHours": "Mo, Tu, We, Th, Fr, Sa, Su 08:00-20:00",
		"contactPoint": {
			"@type": "ContactPoint",
			"telephone": "'.$arrayNumberTelephon[$numberTelephon].'"
		}
	}';

  return $mictoFormatJson;
}

function stringMicromarkingJsonProjects($detailPathElement, $nameElement, $descElement, $imgPathElement){
		$mictoFormatJson = '{
			"@context": "http://www.schema.org",
			"@type": "Article",
			"mainEntityOfPage": {
				"@type": "WebPage",
				"@id": "https://' . $detailPathElement . '"
			},
			"headline": "' . $nameElement . '",
			"description": "' . $descElement . '",
			"image": "' . $imgPathElement . '",
			"author": {
				"@type": "Organization",
				"name": "Клиника микрохирургии Глаз",
				"url": "https://klinikaglaz.ru/"
			},
			"publisher": {
				"@type": "Organization",
				"name": "Клиника микрохирургии Глаз",
				"logo": {
					"@type": "ImageObject",
					"url": "https://klinikaglaz.ru/logo.svg"
				}
			},
			"datePublished": ""
		}';

		return $mictoFormatJson;
}
?>