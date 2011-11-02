<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
chmod("../inc/", 0755);
$script = 'KaiBB';
$version = '2.0.1';
$sitetemplate = 'proBlue';
?>
<html>
    <head><title><?php echo $script; ?> <?php echo $version ?> Installer</title>
        <style>
            body {background-color: #6E7B8B;margin: 0px;}
            #holder {padding: 8px;text-align: center;}
            #bodyline {background-color: #FFFFFF;padding: 4px;width: 700px;

            }
            .navfont { font-family:Tahoma,Helvetica,sans-serif; font-size: 11px; color:#FFF; text-decoration:none;}
            .normfont { font-family:Tahoma,Helvetica,sans-serif; font-size: 10px; color:#000; text-decoration:none;}
            .userfont { font-size:10px; font-family: sans-serif; color:#5B5B5B; text-decoration:none; font-weight:bold;}
            .modfont { font-size:10px; font-family: sans-serif; color:#607B8B; text-decoration:none; font-weight:bold;}
            .adminfont { font-size:10px; font-family: sans-serif; color:#EE6A50; text-decoration:none; font-weight:bold; }
            a:link.normfont { color: #002633; }a:visited.normfont { color: 	#002633; }a:hover.normfont { color: #5E8BB8; }
            a:link.navfont { color: #FFF; }a:visited.navfont { color: #FFF; }a:hover.navfont { color: #FFF; }
            .boxone {background-color: #729dbf;padding: 4px;margin: 2px 2px 0px 2px;border: 0px solid #FFFFFF;text-align:left;}
            .boxtwo {background-color: #B0C4DE;padding: 4px;border: 0px solid #FFFFFF;text-align:left;margin: 0px 2px 0px 2px;}
            .boxthree {padding: 4px;text-align:left;background-color: #f0f0f0;margin: 0px 2px 0px 2px;}
            .row1 {background-color: #ffffff; margin: 0px 2px 0px 2px; padding: 4px;}
            tr.row1:hover {background-color: #FFCC99; padding: 4px;}
            div.row1:hover { background-color: #FFCC99; }
            .row0 {background-color: #f0f0f0; margin: 0px 2px 0px 2px;padding: 4px;}
            tr.row0:hover { background-color: #FFCC99;}
            div.row0:hover { background-color: #FFCC99;}
            .quote {background-color: #ffffff;margin: 4px;padding: 4px;border: thin dotted #999999;}
            .formcss {font-family: sans-serif;font-size: 10px;color: #333;background-color: #FFF;padding: 6px;border: 1px solid #ACACAC;}
            .formcss:focus { border: 1px solid #B0C4DE; }
        </style></head>
    <body>
        <div id="holder"><div align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" id="bodyline"><tr><td width="100%">

<?php
if (isset($_POST['submit'])) {
    // Create Database
    $db_creation = mysql_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_password']);
    if ( ! $db_creation )
    {
        ?>
                            
                             <font class="normfont">
    <div class="boxone"><font class="navfont"> Error</font></div>
    <div class="boxtwo"></div>
    <div class="boxthree">
Could not connect to the database server.</div></font>


        <?php
    }
    mysql_query("DROP DATABASE ".$_POST['dbmast_name'], $db_creation);
    mysql_query("CREATE DATABASE ".$_POST['dbmast_name'], $db_creation);
    $m = mysql_select_db($_POST['dbmast_name']);
    if ($m) {



        $config_file = "../inc/config.php";
        $fh = fopen($config_file, 'w');

        if (!$fh) {
            ?>
                            
                             <font class="normfont">
    <div class="boxone"><font class="navfont"> Error</font></div>
    <div class="boxtwo"></div>
    <div class="boxthree">
KaiBB does not have access to the config.php file. Please check that the permission for this file and the ./inc/ directory is set to read and write (chmod 0755).</div></font>



        <?php
            die();
        }else {

            $stringData = "<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
" . '$dbhost' . " = '$_POST[db_host]'; // Your host may supply an url for this field
" . '$dbuser' . " = '$_POST[db_user]'; // Database Username
" . '$dbpassword ' . " = '$_POST[db_password]';  // Database Password
" . '$dbmaster = ' . " '$_POST[dbmast_name]';  // Database Name
" . '$prefix = ' . " '$_POST[db_prefix]';  // Table Prefix only change if you are using more than one installation
?>
";
            fwrite($fh, $stringData);
            fclose($fh);
        }
        mysql_close($db_creation);
    } else {
        ?>
                            
                             <font class="normfont">
    <div class="boxone"><font class="navfont"> Error</font></div>
    <div class="boxtwo"></div>
    <div class="boxthree">
The database could not be created, this is most likely due to incorrect details.</div></font>


        <?php
        mysql_close($db_creation);
    }


    
    $prefix = $_POST['db_prefix'];

    if (isset($_POST['name'])) {
        $sitename = $_POST['name'];
    } else {
        $sitename = '';
    }


    if (isset($_POST['url'])) {
        $siteurl = $_POST['url'];
    } else {
        $siteurl = '';
    }


    if (isset($_POST['path'])) {
        $sitepath = $_POST['path'];
    } else {
        $sitepath = '';
    }


    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $username = '';
    }


    if (isset($_POST['password'])) {
        $password = md5($_POST['password']);
    } else {
        $password = '';
    }


    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $email = '';
    }






  

// Connect To Database
$db = mysql_connect("$_POST[db_host]", "$_POST[db_user]", "$_POST[db_password]");
$database = mysql_select_db("$_POST[dbmast_name]",$db);
        
      
        
        
        
        
         mysql_query("CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL DEFAULT '0',
  `joined` varchar(100) NOT NULL,
  `lpip` int(255) NOT NULL,
  `frozen` varchar(1) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `tpl` text NOT NULL,
  `rank` int(10) NOT NULL DEFAULT '0',
  `lastlogin` varchar(100) NOT NULL,
  `signature` text NOT NULL,
  `gender` int(10) NOT NULL,
  `location` varchar(100) NOT NULL,
  `timezone` varchar(100) NOT NULL DEFAULT '0',
  `warning` int(10) NOT NULL DEFAULT '0',
  `postcount` int(100) NOT NULL DEFAULT '0',
  `bantime` int(100) NOT NULL DEFAULT '0',
  `reputation` int(100) NOT NULL DEFAULT '0',
  `emailme` int(100) NOT NULL DEFAULT '1',
  `lastpost` varchar(100) NOT NULL,
  `activated` int(100) NOT NULL DEFAULT '0',
  `activation_code` varchar(100) NOT NULL,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
        
         
         
         
         
                  mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_attachments` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `account_id` int(100) NOT NULL,
  `file` varchar(250) NOT NULL,
  `date` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
        
        
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_banlist` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  `type` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_categories` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sort` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_categories_permission` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `category_id` int(100) NOT NULL,
  `group_id` int(100) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_confdata` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_extensions` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_forums` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `info` text NOT NULL,
  `cat_id` int(100) NOT NULL,
  `parent_id` int(100) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_forums_permission` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `forum_id` int(100) NOT NULL,
  `group_id` int(100) NOT NULL,
  `view` int(100) NOT NULL DEFAULT '0',
  `post` int(100) NOT NULL DEFAULT '0',
  `reply` int(100) NOT NULL DEFAULT '0',
  `upload` int(100) NOT NULL DEFAULT '0',
  `moderator` int(100) NOT NULL DEFAULT '0',
  `poll` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_forums_read` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `account_id` int(100) NOT NULL,
  `topic_id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
                
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_groups` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `colour` varchar(100) NOT NULL,
  `info` text NOT NULL,
  `rc` int(10) NOT NULL DEFAULT '0',
  `acp` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_groups_members` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `account_id` int(100) NOT NULL,
  `group_id` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_mail` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `from_id` int(100) NOT NULL,
  `to_id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `marked` int(100) NOT NULL,
  `text` text NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_polls` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `topic_id` int(100) NOT NULL,
  `question` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_polls_option` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `poll_id` int(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `total` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_polls_vote` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `poll_id` int(100) NOT NULL,
  `account_id` int(100) NOT NULL,
  `option_id` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
                    mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_posts` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `author_id` int(100) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `topic_id` int(100) NOT NULL,
  `attachment` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_reputation` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `post_id` int(100) NOT NULL,
  `account_id` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_topics` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `author_id` int(100) NOT NULL,
  `forum_id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `sticky` int(10) NOT NULL,
  `locked` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_watching` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(100) NOT NULL,
  `topic_id` int(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             mysql_query("CREATE TABLE IF NOT EXISTS `online` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `time` int(200) NOT NULL,
  `account_id` int(250) NOT NULL,
  `session` varchar(100) NOT NULL,
  `site` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             mysql_query("CREATE TABLE IF NOT EXISTS `ranks` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `special` varchar(100) NOT NULL,
  `count` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
         
           
             
             mysql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_reports` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `post_id` int(100) NOT NULL,
  `account_id` int(100) NOT NULL,
  `reporter_id` int(100) NOT NULL,
  `date` varchar(200) NOT NULL,
  `reason` text NOT NULL,
  `resolved` int(10) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `outcome` text NOT NULL,
  `actioned` int(10) NOT NULL DEFAULT '0',
  `action_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0") or die(mysql_error());
             
             
             
             
            mysql_query("INSERT INTO accounts (`id`, `name` , `email`, `joined`, `lastlogin`,`postcount`,`activated`) VALUES
(1, 'System','none@none.com',UNIX_TIMESTAMP(),UNIX_TIMESTAMP(),'0','1')")or die(mysql_error());
            mysql_query("INSERT INTO accounts ( `name`, `email`, `password` , `rank`, `joined`, `lastlogin`, `postcount`,activated) VALUES
('$username', '$email', '$password' , 3,UNIX_TIMESTAMP(),UNIX_TIMESTAMP(),'1','1')")or die(mysql_error());
                $site = ''.$siteurl.'';
                $tos = 'By accessing '.$site.'\, you agree to the following terms\, If you do not agree with these terms then please do not access '.$site.'. These terms can be modified\, added to or removed at any time, it is your responsibility to regularly check these terms and familiarise yourself with them as your continued access of '.$site.' will be bound by these terms as they are updated.

This bulletin board is powered by KaiBB and is freely given under the \"General Public Licence\" and can be downloaded from http://www.kaibb.co.uk or through the link in the footer. KaiBB or any affiliated party is not responsible for content or conduct at '.$site.'. For more information visit http://www.kaibb.co.uk.

You agree and understand that a \"User Account\" is not property of the individual but of '.$site.'\, this includes the right for management to modify, suspend, hinder or terminate user accounts as deemed appropriate.
You agree to follow any displayed Terms and conditions / Rules displayed within this site at all times as bound under this agreement.

You agree for all data submitted to '.$site.' to be retained securely within the forum database and used for the site to function as intended, the management agrees to treat all data confidentially under the Data Protection act. KaiBB.co.uk and / or affiliated parties shall not be held responsible or liable for any breach of security resulting in data being lost or compromised.';
                $admkey = rand(2344523485234, 999999999999999999);
                $ases = rand(100, 9999);
                $confdata = mysql_query("INSERT INTO ".$prefix."_confdata (`name`, `value`) VALUES
('userreg', '1'),
('siteclosed', '0'),
('version', '".$version."'),
('meta_info', 'Forum powered by KaiBB'),
('meta_keywords', 'KaiBB Mi-Dia'),
('usertemplate', '1'),
('admkey', '" . $admkey. "'),
('session', 'kaibb".$ases."'),
('adminemail', '".$email."'),
('iplock', '0'),
('activation', '1'),
('avatar', '1'),
('sitename', '".$sitename."'),
('url', '".$siteurl."'),
('template', '".$sitetemplate."'),
('path', '".$sitepath."'),
('postlimit', '10'),
('topiclimit', '15'),
('staffnotice', ''),
('hottopic','25'),
('tos','$tos'),
('avatar_filesize','25600'),
('avatar_width', '100'),
('avatar_height', '100'),
('attach', '1'),
('attach_filesize','128000'),
('anti_flood','12'),
('language','english'),
('facebook_like','1'),
('rss','1'),
                        ('activation','1')
")or die(mysql_error());
                
                // Create Ranks
                $defaultranks = mysql_query("INSERT INTO ranks (`id`, `name`,`special`,`count`) VALUES
(1, 'Newbie','0','0'),
(2, 'Moderator','1','0'),
(3, 'Administrator','1','0'),
(4, 'Member','0','20')")or die(mysql_error());
                
                // Create Default Groups
                mysql_query("INSERT INTO `".$prefix."_groups` (`id`, `title`, `colour`, `info`, `rc` ,`acp`) VALUES
(1, 'Guest', '', 'Limited Access', 0,0),
(2, 'User', '#1A1A1A', 'General User Access', 0,0),
(3, 'Moderator', '#DC143C', 'Enhanced User Access', 1,0),
(4, 'Admin', '#FF7F00', 'High Level Access', 1,1)")or die(mysql_error());
               
                // Insert First Group Members
                 mysql_query("INSERT INTO `".$prefix."_groups_members` (`id`, `account_id`, `group_id`) VALUES
(1, -1, 1),
(2, 2, 4)")or die(mysql_error());
                 
                 // Insert Forum Permissions             
                mysql_query("INSERT INTO `".$prefix."_forums_permission` (`forum_id`, `group_id`, `view`, `post`, `reply`, `upload`, `moderator`, `poll`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0),
(1, 2, 1, 1, 0, 0, 0, 1),
(1, 3, 1, 1, 1, 1, 0, 1),
(1, 4, 1, 1, 1, 1, 1, 1)")or die(mysql_error());
                
                
                
                
                mysql_query("INSERT INTO ".$prefix."_extensions (`value`) VALUES ('jpg')")or die(mysql_error());
                mysql_query("INSERT INTO ".$prefix."_extensions (`value`) VALUES ('jpeg')")or die(mysql_error());
                mysql_query("INSERT INTO ".$prefix."_extensions (`value`) VALUES ('png')")or die(mysql_error());
                mysql_query("INSERT INTO ".$prefix."_extensions (`value`) VALUES ('gif')")or die(mysql_error());
                mysql_query("INSERT INTO ".$prefix."_categories (`id`, `name`, `sort`) VALUES (1, 'General', 1)")or die(mysql_error());
                mysql_query("INSERT INTO ".$prefix."_forums (`id`, `name`, `info`, `cat_id`, `parent_id`, `sort`) VALUES
(1, 'Welcome', 'Your First Forum', 1, 0, 1)")or die(mysql_error());
                mysql_query("INSERT INTO ".$prefix."_posts (`id`, `author_id`, `text`, `date`, `topic_id`) VALUES (1, 2, 'Welcome to your KaiBB installation, viewing this topic is confirmation that the forum has installed itself and is ready for your needs.\r\n\r\nWe hope you enjoy using this script, and would like to invite you to participate in our community at [url=http://www.kaibb.co.uk]KaiBB Community Forum\'s[/url] where you can meet other KaiBB user\'s and gain any support you may require.', '1280079959', 1)")or die(mysql_error());
                mysql_query("INSERT INTO ".$prefix."_topics (`id`, `title`, `author_id`, `forum_id`, `date`, `sticky`, `locked`) VALUES (1, 'Welcome to your forum', 2, 1, '1280079959', 1, 0)")or die(mysql_error());
                mysql_query("INSERT INTO ".$prefix."_categories_permission (`category_id`, `group_id`, `view`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1)")or die(mysql_error());
  
        
        
        
        
        ?>
                            
                             <font class="normfont">
    <div class="boxone"><font class="navfont"> Install</font></div>
    <div class="boxtwo"></div>
    <div class="boxthree">
KaiBB has now been installed, please delete this installer.</div></font>


        <?php
    
        
        


     
} else {
    ?>

    <font class="normfont">
    <div class="boxone"><font class="navfont"> Install</font></div>
    <div class="boxtwo"></div>
    <div class="boxthree">
        <table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
            <form method="post" action=""><tr>
                    <td width="100%" colspan="3"><font  class="normfont"><b>Database Config</b>
                        <br>This installer will generate the config.php file and install the script when given the correct details.
                        <br />If this installer is unable to create the config.php or sucessfully install KaiBB, then please use the alternate installer <a href="./install2.php" class="normfont">here</a>.</font></td>
                </tr>
                <tr>
                    <td width="20%"><font  class="normfont">Database Host:</font></td>
                    <td width="14%"><font  class="normfont">
                        <input type="text" name="db_host" size="20"class="formcss"></font></td>
                    <td width="76%"><i><font  class="normfont">Your database host</font></i></td>
                </tr>
                <tr>
                    <td width="20%"><font  class="normfont">Database User</font></td>
                    <td width="14%"><font  class="normfont">
                        <input type="text" name="db_user" size="20"class="formcss"></font></td>
                    <td width="76%"><i><font  class="normfont">Your database user</font></i></td>
                </tr>
                <tr>
                    <td width="20%"><font  class="normfont">Database Password</font></td>
                    <td width="14%"><font class="normfont">
                        <input type="text" name="db_password" size="20"class="formcss"></font></td>
                    <td width="76%"><i><font  class="normfont">Your database password</font></i></td>
                </tr>
                <tr>
                    <td width="20%"><font  class="normfont">Master Database</font></td>
                    <td width="14%"><font class="normfont">
                        <input type="text" name="dbmast_name" size="20"class="formcss"></font></td>
                    <td width="76%"><i><font  class="normfont">Choose the name for the Master Database</font></i></td>
                </tr>

                <tr>
                    <td width="20%"><font  class="normfont">Database Prefix</font></td>
                    <td width="14%"><font class="normfont">
                        <input type="text" name="db_prefix" size="20"class="formcss" value="kaibb" ></font></td>
                    <td width="76%"><i><font  class="normfont">Select a prefix (if any) for your database. Default is "kaibb_"</font></i></td>
                </tr>
                <tr>
                    <td width="100%" colspan="3"><font  class="normfont"><b>Config</b><br>This section is regarding site configuration.</font></td>
                </tr>
                <tr>
                    <td width="10%"><font  class="normfont">Site Name:</font></td>
                    <td width="14%"><font  class="normfont">
                        <input type="text" name="name" size="20"class="formcss"></font></td>
                    <td width="76%"><i><font  class="normfont">The name of your site</font></i></td>
                </tr>
                <tr>
                    <td width="10%"><font  class="normfont">Domain:</font></td>
                    <td width="14%"><font  class="normfont">
                        <input type="text" name="url" size="20"class="formcss" value="http://<?php echo $_SERVER['SERVER_NAME']; ?>"></font></td>
                    <td width="76%"><i><font  class="normfont">The domain of your website</font></i></td>
                </tr>
                <tr>
                    <td width="10%"><font  class="normfont">Path:</font></td>
                    <td width="14%"><font class="normfont">
                        <input type="text" name="path" size="20"class="formcss"value="<?php
    $str = $_SERVER["REQUEST_URI"];
    $str = str_replace('//', '', $str);
    $str = str_replace('/install/', '', $str);
    $str = str_replace('/', '', $str);
    echo $str;
    ?>"></font></td>
                    <td width="76%"><i><font  class="normfont">If not installed on your 
                            domain directory, set path.</font></i></td>
                </tr>
                <tr>
                    <td width="100%" colspan="3"><font  class="normfont"><b>Admin 
                            Account</b><br>
                        This section is regarding the details for the Admin account</font></td>
                </tr>
                <tr>
                    <td width="10%"><font class="normfont">Username:</font></td>
                    <td width="14%"><font class="normfont">
                        <input type="text" name="username" size="20"class="formcss"></font></td>
                    <td width="76%"><i><font  class="normfont">The username of the Admin 
                            Account</font></i></td>
                </tr>
                <tr>
                    <td width="10%"><font  class="normfont">Email:</font></td>
                    <td width="14%"><font  class="normfont">
                        <input type="text" name="email" size="20"class="formcss"></font></td>
                    <td width="76%"><i><font  class="normfont">The full email address, 
                            email is used for logging in.</font></i></td>
                </tr>
                <tr>
                    <td width="10%"><font  class="normfont">Password:</font></td>
                    <td width="14%"><font  class="normfont">
                        <input type="text" name="password" size="20"class="formcss"></font></td>
                    <td width="76%"><i><font  class="normfont">The password for the account</font></i></td>
                </tr>
                <tr>
                    <td width="100%" colspan="3">
                        <p align="center"><input type="submit" name="submit" value="submit" class="formcss"></td>
                </tr></form>
        </table></div>


    <?php
}
?></font></td></tr></table></div></div></body></html>