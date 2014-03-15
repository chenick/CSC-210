<?php //global variable section
if(file_exists($_REQUEST["film"]) || file_exists($_REQUEST["search"])){
	$title = $_REQUEST["film"];
}else{ //if the webpage dosent exist, go here:
	header("Location: error.html");
}	
?>
      

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

        <head>
                <title>
			<?php changetitle($title); ?>
		</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
                <link href="movie.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
		
            <div id = "Banner">
                <img src="banner.png" alt="Rancid Tomatoes" />
            </div>
		
            <h1>
		<?php h1writer($title); ?>
	    </h1>

            <div id="Relative">

                <div id="MainBox">
                    <div id="Overview">
                   	 <img src="<?php echo $title; ?>/overview.png" alt="general overview"/>

                        <div id="MovieInfo">    
                  		<?php overviewwriter($title); ?>
                        </div>
                    </div>

                    <div id="BehindBanner">
                        <?php bannerwriter($title);?> 

			<form action="movie.php"> 
				<fieldset>
					<input id = "field" name="film" value="Search Movies"/>
					<input id ="button" type="submit" value="Search"/>
				</fieldset>
			</form>
		
                    </div>

                    <div id="Reviews">
        
                        <?php reviewwriter($title);?>    
                            
                    </div>
			</div>
                    <div id="Page"/>
                        <p>(1-10) of 88</p>
                    </div>
                </div>

                <div id="W3CValidation">
			<p>
				<a href = "http://validator.w3.org/check?uri=referer">	
					<img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88"/>
				</a>
			</p>	
						 
			<p>
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
    					<img style="border:0;width:88px;height:31px"  src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!"/>
				</a>
			</p>
        
		
            </div>   
        </body>
</html>

<?php     //function declaration section

function changetitle($t){

        switch ($t) { //changes title depending on request
	        case "princessbride":
        	        print "The Princess Bride - Rancid Tomatoes";
                	break;
      		case "tmnt":
               		print "TMNT - Rancid Tomatoes";
               		break;
       		case "tmnt2":
               		print "Teenage Mutant Ninja Turtles II - Rancid Tomatoes";
              		break;
     		 case "mortalkombat":
              		print "Mortal Kombat - Rancid Tomatoes";

	}
}
	

function h1writer($t){ //changes h1 depending on request

	$lines = file("$t/info.txt");
	echo $lines[0] , " (" , trim($lines[1]) , ")";

}


function bannerwriter($t){ //modifies banner depending on request
        
	$lines = file("$t/info.txt");
	printf("<img id=\"RottenBig\" src=\"%s.png\" alt=\"Fresh\" /> <span id=\"Rating\">%s%%",(( $lines[2] >= 60)? "freshbig" : "rottenbig"), trim($lines[2]));
        echo  "<span id=\"NumReviews\"> (", trim($lines[3]), " reviews total)</span></span>";

}


function overviewwriter($t){ //reads overview.txt and writes overview section
	

	$file = "$t/overview.txt"; 
 	$handle = fopen($file, 'r');
 	echo "<dl>";
 	while (!feof($handle)){ 
		$data = fgets($handle); 
 
 		$explode = explode(":", $data, 2);
 
 		echo "<dt>", $explode[0], "</dt>";
 		echo "<dd>", $explode[1],  "</dd>";
 	}
 
 	echo "</dl>";
}

function reviewwriter($t) { //writes the review section depending on how many reviews are in the database
	
	$review_array = glob("$t/review*.txt"); 

	$column1number = (int) (count($review_array)/2 +count($review_array)%2);
 	$column2number = (int) ( count($review_array)/2); //calculates the number of reviews in each column

	foreach($review_array as $file_number => $file){ 

		if($file_number == 0 || $file_number == $column1number ) echo "<div class = \"Column\">"; //prints 2 column divs
	
	
		$review = file("$file"); 
		
		if (strcmp(trim($review[1]), "FRESH")){$fresh_or_rotten = "rotten";}else{$fresh_or_rotten = "fresh";} //stores fresh or rotten 


      		echo "<p class= \"Quotation\">";
              	echo "<img class=\"Tomato\" src=\"",$fresh_or_rotten, ".gif\" alt=\"", $fresh_or_rotten, "\"/>";
               	echo "<q>",trim($review[0]), "</q>";
               	echo "</p>";

               	echo "<p class = \"ReviewInfo\">";
               	echo "<img class=\"Profile\" src=\"critic.gif\" alt=\"Critic\"/>";
               	echo $review[2];
               	echo "<br/> <span class=\"Publication\">", $review[3], "</span></p>";
      
              
		if(($file_number ==( $column1number - 1 )) || ($file_number == ( $column1number + $column2number ))) echo "</div>"; //prints 2 column divs

	}
   
}

?>
