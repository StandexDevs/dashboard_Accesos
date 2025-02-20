

<?php
	require_once('VcardController.php');

	function OutputvCard(vCard $vCard)
	{

		if ($vCard -> URL)
		{
			foreach ($vCard -> URL as $URL)
			{
				if (is_scalar($URL))
				{
					return $URL.'<br />';
				}
				else
				{
					return $URL['Value'].'<br />';
				}
			}
		}

	}
    $RawvCardText = 
    "BEGIN:VCARD
    VERSION:3.0
    FN;CHARSET=UTF-8:Juan Nadie
    N;CHARSET=UTF-8:Nadie;Juan;;;
    TEL;TYPE=HOME,VOICE:555-555-5555
    TEL;TYPE=WORK,VOICE:666-666-6666
    EMAIL:usuario@dominio.com
    ORG;CHARSET=UTF-8:TEC-IT
    URL:222
    END:VCARD";
	
	/*$vCard = new vCard(
		'Example.vcf', // Path to vCard file
		false, // Raw vCard text, can be used instead of a file
		array( // Option array
			// This lets you get single values for elements that could contain multiple values but have only one value.
			//	This defaults to false so every value that could have multiple values is returned as array.
			'Collapse' => false
		)
	);*/

	$vCard = new vCard(
		false, // Path to vCard file
		$RawvCardText // Raw vCard text, can be used instead of a file
	);
    echo $vCard;
	if (count($vCard) == 0)
	{
		throw new Exception('vCard test: empty vCard!');
	}
	// if the file contains a single vCard, it is accessible directly.
	elseif (count($vCard) == 1)
	{
		echo OutputvCard($vCard);
	}
	// if the file contains multiple vCards, they are accessible as elements of an array
	else
	{
		foreach ($vCard as $Index => $vCardPart)
		{
			echo OutputvCard($vCardPart);

		}
	}
?>
</body>
</html>