
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php foreach($NameFile['css'] as $File){echo "<link rel='stylesheet' href='".$css.$File."'>"; } ?>
    <title><?php echo $title?></title>
</head>
<body>