<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"><?php
	header('Content-type: text/xml');
        require("inc/config.php");
	require("inc/db.php");
	
        $db = new db();
$db->connect($dbhost, $dbuser, $dbpassword, $dbmaster);

        
require("inc/function.php");
        
$system = new system();
$secure = new secure();
        $sitename = $system->confdata('sitename');
$su = $system->confdata('url');
	$confpath = $system->confdata('path');
	
	if ( $confpath ){
		$siteurl = "$su/$confpath";
	} else{
		$siteurl = "$su";
	}
	?>

    
    <channel>
<atom:link href="" rel="self" type="application/rss+xml" />
<title><?php echo $sitename ?></title>
<description>
   RSS Feed for <?php echo $sitename ?> - <?php echo $siteurl ?> 
</description>
<link><?php echo $siteurl; ?></link>
<copyright>This content may be under copyright of <?php echo $siteurl ?></copyright>

<?php

if ( $system->confdata('rss') == '1')
{
    
    if ( isset($_GET['forum']))
    {
       $id = $secure->clean($_GET['forum']);
       $doGet = $db->query("SELECT * FROM " . $prefix . "_topics WHERE forum_id = '".$_GET['forum']."' ORDER BY id DESC LIMIT 15"); 
    } else {
$doGet = $db->query("SELECT * FROM " . $prefix . "_topics ORDER BY id DESC LIMIT 15");
    }

while($result = mysql_fetch_array($doGet)){
            
        ?>

<item>
<title><?php echo $system->present($result['title'])?></title>
<description>
    
    <?php
    
    $post = $db->fetch("SELECT * FROM " . $prefix . "_posts  WHERE topic_id = '".$result['id']."' ORDER BY id");
    echo $system->present($post['text']);
    ?>
    
    
</description>
<link><?php echo $siteurl; ?>?topic=<?php echo $result['id'];?></link>
<guid><?php echo $siteurl; ?>?topic=<?php echo $result['id'];?></guid>
<pubDate><?php echo $system->time($result['date']); ?></pubDate>
</item>  

<?php }

}
else
{
    
    
    
    
    
   


?>

<item>
<title>RSS Feed Offline</title>
<description>
    
   This feed has been disabled by an administrator of <?php echo $sitename; ?> - <?php echo $siteurl; ?>
    
    
</description>
<link><?php echo $siteurl; ?></link>
<guid><?php echo $siteurl; ?></guid>
<pubDate></pubDate>
</item> 







<?php } ?>
	


</channel>
</rss>