<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">

  <!-- Button to Open the Modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open modal -->
  </button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        helloo
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>

</body>
</html>


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
    $output.= '<a href="#" data-toggle="modal" data-target="#myModal"><span class="subject">'.$overview[0]->subject.'</span></a>';
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

