<?php
/*
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
$tpl = $STYLE->open('./acp/system-users.tpl');
if (isset($_POST['submit'])) {
    if (isset($_POST['template'])) {
        $template = $secure->clean($_POST['template']);
    } else {
        $template = '';
    }
    if (isset($_POST['activation'])) {
        $activation= $secure->clean($_POST['activation']);
    } else {
        $activation = '';
    }
    if (isset($_POST['iplock'])) {
        $iplock = $secure->clean($_POST['iplock']);
    } else {
        $iplock = '';
    }
    if (isset($_POST['userreg'])) {
        $userreg = $secure->clean($_POST['userreg']);
    } else {
        $userreg = '';
    }
    $db->query("UPDATE " . $prefix . "_confdata SET value = '$iplock' WHERE name = 'iplock'");
    $db->query("UPDATE " . $prefix . "_confdata SET value = '$template' WHERE name = 'usertemplate'");
    $db->query("UPDATE " . $prefix . "_confdata SET value = '$activation' WHERE name = 'activation'");
    $db->query("UPDATE " . $prefix . "_confdata SET value = '$userreg' WHERE name = 'userreg'");
    $system->redirect("./?s=system&module=users", true);
}
if ($system->confdata('iplock') == '1') {
    $ipyes = 'selected';
    $ipno = '';
} else {
    $ipno = 'selected';
    $ipyes = '';
}
if ($system->confdata('activation') == '1') {
    $ayes = 'selected';
    $ano = '';
} else {
    $ano = 'selected';
    $ayes = '';
}
if ($system->confdata('usertemplate') == '1') {
    $utyes = 'selected';
    $utno = '';
} else {
    $utno = 'selected';
    $utyes = '';
}
if ($system->confdata('userreg') == '1') {
    $ryes = 'selected';
    $rno = '';
} else {
    $rno = 'selected';
    $ryes = '';
}
$output .= $STYLE->tags($tpl, array(
            "UTYES" => $utyes,
            "UTNO" => $utno,
            "RYES" => $ryes,
            "RNO" => $rno,
            "IPYES" => $ipyes,
            "IPNO" => $ipno,
            "AYES" => $ayes,
            "ANO" => $ano,
            "L_SUBMIT" => L_SUBMIT,
            "L_ENABLED" => L_ENABLED,
            "L_DISABLED" => L_DISABLED,
            "L_REGISTRATION" => L_REGISTRATION,
            "L_REGISTRATION_MSG" => L_REGISTRATION_MSG,
            "L_ACTIVATION" => L_ACTIVATION,
            "L_ACTIVATION_MSG" => L_ACTIVATION_MSG,
            "L_IP_LOCK" => L_IP_LOCK,
            "L_IP_LOCK_MSG" => L_IP_LOCK_MSG,
            "L_USER_TEMPLATE" => L_USER_TEMPLATE,
            "L_USER_TEMPLATE_MSG" => L_USER_TEMPLATE_MSG,
            "L_USER_SETTINGS" => L_USER_SETTINGS
        ));
?>