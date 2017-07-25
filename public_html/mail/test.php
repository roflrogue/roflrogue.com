<html>
    <head>
        <title>Test Email</title>
    </head>
<?php
$path = '{imap.gmail.com:993/imap/ssl}';
$user = 'aaron.hairston.ah@gmail.com';
$pw = 'BUDlings01991';
/*

$imap = imap_open($path,$user,$pw);

$folders = imap_list($imap, '{imap.gmail.com:993/imap/ssl}', '*');

$numMsgs = imap_num_msg($imap);
for($i = $numMsgs; $i > ($numMsgs - 25); $i--){
    
    $header = imap_header($imap, $i);
    $bodyStr = imap_fetchbody($imap, $i,1);
    $sub = $header -> subject;
    $fromAdr = $header -> from[0] -> mailbox . "@" . $header -> from[0] -> host;
    $from = $header -> from[0]->personal;
    $replyTo = $header->reply_toaddress;
    $udate = $header->udate;
    $date = date('D j M Y', $udate);

    echo "<p><strong>From: </strong>" . $from . "</p>";
    echo "<p><strong>Subject: </strong>" . $sub . "</p>";
    echo "<p><strong>Sent: </strong>" . $date . "</p>";

    echo $bodyStr."<br/>";

    $structure = imap_fetchstructure($imap,$i);
    echo "Type: ".$structure->type . "<br  />";
    echo "Encoding: " . $structure->encoding . "<br />";
    echo "ifsubtype: " . $structure->ifsubtype . "<br />";
    echo "subtype: " . $structure->subtype . "<br />";
    echo "ifdescription: " . $structure->ifdescription . "<br />";
    echo "description: " . $structure->description . "<br />";
    echo "ifid: " . $structure->ifid . "<br />";
    echo "id: " . $structure->id . "<br />";
    echo "lines: " . $structure->lines . "<br />";
    echo "bytes: " . $structure->bytes . "<br />";
    echo "ifdisposition: " . $structure->ifdisposition . "<br />";
    echo "disposition: " . $structure->disposition . "<br />";
    echo "ifdparameters: " . $structure->ifdparameters . "<br />";
    echo "dparameters: " . $structure->dparameters . "<br />";
    echo "ifparameters: " . $structure->ifparameters . "<br />";
    echo "parameters: " . $structure->parameters . "<br />";
    echo "parts: " . $structure->parts . "<br />";
    echo "<hr  />";

}
imap_close($imap);
*/
?>
<?php echo 'test';?>
</html>
    