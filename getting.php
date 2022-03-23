<?php
if (!isset($_GET['host'])) {
    header("location: index.html");
}

$host = $_GET['host'];

$ip = gethostbyname($host);
$records = dns_get_record($host);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>IP Address: <?php echo $ip ?></h1>
    <table>
        <tr>
            <th>Type</th>
            <th>Host</th>
            <th>TTL</th>
            <th>Class</th>
            <th>IP</th>
            <th>TXT</th>
        </tr>
        <?php foreach ($records as $record) : ?>
            <?php $recordData = json_decode(json_encode($record)); ?>
            <tr>
                <td><?php echo $recordData->type; ?></td>
                <td><?php echo $recordData->host; ?></td>
                <td><?php echo $recordData->ttl; ?></td>
                <td><?php echo $recordData->class; ?></td>
                <td>
                    <?php
                    if (isset($recordData->ip)) {
                        echo $recordData->ip;
                    } else {
                        echo "N/A";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (isset($recordData->txt)) {
                        echo $recordData->txt;
                    } else {
                        echo "N/A";
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

</body>

</html>