<?php
if ($pdf == 'true') {
    $tpiInfo = getTPIInfoCandidate($tpiChoosen);
    $sign = getSignExpert($tpiChoosen);

    // $tpiValidation = getTPIValidation($tpiChoosen);
    $year = $tpiInfo[0]['year'];
    $title = $tpiInfo[0]['title'];
    $domain = $tpiInfo[0]['cfcDomain'];
    $dateStart = explode(' ', $tpiInfo[0]['sessionStart']);
    $dateEnd = explode(' ', $tpiInfo[0]['sessionEnd']);

    $start = $dateStart[0];
    $end = $dateEnd[0];
    $hourStart = explode(':', $dateStart[1])[0] . ':' . explode(':', $dateStart[1])[1];
    $hourEnd = explode(':', $dateEnd[1])[0] . ':' . explode(':', $dateEnd[1])[1];

    $workplace = $tpiInfo[0]['workplace'];

    $candLastName = $tpiInfo[0]['candidateLastName'];
    $candFirstName = $tpiInfo[0]['candidateFirstName'];
    $candPhone = $tpiInfo[0]['candidatePhone'];
    $candMail = $tpiInfo[0]['candidateMail'];

    $managerCompagny = $tpiInfo[0]['managerCompagny'];
    $managerLastName = $tpiInfo[0]['managerLastName'];
    $managerFirstName = $tpiInfo[0]['managerFirstName'];
    $managerPhone = $tpiInfo[0]['managerPhone'];
    $managerMail = $tpiInfo[0]['managerMail'];



    $expert1LastName = $tpiInfo[0]['expert1LastName'];
    $expert1FirstName = $tpiInfo[0]['expert1FirstName'];
    $expert1Phone = $tpiInfo[0]['expert1Phone'];
    $expert1Mail = $tpiInfo[0]['expert1Mail'];

    $expert2LastName = $tpiInfo[0]['expert2LastName'];
    $expert2FirstName = $tpiInfo[0]['expert2FirstName'];
    $expert2Phone = $tpiInfo[0]['expert2Phone'];
    $expert2Mail = $tpiInfo[0]['expert2Mail'];

    if ($sign[0]['expert1Signature'] != NULL) {
        $expert1Sign = explode(' ', $sign[0]['expert1Signature']);
        $expert1SignDate = $expert1Sign[0];
        $expert1HourSign = explode(':', $expert1Sign[1])[0] . ':' . explode(':', $expert1Sign[1])[1];
        $expert1Valid = "$expert1LastName $expert1FirstName : Validé le $expert1SignDate à $expert1HourSign";

    }else{
        $expert1Valid = "Pas validé";
    }

    if ($sign[0]['expert2Signature'] != NULL) {
        $expert2Sign = explode(' ', $sign[0]['expert2Signature']);
        $expert2SignDate = $expert1Sign[0];
        $expert2HourSign = explode(':', $expert2Sign[1])[0] . ':' . explode(':', $expert2Sign[1])[1];
        $expert2Valid = "$expert2LastName $expert2FirstName : Validé le $expert2SignDate à $expert2HourSign";

    }else{
        $expert2Valid = "Pas validé";
    }

    require_once 'pdf.php';
}
