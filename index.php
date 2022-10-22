


<?php
/* connect to server */

/* try to connect */
$inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'osamahaleem96@gmail.com', 'viqlegxdmkkthwdi') or die('Cannot connect to Gmail: ' . imap_last_error());
        
//echo $inbox;
/* grab emails */
$emails = imap_search($inbox, 'SUBJECT "COMMENT "');


/* if emails are returned, cycle through each... */
if($emails) {

  /* begin output var */
  $output = '';

  /* put the newest emails on top */
  rsort($emails);

  /* for every email... */
  foreach($emails as $email_number) {
    //$email_number=$emails[0];
//print_r($emails);
    /* get information specific to this email */
    $overview = imap_fetch_overview($inbox,$email_number,0);
    $message = imap_fetchbody($inbox,$email_number,2);

    /* output the email header information */
    $output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
    $output.= '<div class="from">'.$overview[0]->from.'</div>';
    $output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
    $output.= '<span class="date">on '.$overview[0]->date.'</span>';
    $output.= '</div>';

    /* output the email body */
    // $output.= '<div class="body">'.imap_qprint($message).'</div>';

   
  }

  echo $output;
}

/* close the connection */
imap_close($inbox);
?>

