<?php
namespace elasticsearch;

class Taxonomy extends AbstractArchive{
	function facets($wp_query, $args){
		//Disable taxonomy as it breaks ordering on woocommerce product categories pages
		return;
		if(!is_tax()){
			return;
		}

		$taxonomies = Config::taxonomies();
		
		$taxType = null;
		$taxValue = null;

		foreach($taxonomies as $taxonomy){
			if(isset($wp_query->query_vars[$taxonomy])){
				$taxType = $taxonomy;
				$taxValue = $wp_query->query_vars[$taxonomy];
				break;
			}
		}
		
		if(!$taxType){
			return;
		}

		if(!isset($args[$taxType])){
			$args[$taxType]['and'][] = $taxValue;
		}

		return $args;
	}
}

new Taxonomy();
?>
