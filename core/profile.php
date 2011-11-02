<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
if ( isset($_GET['user']))
{
    $user_id = $secure->clean($_GET['user']);

    if ( ! $account )
    {
        $system->message(L_ERROR,L_PERMISSION_ERROR_AREA,'./',L_CONTINUE);
    }
    $result = $db->fetch("SELECT * FROM accounts WHERE id = '$user_id'");

    if ( $result )
    {
        $tpl = $STYLE->open('profile.tpl');
        // Generate Global Menu
        $global_menu = $STYLE->getcode('menu',$tpl);
        $tpl = str_replace ($global_menu,'',$tpl);
        $global_menu = $STYLE->tags($global_menu,array("L_SEND_MAIL" => L_SEND_MAIL, "L_SETTINGS" => L_SETTINGS, "L_SIGNATURE" => L_SIGNATURE, "L_AVATAR" => L_AVATAR));
        $page_title = $page_title.' / '.$user->name($user_id);
        $output .= $STYLE->tags($tpl,array(
            "AVATAR"=>$user->avatar($user_id),
            "NAME" => $user->name($user_id),
            "STATUS" => $user->status($user_id),
            "RANK" => $user->rank($user_id),
            "JOINED" => $system->time($result['joined']),
            "LASTLOGIN" => $system->time($result['lastlogin']),
            "GENDER" => $user->gender($user_id),
            "LOCATION" => $system->present($result['location']),
            "SIGNATURE" => $system->bbcode($result['signature']),
            "L_RANK" => L_RANK,
            "L_JOINED" => L_JOINED,
            "L_LAST_LOGIN" => L_LAST_LOGIN,
            "L_GENDER" => L_GENDER,
            "L_LOCATION" => L_LOCATION,
            "L_DETAILS" => L_DETAILS,
            "L_SIGNATURE" => L_SIGNATURE
                ));
    } else {
        $system->message(L_ERROR,L_PROFILE_ERROR,'./',L_CONTINUE);
    }

} else {
    $system->message(L_ERROR,L_PROFILE_ERROR,'./',L_CONTINUE);
}
?>
