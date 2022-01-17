<?php
require('./vendor/autoload.php');
$curl = curl_init();

if (isset($_POST['btn'])) {
    $txt=$_POST['txtEs'];
    $txtg=$txt;
    $txt=str_replace(" ","%20",$txt);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://nlp-translation.p.rapidapi.com/v1/translate?text=$txt&to=en&from=es",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: nlp-translation.p.rapidapi.com",
            "x-rapidapi-key: 9b428ff218mshe09bfca980509c4p1f9a3ejsn0579268bfef0"
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TranslateApp</title>
    </head>
    <body>
        <h1>Aplicacion de Traduccion</h1>
        <form method="POST">
            <label for="texto">Texto a traducir:</label>
            <textarea name="txtEs"><?php if(isset($txtg)): ?><?php echo $txtg; ?><?php endif;?></textarea>
            <input type="submit" value="Traducir" name="btn">
            <textarea name="txtEn" readonly="readonly"><?php if(isset($response)):?><?php print_r(explode('"',$response)[19])?><?php endif;?></textarea>
        </form>
        <?php if(isset($err)):?>
            <p><?php echo $err;?></p>
        <?php endif;?>
    </body>
</html>