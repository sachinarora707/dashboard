<?php 
//require('libraries/simple_html_dom.php');

$page = file_get_html('https://www.alexa.com/siteinfo/techpiration.com');
$data = $page->find('#traffic-rank-content',0);
//echo $data;

$rank = $data->find('strong.metrics-data',0);
$rank = $rank->plaintext;

$graph = $data->find('img',0);
$graph = $graph->src;

$country = $data->find('.metrics-title',1);
$country = $country->find('a',0)->title;

$countryFlag = $country.' Flag';
$countryFlag = $data->find("img[title=$countryFlag]",0);
$countryFlag = $countryFlag->src;

$countryRank = $data->find('strong.metrics-data',1);
$countryRank = $countryRank->plaintext;

$increase='';
$is_improved='';
foreach ($data->find('span') as $elm) {
	$elmtitle = $elm->title;
	if(strpos($elmtitle,'rank')){
		$increase = $elm->plaintext;
		$is_improved = strpos($elmtitle,'improved'); //check if 'rank is improved' is present in the title.
		break;
	}
}
?>

<div id="alexaContainer2">
	<p class="alexaSite"><b>Techpiration</b></p>
	
	<div style="text-align: center; margin: 0 auto">
		<img src=<?php echo $graph ?> style="width: 62%;">
	</div>
	
	<div style="width: 48%;text-align: center; display: inline-block;">
		<p style="font-family: sans-serif;">Global Rank</p>
		<img src="https://www.alexa.com/images/icons/globe-sm.jpg" style="vertical-align: top;">
		<p style="display: inline;font-weight: bold; font-family:Helvetica;"><?php echo $rank; ?><span class="increaseRank"><?php echo $increase; ?></span></p>
	</div>

	<div style="width: 48%;text-align: center; display: inline-block;">
		<p style="font-family: sans-serif;">Rank in <b><?php echo $country; ?></b></p>
		<img src=<?php echo "https://www.alexa.com".$countryFlag; ?>><p style="display: inline;font-family: Helvetica;"><?php echo $countryRank; ?></p>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		if(<?php if($is_improved){echo '0';} else{echo '1';} ?>){
			$("#alexaContainer2 span.increaseRank").css("backgroundColor","red");
		}
	});
</script>