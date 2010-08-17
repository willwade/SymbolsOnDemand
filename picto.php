<?
error_reporting(E_ALL);

$outtype = isset($_REQUEST['output']) ? clean($_REQUEST['output']) : 'jscript';
$search = isset($_REQUEST['search']) ? clean($_REQUEST['search']) : 'monkey';
$search = trim($search,"./@#$,");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://sclera.be/index.php?taal=ENG");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');

$output = curl_exec($ch);
$info = curl_getinfo($ch);

// next page
curl_setopt($ch, CURLOPT_URL, "http://sclera.be/index.php?page=search");
curl_setopt($ch, CURLOPT_POSTFIELDS,"woord=".$search);
$output = curl_exec($ch);
//
//
curl_close($ch);
preg_match_all("/[0-9a-z ]+.png/x",$output,$pngs);

//print_r($pngs);

if($outtype=='jscript')
{
   echo 'var js_array = new Array("'. implode('","',$pngs[0]).'");';
} elseif($outtype=='json') {
   echo json_encode(array('symbol'=>'picto','file_locn'=>'http://sclera.be/pics/pictos/', 'images'=>$pngs[0]));
} else{
   echo '"'.implode('","',$pngs[0]).'"';
}

function clean($string) {
	$string = trim($string);
    $ret = str_replace('=','&#61;',$string);
    $ret = htmlentities($ret,ENT_QUOTES);
    return $ret;
    }
?>
