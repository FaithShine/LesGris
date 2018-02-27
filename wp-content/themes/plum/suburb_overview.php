<?php /* Template Name: Suburb Overview */ 
// PHP Custom Page Created by Muhit Anik @ msani1@student.monash.edu
// This is a part of LesGris project created by Monash 4 Bits
// All codes are property of the owner and Monash University

get_header() ?>

<div>


<!-- BEGINNING OF STYLESHEET -->

<style>
        html{
            margin-top: 0px !important;
            height: auto;
            overflow-x: hidden;
        }
        #masthead.single{
            min-height: 120px;
        }


        #masthead.single {
            min-height: 120px
             -webkit-animation-name: slide-up; /* Safari 4.0 - 8.0 */
             -webkit-animation-duration: 4s; /* Safari 4.0 - 8.0 */
            animation-name: slide-up;
            animation-duration: 4s;
            overflow-y: hidden;
        }

        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes slide-up {
            from {min-height: 400px;}
            to {min-height: 120px;}
        }

        /* Standard syntax */
        @keyframes slide-up {
            from {min-height: 400px;}
            to {min-height: 120px;}
        }

        #regions_div{
            overflow-y: hidden;
        }
		
		#top_text{
			font-size: 16px;
		}
		
		.myBtn{
			background-color: #008CBA !important;  /* Blue */
			border: none !important;
			color: white !important;
			padding: 13px 26px !important;
			text-align: center !important;
			text-decoration: none !important;
			display: inline-block !important;
			font-size: 16px !important; 
			box-shadow: none !important;
		}
		
		.myBtn:hover{
			box-shadow: 10px 10px 5px #00546f !important;
		}

</style>


<!-- END OF STYLESHEET -->


<?php 
// Parse the json file.
$str = file_get_contents('/var/www/html/wordpress/wp-content/themes/plum/census_data.json');
$json = json_decode($str, true);

$str_house = file_get_contents('/var/www/html/wordpress/wp-content/themes/plum/house_price.json');
$json_house = json_decode($str_house, true);


$str_location = file_get_contents('/var/www/html/wordpress/wp-content/themes/plum/location.json');
$json_location = json_decode($str_location, true);


?>



<datalist id="suburbname">
<?php for ($i=0; $i<count($json); $i++){
            $community_name = $json[$i]['Community'];
            echo "<option>";
            echo $community_name;
            echo "</option>";
            } ?> 


</datalist>



<!-- Google Maps Polygon -->
<div class="ui-widget">
<form action="." method="GET" id="submit_suburb" autocomplete="off">
    <span>Want to know about a Suburb in Victoria? Type the suburb name.</span><br/>
    <div class="input-group">
    <span class="input-group-addon" id="basic-addon1">e.g. Dandenong</span>
    <input type="text" class="form-control" placeholder="Suburb Name" name="suburb_name" id="suburb_name" aria-describedby="basic-addon1" list="suburbname" minchars=4 /> 

    </div><br/><br>
    <input type="submit" class="myBtn"  value="Search" id="form_submit" />
</form>

</div>







<div id="error"></div>
<?php 
    $inp_comm = "Melbourne";
    if(isset($_GET)){
        $get_name = $_GET['suburb_name'];
        $inp_comm = ucwords($get_name);
    }
    

    // Load house_price.json

    $median_price = 0;

    

    for ($i=0; $i<count($json_house); $i++){
        if ($json_house[$i]['Locality'] == strtoupper($inp_comm)){
            $median_price = $json_house[$i]['Prelim 2016'];
        }
    }

    $public_hospitals = 0;
    $private_hospitals = 0;
    $health_centres = 0;
    $total_hospitals = 0;
    $age_care_high = 0;
    $age_care_low = 0;
    $age_care_serious = 0;
    $age_care_total = 0;
    $child_care = 0;
    
    for ($i=0; $i<count($json); $i++){
            $community_name = $json[$i]['Community'];

            if ($community_name == ucwords($inp_comm)){
                $top_country_by_birth = $json[$i]['Top country of birth'];
                $sec_top_country = $json[$i]['2nd top country of birth'];
                $third_top_country = $json[$i]['3rd top country of birth'];
                $top_lang = $json[$i]['Top language spoken'];
                $sec_top_lang = $json[$i]['2nd top language spoken'];
                $third_top_lang = $json[$i]['3rd top language spoken'];
                $age_65_69 = $json[$i]['2012 ERP age 65-69, %'];
                $age_69_74 = $json[$i]['2012 ERP age 70-74, %'];
                $age_65_74 = (float) $age_65_69 + (float) $age_69_74;
                $total_population = $json[$i]['2012 ERP, total'];

                $public_hospitals = $json[$i]['Public Hospitals'];
                $private_hospitals = $json[$i]['Private Hospitals'];
                $health_centres = $json[$i]['Community Health Centres'];
                $total_hospitals = $json[$i]['Hospital in total'];
                $age_care_low = $json[$i]['Aged Care (High Care)'];
                $age_care_high = $json[$i]['Aged Care (Low Care)'];
                $age_care_serious = $json[$i]['Aged Care (SRS)'];
                $age_care_total = $json[$i]['Aged care in total'];
                $child_care = $json[$i]['Kinder and/or Childcare'];

                $distance = "";
                $postcode = "";
                for ($x=0; $x<count($json_location); $x++){
                    

                    if ($json_location[$x]['Community'] == $inp_comm){
                        $distance = $json_location[$x]['Location'];
                        $postcode = $json_location[$x]['Postcode'];
                    }
                }

                echo "<br/>";
                echo "<h3>" . $inp_comm . "</h3>";
                echo "<span id='top_text'>";
                echo "Do you know? - ";
                echo $community_name . " is <b>" . $distance . "</b> with Postcode <b>" .$postcode. "</b>. Property median price in this suburb is around <b>" . number_format($median_price) . "</b>. The amount of population <b>" . number_format($total_population) . "</b> of which <b>" . $age_65_74  . "%</b> are people aged between 65 and 74. The top 3 countries of birth are from <em>" . $top_country_by_birth . "</em>, <em>" . $sec_top_country . "</em>, and <em>" . $third_top_country . "</em>." . "The top 3 languages spoken in this suburb are <em>" . $top_lang . "</em>, <em>" . $sec_top_lang . "</em>, and <em>" . $third_top_lang . "</em>." ;
                
                echo "</span>";
                break;
            }

        }

    if(isset($_GET)){
        if ($inp_comm == "X"){
        echo ":( Sorry! We couldn't find the community you are looking for. Did you check your spelling? We are constantly trying to add more communities. Check back soon. :)";
        }
    }

?>

<br/>
<!-- <h4>Check how the property prices around Melbourne look like</h4>
<div id="google_fusion">
    <iframe id="gfusion" width="1250" height="500" scrolling="yes" frameborder="yes" src="https://fusiontables.google.com/embedviz?q=select+col9%3E%3E0+from+10C-3SdzHGRTP2kTcoQp0BOcFFCmNRt9fJSAoH1OV&amp;viz=MAP&amp;h=false&amp;lat=-37.813628&amp;lng=144.963058&amp;t=1&amp;z=9&amp;l=col9%3E%3E0&amp;y=2&amp;tmplt=2&amp;hml=KML"></iframe>
</div> -->
<!-- Another section<br/> -->
</div>
<br/>


<br/>

<?php 
$age_array = [];

    for ($i=0; $i<count($json); $i++){
        if(isset($_POST)){
            if ($json[$i]['Community'] == $inp_comm){
                array_push($age_array, $json[$i]['2012 ERP age 65-69, %']);
                array_push($age_array, $json[$i]['2012 ERP age 70-74, %']);
                array_push($age_array, $json[$i]['2012 ERP age 75-79, %']);
                array_push($age_array, $json[$i]['2012 ERP age 80-84, %']);
                array_push($age_array, $json[$i]['2012 ERP age 85+, %']);
            }
        }
                        
    }

$label_array = array('65-69', '70-74', '75-79', '80-84', '85+');

if (!empty($age_array)){
    echo "<div class='container'><div class='row'><div class='col-md-6'><h4>" . "Elederly Population of " . $inp_comm . "</h4>";
    echo "<canvas id='chart1' width='250' height='100'></canvas></div>";
    echo "<div class='col-md-6'><h4>Median House Prices in " . $inp_comm . " </h4>"; 
    echo "<canvas id='chart2' width='250' height='100'></canvas></div></div></div>";
}


?>


<script>
var ctx = document.getElementById("chart1");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($label_array); ?>,
        datasets: [{
            label: 'Elderly Population Percentage',
            data: <?php echo json_encode($age_array); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(145, 35, 255, 0.5)',
                'rgba(54, 50, 255, 0.2)',
                'rgba(240, 102, 255, 0.5)',
                'rgba(110, 150, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(145, 35, 255, 1)',
                'rgba(54, 50, 255, 1)',
                'rgba(240, 102, 255, 1)',
                'rgba(110, 150, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
    }
});
</script>
<hr>

<!-- House Prices -->
<?php 
$p2005 = 0;
$p2006 = 0;
$p2007 = 0;
$p2008 = 0;
$p2009 = 0;
$p2010 = 0;
$p2011 = 0;
$p2012 = 0;
$p2013 = 0;
$p2014 = 0;
$p2015 = 0;
$p2016 = 0;



for ($i=0; $i<count($json_house); $i++){
        if ($json_house[$i]['Locality'] == strtoupper($inp_comm)){
            $p2005 = $json_house[$i]['2005'];
            $p2006 = $json_house[$i]['2006'];
            $p2007 = $json_house[$i]['2007'];
            $p2008 = $json_house[$i]['2008'];
            $p2009 = $json_house[$i]['2009'];
            $p2010 = $json_house[$i]['2010'];
            $p2011 = $json_house[$i]['2011'];
            $p2012 = $json_house[$i]['2012'];
            $p2013 = $json_house[$i]['2013'];
            $p2014 = $json_house[$i]['2014'];
            $p2015 = $json_house[$i]['2015'];
            $p2016 = $json_house[$i]['Prelim 2016'];
            break;
            
        }
    }

$house_array = array($p2005, $p2006, $p2007, $p2008, $p2009, $p2010, $p2011, $p2012, $p2013, $p2014, $p2015, $p2016);
$house_label = array('2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016');


?>

<script>
var ctx = document.getElementById("chart2");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($house_label); ?>,
        datasets: [{
            label: 'Median House Prices',
            data: <?php echo json_encode($house_array); ?>,
            fill: false,
            backgroundColor: 'rgba(110, 150, 255, 1)',
            borderJoinStyle: 'miter',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
    }
});
</script>





<!-- End of House prices -->






<!-- MAPBOX -->


<?php 
//Google GeoCoding 

$inp_sp = str_replace(" ", "%20", $inp_comm);

$url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . ucfirst($inp_sp) . ",Victoria,AU.";
$geo_data = file_get_contents($url);
echo "<br/>";
$json_geo = json_decode($geo_data, true);
$lng =  $json_geo['results'][0]['geometry']['location']['lng'];
$lat =  $json_geo['results'][0]['geometry']['location']['lat'];


    
    if (!empty($age_array)){
        echo "<div class='container'><div class='row'>";
        
        echo '<div class="col-md-6">';
        echo "<h4>Health & Care in " . $inp_comm . "</h4>";

        echo '<table class="table table-striped">';
		echo '<tr>';
        echo '<th>Public Hospitals</th>';
		echo '<td>' . $public_hospitals . '</td></tr>';
        
		echo '<tr>';
        echo '<th>Private Hospitals</th>';
		echo '<td>' . $private_hospitals . '</td></tr>';
		echo '<tr>';
        echo '<th>Health Centres</th>';
		echo '<td>' . $health_centres . '</td></tr>';
		echo '<tr>';
        echo '<th>Total No. of Hospitals</th>';
		echo '<td>' . $total_hospitals . '</td></tr>';
		echo '<tr>';
        echo '<th>Aged Care (High)</th>';
		echo '<td>' . $age_care_high . '</td></tr>';
		echo '<tr>';
        echo '<th>Aged Care (Low)</th>';
		echo '<td>' . $age_care_low . '</td></tr>';
		echo '<tr>';
        echo '<th>Aged Care (SRS)</th>';
		echo '<td>' . $age_care_serious . '</td></tr>';
		echo '<tr>';
        echo '<th>Total No. of Aged Care</th>';
		echo '<td>' . $age_care_total . '</td></tr>';
		echo '<tr>';
        echo '<th>Total No. of Child Care</th>';
		echo '<td>' . $child_care . '</td></tr>';
		
		
		
		
		
		// echo '<th>Private Hospitals </th>';
        // echo '<th>Health Centres </th>';
        // echo '<th>Total No. of Hospitals </th>';
        // echo '<th>Aged Care (High)</th>';
        // echo '<th>Aged Care (Low)</th>';
        // echo '<th>Aged Care (SRS) </th>';
        // echo '<th>Total No. of Aged Care </th>';
        // echo '<th>Total No. of Child Care</th>';

        // echo '<tr><td>';
        // echo $public_hospitals . "</td><td>";
        // echo $private_hospitals . "</td><td>";
        // echo $health_centres . "</td><td>";
        // echo $total_hospitals . "</td><td>";
        // echo $age_care_high . "</td><td>";
        // echo $age_care_low . "</td><td>";
        // echo $age_care_serious . "</td><td>";
        // echo $age_care_total . "</td><td>";
        // echo $child_care;
        // echo '</td></tr>';


        echo '</table>';

        echo '</div>';

        echo "<div class='col-md-6'>";
        echo "<h4>" . "<span id='location_span'>What's around " . $inp_comm . "</span>" . "</h4>";
        echo "<div id='map' style='width: 500px; height: 350px; overflow-y: scroll;'></div>></div>";
        echo "</div></div>";
    }
    
    

?>




<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v3.1.1/mapbox-gl-directions.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v3.1.1/mapbox-gl-directions.css' type='text/css' />








<!-- END OF MAPBOX -->



<script>



mapboxgl.accessToken = 'pk.eyJ1IjoibXVoaXQwNCIsImEiOiJjajI0b3ExbmgwMDRqMnJxZjZ3bXZ3enJkIn0.M3cHMFe6qZeyEfngi29-vA';
var map = new mapboxgl.Map({
    container: 'map', // container id
    style: 'mapbox://styles/mapbox/streets-v9', //stylesheet location
    center: [<?php echo $lng; ?>, <?php echo $lat; ?>], // starting position
    zoom: 13// starting zoom
});

map.addControl(new mapboxgl.NavigationControl());

// map.addControl(new MapboxDirections({
    // accessToken: mapboxgl.accessToken
// }), 'top-left');

</script>




<!-- Crime Data -->
<?php 

$str_crime = file_get_contents('/var/www/html/wordpress/wp-content/themes/plum/offence.json');
$json_crime = json_decode($str_crime, true);


$change = 0;

$c_2012 = 0;
$c_2013 = 0;
$c_2014 = 0;
$c_2015 = 0;
$c_2016 = 0;

if ($postcode != ""){
    for ($i=0; $i<count($json_crime); $i++){
        if ($postcode == $json_crime[$i]['Postcode'])
        {
            $c_2012 = str_replace(',', '', $json_crime[$i]['2012']);
            $c_2013 =  str_replace(',', '', $json_crime[$i]['2013']);
            $c_2014 =  str_replace(',', '', $json_crime[$i]['2014']);
            $c_2015 =  str_replace(',', '', $json_crime[$i]['2015']);
            $c_2016 = str_replace(',', '', $json_crime[$i]['2016']);


            $change = $json_crime[$i]['change'];

            echo "<h4> Total No. of offences in " . $inp_comm . "</h4>";
            echo "<span style='color:red;'>Change of " . $change . "</span><br/>"; 
            echo "<canvas id='chart3' width='250' height='60'></canvas>";
            break;
        }
    }
}

$crime_data = array($c_2012, $c_2013, $c_2014, $c_2015, $c_2016);
$crime_label = array('2012', '2013', '2014', '2015', '2016');

?>

<script>
var ctx = document.getElementById("chart3");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($crime_label); ?>,
        datasets: [{
            label: "Recorded Crime",
            data: <?php echo json_encode($crime_data); ?>,
            fill: false,
            backgroundColor: 'rgba(102, 0, 0, .60)',
            borderJoinStyle: 'miter',
            borderWidth: 1,
			borderColor: 'rgba(102, 0, 0, .60)'
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
    }
});
</script>

<!-- End of Crime Data -->

<hr>
<div id="social_media_plugin">
    

    <?php echo DISPLAY_ULTIMATE_PLUS(); ?>
</div>

<style>
    #social_media_plugin{
        float: left;
    }



</style>



<?php get_footer() ?>






