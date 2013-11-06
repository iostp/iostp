<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<div id='left-nav'>";
include("left-nav.php");

echo "
</div>
<div id='main'>
<center>
<img src='/img/internet-of-things-vs-industrial-internet.png'></img>
</center>
<p>
The Distance project is an Internet of Things cluster where ecosystem concepts and solutions can be developed and demonstrated. Distance makes a material amount of data from ‘things’ discoverable and accessible while taking account of issues such as ownership, security and privacy. Participants in Distance have live ‘information hubs’ where this data can be aggregated and made accessible at scale for application and service prototyping. The goal of Distance is to help drive interoperability with a consensus on data formats, open interfaces and service enablers with buy-in across multiple sectors and application areas and to become a platform for the involvement of problem owners, application and service developers and technology providers to collaborate and to allow innovative companies, particularly SMEs, to test their ideas.
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
