<?php
$tpiChoosen = FILTER_INPUT(INPUT_GET, 'tpiID', FILTER_SANITIZE_NUMBER_INT);
$btn = FILTER_INPUT(INPUT_POST, 'valid', FILTER_SANITIZE_STRING);
$assignedExpert = FILTER_INPUT(INPUT_GET, 'expert', FILTER_SANITIZE_STRING);

if (in_array($_SESSION['id'], getTPIsById($tpiChoosen)[0])) {
    $validation_criterions = array(
        "Le nombre d'heures estimés est en accord avec le règlement. (70-90 heures)",
        "L'énoncé est entièrement rédigé par le supérieur du candidat.",
        "L'énoncé comprend uniquement des éléments connus du candidat. (Pas de travail de recherche)",
        "L'énoncé correspond à l'éventail normal des tâches de cette place de travail.",
        "L'énoncé décrit clairement et sans équivoque les éléments vérifiables et de contrôle.",
        "L'énoncé ne laisse pas de possibilité à interprétation du travail final. (Pas de phrase au conditionnel)",
        "L'énoncé décrit clairement les buts à atteindre dans le travail final.",
        "L'aspect capital de l'énoncé fait partie du domaine professionnel selon le règlement.",
        "L'énoncé est soluble par un collaborateur de qualification moyenne.",
        "Le travail est exécutable individuellement. Si c'est un travail de groupe, les tâches de chaque membre sont clairement définies.",
        "Le travail de comprend pas de production de série (de manière à atteinder le minimum d'heures obligatoire).",
        "Les questions A14-A20 sont remplies.",
        "Les questions A14-A20 sont différentes des questions de la grille d'évaluation.",
        "Le supérieur et le candidat sont préparé à cet examen"
    );
    if (!empty(getValidation($tpiChoosen))) {
        $tabValidation = getValidation($tpiChoosen)[0];
        $criterions = explode(';', $tabValidation['criterions']);
        $comment = $tabValidation['comment'];
    }

    $form = <<<FORMVALID
    <form action="#" method="POST">
    <table class="table table-bordered mt-2">
    <thead>
    <th>Critère</th>
    <th>Rempli</th>
    </thead>
    FORMVALID;

    foreach ($validation_criterions as $key => $value) {
        $form .= '<tr><td>' . $value . '</td>';
        $form .= '<td><select class="form-control" name="answer' . $key . '">';
        $form .= "<option ";
        $form .= $criterions[$key] == 'n/a' ? 'selected' : '';
        $form .= ">n/a</option>";

        $form .= "<option ";
        $form .= $criterions[$key] == 'oui' ? 'selected' : '';
        $form .= ">oui</option>";

        $form .= "<option ";
        $form .= $criterions[$key] == 'non' ? 'selected' : '';
        $form .= ">non</option>";

        $form .= '</select></td>';
    }
    $form .= <<<FORMVALID
    </tr>
    </table>
        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea style="resize: none;" cols="100" class="form-control" id="comment" name="comment">$comment</textarea>
        </div>
        <a href="?action=editParam&tpiID=$tpiChoosen"><button name="valid" value="valid" class="btn btn-success float-right">Valider</button></a>
        </form>
    FORMVALID;

    if ($btn == 'valid') {
        $tabNewCrit = array();
        $newComment = FILTER_INPUT(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

        for ($i = 0; $i < count($validation_criterions); $i++) {
            $crit = FILTER_INPUT(INPUT_POST, 'answer' . $i, FILTER_SANITIZE_STRING);
            array_push($tabNewCrit, $crit);
        }
        $newCrit = implode(';', $tabNewCrit);

        if (in_array('non', $tabNewCrit) || in_array('n/a', $tabNewCrit)) {
            updStatus($tpiChoosen, 'draft');
            updExpertSign($tpiChoosen, '', 'expert1Signature');
            updExpertSign($tpiChoosen, '', 'expert2Signature');
        }else{
            updComment($tpiChoosen, $newComment);
            if ($assignedExpert == '1') {
                updExpertSign($tpiChoosen, date('Y-m-d H:i:s'), 'expert1Signature');
            }else{
                updExpertSign($tpiChoosen, date('Y-m-d H:i:s'), 'expert2Signature');
            }
        }

        $tabValidation = getValidation($tpiChoosen)[0];

        if ($tabValidation['expert1Signature'] != '' && $tabValidation['expert2Signature'] != '') {
            updStatus($tpiChoosen, 'valid');

            $tpiInfo = getTPIInfoCandidate($tpiChoosen);
            $sign = getSignExpert($tpiChoosen);

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

            $expert1Sign = explode(' ', $sign[0]['expert1Signature']);
            $expert1SignDate = $expert1Sign[0];
            $expert1HourSign = explode(':', $expert1Sign[1])[0] . ':' . explode(':', $expert1Sign[1])[1];
            $expert1Valid = "$expert1LastName $expert1FirstName : Validé le $expert1SignDate à $expert1HourSign";

            $expert2Sign = explode(' ', $sign[0]['expert2Signature']);
            $expert2SignDate = $expert1Sign[0];
            $expert2HourSign = explode(':', $expert2Sign[1])[0] . ':' . explode(':', $expert2Sign[1])[1];
            $expert2Valid = "$expert2LastName $expert2FirstName : Validé le $expert2SignDate à $expert2HourSign";

            $comment = $tabValidation['comment'];

            $format = 'Validation_TPI_' . $year . '_' . $tpiChoosen . '_' . $candLastName . '_' . $candFirstName . '.pdf';
            updPdfPath($tpiChoosen, $format);

            require_once 'pdf.php';
        }

        if (!empty($criterions)){
            updCriterions($tpiChoosen, $newCrit);
        }
        else{
            addCrit($tpiChoosen, $newCrit);
        }

        header('Location: ?action=displayValidationTPI');
        exit;
    }
}else{
    header('Location: ?action=home');
    exit;
}

if ($pdf == 'true') {

}
