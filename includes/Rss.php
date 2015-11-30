<?php
/*
*Nombre de la clase: Rss
*Objetivo: Operaciones sobre los feed del Modulo SIGOES 
*Dirección física: /SIGOES-Comunicado/includes/Rss.php
*/

class Rss
{
	public function __Construct()   
    {
    	set_time_limit(20);
    }

	public function verificarPlugin($url)
	{
		/*Inicio Validar si las entradas del feed son validas*/
		libxml_use_internal_errors(true);
			try{
				$rss = new DOMDocument();
				$rss->load($url);
				libxml_clear_errors();

				if (!$rss) {
    				$errors = libxml_get_errors();

    				foreach ($errors as $error) {
        					echo display_xml_error($error, $xml);
    						}

    					libxml_clear_errors();
					}

			}
			catch(Exception $e)
			{
				return false;
			}
				
				//echo $e->getMessage(), "\n";
		if (strpos($http_response_header[0], '404')) {
    		die('file not found. exiting.');
			}
		/*Fin Validar si las entradas del feed son validas*/
		$feed = array();
		foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			'category' => $node->getElementsByTagName('category')->item(0)->nodeValue,
			'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue
			);
			array_push($feed, $item);
			}
		$limit=count($feed);
		$instalado=0;
		for($x=0;$x<$limit;$x++) 
		{
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$category = $feed[$x]['category'];
		$date = date('l F d, Y', strtotime($feed[$x]['date']));
		if($title == 'plugin-sigoes')
			{
				$instalado=1;
			}

		}
		if($instalado==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

/*Inicio de Funcion para Verificar que Url este activa*/
/*para que funcione debe de ser instalada la libreria curl de php
sudo apt-get install php5-curl*/
	function chequearUrl($url)
	{
    	if($url == NULL) 
    	{
		return false; 
    	}
    	try{
    	set_time_limit(20);
    	$ch = curl_init($url);  
    	curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
    	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);  
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    	$data = curl_exec($ch);  
    	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
    	curl_close($ch);  
    	}
    	catch (Exception $e)
    	{
    		return false;
    	}
    	if($httpcode>=200 && $httpcode<304){  
        	return true; 
    	} else {  
        	return false;   
    	}
    	//echo $httpcode;
	}
/*Fin de Funcion para Verificar que Url este activa*/

}
?>