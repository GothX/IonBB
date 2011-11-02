<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */


// NAVIGATION
define('L_HOME','Home');
define('L_REGISTER','Register');
define('L_ACCOUNT','Account');
define('L_LOGOUT','Logout');
define('L_LOGIN','Login');
define('L_PROFILE','Profile');
define('L_MAIL','Mail');

define('L_TEMPORARY_BAN','Temporary Ban');
define('L_SETTINGS','Settings');
define('L_SIGNATURE','Signature');
define('L_AVATAR','Avatar');

define('L_PANEL_MAIL','You have [MAIL] unread messages.');
define('L_MODERATORS','Moderators');
define('L_MEMBERS','Members');


// Footer
define('L_RESOLUTION_CENTRE','Resolution Centre');
define('L_ADMIN_PANEL','Admin Panel');
define('L_TERMS_OF_SERVICE','Terms of service');
define('L_REPORT','Report');


// PAGINATE
define('L_FIRST','First');
define('L_LAST','Last');


// EMAIL
define('L_EMAIL_WRAP',"This is an automated email from [SITENAME].\n---------------------------------\n[CONTENT]\n---------------------------------\nThe Management\n[URL]");
define('L_REGISTER_SUBJECT','Your new account');
define('L_REGISTER_EMAIL','Hello [USER], 
Before you can use your account you will need to activate your account by visiting [URL].
Activation Code: [ACTIVATION_CODE]
If you did not register for this account, then someone has used your email to do so. 
If this is the case then just ignore this email.');
define('L_LOST_PASSWORD_SUBJECT','Your new password');
define('L_LOST_PASSWORD_EMAIL','Hello [NAME],\nA lost password request has been made on your account, your new password is [PASSWORD]');
// GENDER
define('L_GENDER','Gender');
define('L_MALE','Male');
define('L_FEMALE','Female');

// STATUS
define('L_ONLINE','Online');
define('L_OFFLINE','Offline');
define('L_HIDDEN','Hidden');

// PERMISSION
define('L_PERMISSION_ERROR_AREA','You do not have permission to access this area.');
define('L_PERMISSION_ERROR_ACTION','You do not have permission to perform this action.');


// KEYS
define('L_AUTHOR','Author');
define('L_GUEST','Guest');
define('L_POWERED_BY','Powered By KaiBB ');
define('L_KAIBB','KaiBB');
define('L_SUBMIT','Submit');
define('L_CONTINUE','Continue');
define('L_DELETE','Delete');
define('L_NAME','Name');
define('L_EMAIL','Email');
define('L_USERS','Users');
define('L_PASSWORD','Password');
define('L_TIMEZONE','Timezone');
define('L_LOCATION','Location');
define('L_UPDATED','Updated');
define('L_ENABLED','Enabled');
define('L_DISABLED','Disabled');
define('L_TEMPLATE','Template');
define('L_LANGUAGE','Language');
define('L_NOTIFY','Notification');
define('L_PREVIEW', 'Preview');
define('L_RANK','Rank');
define('L_JOINED','Joined');
define('L_LAST_LOGIN','Last Login');
define('L_DETAILS','Details');
define('L_USER','User');
define('L_GROUP','Group');
define('L_TIME','Time');
define('L_SUMMARY','Summary');
define('L_TITLE','Title');
define('L_NONE','None');
define('L_VIEWING','Currently viewing this page');
define('L_SEARCH','Search');
define('L_VIEW','View');
define('L_RESULTS','Results');
define('L_DATE','Date');
define('L_INFO','Info');
define('L_PARENT','Parent');
define('L_CATEGORY','Category');
define('L_ID_MISSING','No ID was given.');
define('L_GROUPS','Groups');
define('L_POST','Post');
define('L_UPLOAD','Upload');
define('L_MODERATOR','Moderator');
define('L_IP','IP');
define('L_NOTES','Notes');
define('L_EDIT_ACCOUNT','Edit Account');
define('L_ID','ID');
define('L_OPTIONS','Options');
define('L_STATUS','Status');
define('L_FORUM','Forum');
define('L_TOPICS','Topics');
define('L_YES','Yes');
define('L_NO','No');
define('L_RSS','RSS');
define('L_CONFIRM','Confirm');
define('L_CANCEL','Cancel');

define('L_USER_NOT_FOUND','The user could not be found');

define('L_POSTS','Posts');
define('L_EDIT','Edit');
define('L_SUBMITTED','Submitted');
define('L_DELETED','Deleted');
define('L_EMPTY','Empty');

define('L_REPLY','Reply');
define('L_TOPIC','Topic');
define('L_POLL','Poll');



define('L_ATTACHMENTS','Attachments');
define('L_FORUMS','Forums');

// BANNED
define('L_BANNED','Banned');
define('L_BANNED_IP','The ip address you are accessing from has been black listed on this site.');
define('L_TEMPORARY_BAN_MSG','Your account is currently banned untill [TIME].');

// LOST PASSWORD
define('L_LOST_PASSWORD','Lost Password');
define('L_LOST_PASSWORD_MESSAGE','Your new password has been sent to the email address registered with the account.');

// REGISTER ONLY
define('L_AGREEMENT','Agreement');
define('L_AGREEMENT_STATEMENT','By registering an account you confirm that you agree to the agreement shown above and understand that it can be changes at any time without notice.');
define('L_ACCOUNT_DETAILS','Account Details');
define('L_PROFILE_DETAILS','Profile Details');
define('L_REGISTERATION_CLOSED','This site is currently not accepting any new members.');

define('L_NAME_EXISTS','That name aready exists and can not be used.');
define('L_NAME_BANNED','That name is banned and can not be used.');

define('L_ACTIVATION_REQUIRED_MSG','To complete activation input the account email address and the activation code that has been sent to the email address.');
// USER CONTROL PANEL
define('L_USER_CONTROL_PANEL','User Control Panel');
define('L_NEW_PASSWORD','New Password');
define('L_NEW_PASSWORD_CONFIRM','Confirm Password');

define('L_PASSWORD_ERROR','The password you entered was incorrect.');
define('L_CONFIRM_PASSWORD_ERROR','The two new password\'s you entered did not match.');
define('L_ACCOUNT_UPDATED','Your account has been updated.');

define('L_ACCOUNT_SETTINGS_UPDATE','Your account has been updated.');
define('L_ACCOUNT_SETTINGS_ERROR','Your account could not be updated at this time.');

define('L_SIGNATURE_UPDATE','Your signature has been updated.');
define('L_SIGNATURE_ERROR','Your signature could not be updated at this time.');

define('L_AVATAR_DELETE','Your avatar has been deleted.');
define('L_AVATAR_UPDATE','Your avatar has been updated.');

define('L_AVATAR_UPLOAD_ERROR','The image could not be uploaded.');
define('L_AVATAR_UPLOAD_DIMENSION','The avatar can not be larger than [HEIGHT] pixels high and [WIDTH] pixels wide.');
define('L_AVATAR_UPLOAD_SIZE','The avatar can not be larger than [SIZE] kilobytes.');
define('L_AVATAR_UPLOAD_FORMAT','The avatar is the wrong format, only gif, jpg, jpeg and png are accepted.');

// MESSAGES
define('L_ERROR','Error');
define('L_PROFILE_ERROR','User could not be found');
define('L_LOGIN_ERROR','The username and / or password supplied were incorrect.');
define('L_LOGIN_MESSAGE','You are now logged into this forum.');
define('L_PASSWORD_LOST_LINK','Lost Your Password?');

define('L_REGISTER_ERROR_NAME','The name field can not be left blank.');
define('L_REGISTER_ERROR_EMAIL','The email field can not be left blank.');
define('L_REGISTER_ERROR_PASSWORD','The system could not generate a secure password.');
define('L_REGISTER_ERROR_NAME_EXISTS','The name you supplied is currently in use.');
define('L_REGISTER_ERROR_EMAIL_EXISTS','The email you supplied is currently in use.');
define('L_REGISTER_ERROR_EMAIL_FALSE','The email you supplied is incorrect.');
define('L_REGISTER_ERROR_EMAIL_BANNED','The email you supplied is banned.');

define('L_REGISTER_MESSAGE','Your account has been registered.');

define('L_ACTIVATION','Activation');
define('L_ACTIVATION_MESSAGE','Your account has now been activated.');
define('L_ACTIVATION_ERROR','The code did not match the account.');
define('L_ACTIVATED','Activated');

define('L_CAPTCHA','Captcha');
define('L_CAPTCHA_ERROR','The Captcha you entered was incorrect.');

define('L_CODE','Code');
define('L_CONFIRM_PASSWORD','Confirm Password');

// TIMEZONE
define('L_GMT_MINUS_1200','(GMT -12:00) Eniwetok, Kwajalein');
define('L_GMT_MINUS_1100','(GMT -11:00) Midway Island, Samoa');
define('L_GMT_MINUS_1000','(GMT -10:00) Hawaii');
define('L_GMT_MINUS_900','(GMT -9:00) Alaska');
define('L_GMT_MINUS_800','(GMT -8:00) Pacific Time');
define('L_GMT_MINUS_700','(GMT -7:00) Mountain Time');
define('L_GMT_MINUS_600','(GMT -6:00) Centeral Time');
define('L_GMT_MINUS_500','(GMT -5:00) Eastern Time');
define('L_GMT_MINUS_400','(GMT -4:00) Atlantic Time');
define('L_GMT_MINUS_330','(GMT -3:30) Newfoundland');
define('L_GMT_MINUS_300','(GMT -3:00) Brazil, Buenos Aires, Georgetown');
define('L_GMT_MINUS_200','(GMT -2:00) Mid-Atlantic');
define('L_GMT_MINUS_100','(GMT -1:00) Azores, Caple Verde Islands');
define('L_GMT_000','(GMT) Western Europe Time, London, Lisbon');
define('L_GMT_PLUS_100','(GMT +1:00) Berlin, Copenhagen, Madrid, Paris');
define('L_GMT_PLUS_200','(GMT +2:00) Kaliningrad, South Africa');
define('L_GMT_PLUS_300','(GMT +3:00) Baghdad, Riyadh, Moscow');
define('L_GMT_PLUS_330','(GMT +3:30) Tehran');
define('L_GMT_PLUS_400','(GMT +4.00) Abu Dhabi, Muscat, Baku');
define('L_GMT_PLUS_430','(GMT +4:30) Kabul');
define('L_GMT_PLUS_500','(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent');
define('L_GMT_PLUS_530','(GMT +5:30) Bombay, Calcutta, Madras, New Delhi');
define('L_GMT_PLUS_545','(GMT +5:45) Kathmandu');
define('L_GMT_PLUS_600','(GMT +6:00) Almaty, Dhaka, Colombo');
define('L_GMT_PLUS_700','(GMT +7:00) Bangkok, Hanoi, Jakarta');
define('L_GMT_PLUS_800','(GMT +8:00) Baijing, Perth, Singapore, Hong Kong');
define('L_GMT_PLUS_900','(GMT +9:00) Tokyo, Seoul, Osaka, Saoro, Yakutsk');
define('L_GMT_PLUS_930','(GMT +9:30) Adelaide, Darwin');
define('L_GMT_PLUS_1000','(GMT +10:00) Eastern Australia, Guam, Vladivostok');
define('L_GMT_PLUS_1100','(GMT +11:00) Magadan, Solomon Islands, New Caledonia');
define('L_GMT_PLUS_1200','(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka');

?>
