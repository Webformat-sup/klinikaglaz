<?php
function stringMicromarkingJson($url, $desc){
	$mictoFormatJson = '{
		"@context": "http://www.schema.org",
		"@type": "MedicalClinic",
		"name": "Клиника Глаз",
		"url": "https://' . $url . '",
		"logo": "https://klinikaglaz.ru/logo.svg",
		"description": "' . $desc . '",
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "Николая Никонова,18",
			"addressLocality": "620027, г.Екатеринбург",
			"addressCountry": "Russia"
		},
		"openingHours": "Mo, Tu, We, Th, Fr, Sa, Su 08:00-20:00",
		"contactPoint": {
			"@type": "ContactPoint",
			"telephone": "+73432700030, +7(343)328-88-45"
		}
	}';

  return $mictoFormatJson;
}
?>