<html>
<head>
    <meta charset="UTF-8">
    <title>Character Identification</title>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
<?php
// Request Pilot's name from user - Import from "index.php"
$characterName = $_POST['username'];

//Reformat Pilot's name to a usable string
$newName = preg_replace("/[\s_]/", "%20", $characterName);

$url2 = 'https://api.eveonline.com/eve/CharacterID.xml.aspx?names=' . $newName;
$sxml = simplexml_load_file($url2);

foreach ($sxml->result->rowset->row as $character) {
    $characterID = (string)$character->attributes()->characterID;

    echo "<img src=https://image.eveonline.com/Character/" . $characterID . "_200.jpg class=img-thumbnail alt=Thumbnail Image><br>";
    echo "Pilot Name: {$characterName}<br>" . "Character Id: {$characterID}<br>";
}

?>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Corporation</th>
                <th>Employed on</th>
            </tr>
            </thead>
            <?php
            $url = 'https://api.eveonline.com/eve/CharacterInfo.xml.aspx?characterID=' . $characterID;
            $result = simplexml_load_file($url);

            foreach ($result->result->rowset->row as $employment) {
                $name = (string)$employment->attributes()->corporationName;
                $start = (string)$employment->attributes()->startDate;

                //echo "Company: {$name}<br> Started on - {$start}<br>";
                echo '
		<tr>
			<td>' . $name . '</td>
			<td>' . $start . '</td>
		</tr>';
            }

            ?>
</body>
</html>