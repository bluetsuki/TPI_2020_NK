<?php
require __DIR__.'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$tpiChoosen = FILTER_INPUT(INPUT_GET, 'tpiID', FILTER_SANITIZE_NUMBER_INT);
$btn = FILTER_INPUT(INPUT_POST, 'valid', FILTER_SANITIZE_STRING);
$assignedExpert = FILTER_INPUT(INPUT_GET, 'expert', FILTER_SANITIZE_STRING);
$error = '';

if (in_array($_SESSION['id'], getTPIsById($tpiChoosen)[0]) || in_array('Administrator', $_SESSION['roles'][0]) || in_array('Manager', $_SESSION['roles'][0])) {

    $tpiInfo = getTPIInfoCandidate($tpiChoosen);

    $expert1Name = $tpiInfo['expert1LastName'] . ' ' . $tpiInfo['expert1FirstName'];
    $expert2Name = $tpiInfo['expert2LastName'] . ' ' . $tpiInfo['expert2FirstName'];

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
        $expert1Sign = $tabValidation['expert1Signature'];
        $expert2Sign = $tabValidation['expert2Signature'];
    }else{
        for ($i = 0; $i < count($validation_criterions); $i++) {
            $criterions[] = '';
        }
        $comment = '';
        $expert1Sign = '';
        $expert2Sign = '';
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
        $form .= '<td><select class="form-control" id="answer" name="answer' . $key . '">';
        $form .= "<option></option>";

        $form .= "<option ";
        $form .= $criterions[$key] == 'oui' ? 'selected' : '';
        $form .= ">oui</option>";

        $form .= "<option ";
        $form .= $criterions[$key] == 'non' ? 'selected' : '';
        $form .= ">non</option>";

        $form .= "<option ";
        $form .= $criterions[$key] == 'n/a' ? 'selected' : '';
        $form .= ">n/a</option>";

        $form .= '</select></td>';
    }
    //@TODO get the name of the 2 experts
    $form .= <<<FORMVALID
    </tr>
    </table>
    <div class="form-group">
    <label for="comment">Commentaire</label>
    <textarea style="resize: none;" cols="100" class="form-control" id="comment" name="comment">$comment</textarea>
    </div>
    <tr>
    $expert1Name : $expert1Sign <br>
    $expert2Name : $expert2Sign
    </tr>
    FORMVALID;

    if (in_array('validateTPIs', $_SESSION['rights'][0])) {
        $form .= '<a href="?action=editParam&tpiID=$tpiChoosen"><button name="valid" value="valid" class="btn btn-success float-right">Valider</button></a></form>';
    }


    if ($btn == 'valid') {
        $tabNewCrit = array();
        $newComment = FILTER_INPUT(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

        for ($i = 0; $i < count($validation_criterions); $i++) {
            $crit = FILTER_INPUT(INPUT_POST, 'answer' . $i, FILTER_SANITIZE_STRING);
            array_push($tabNewCrit, $crit);
        }

        $newCrit = implode(';', $tabNewCrit);

        if (!empty($criterions[0])){
            updCriterions($tpiChoosen, $newCrit);
        }
        else{
            addCrit($tpiChoosen, $newCrit);
        }

        updComment($tpiChoosen, $newComment);

        if (in_array('non', $tabNewCrit)) {
            updStatus($tpiChoosen, 'draft');
            updCriterions($tpiChoosen, $newCrit);
            updExpertSign($tpiChoosen, '', 'expert1Signature');
            updExpertSign($tpiChoosen, '', 'expert2Signature');
        }else{
            updStatus($tpiChoosen, 'submitted');
            if ($assignedExpert == '1') {
                updExpertSign($tpiChoosen, date('Y-m-d H:i:s'), 'expert1Signature');
            }else{
                updExpertSign($tpiChoosen, date('Y-m-d H:i:s'), 'expert2Signature');
            }
        }

        if (!empty(getValidation($tpiChoosen))) {
            $tabValidation = getValidation($tpiChoosen)[0];
        }

        if ($tabValidation['criterions'] != $newCrit) {
            updExpertSign($tpiChoosen, '', 'expert1Signature');
            updExpertSign($tpiChoosen, '', 'expert2Signature');
            if ($assignedExpert == '1') {
                updExpertSign($tpiChoosen, date('Y-m-d H:i:s'), 'expert1Signature');
            }else{
                updExpertSign($tpiChoosen, date('Y-m-d H:i:s'), 'expert2Signature');
            }
        }

        if ($tabValidation['expert1Signature'] != '' && $tabValidation['expert2Signature'] != '') {
            updStatus($tpiChoosen, 'valid');

            $tpiInfo = getTPIInfoCandidate($tpiChoosen);
            $sign = getSignExpert($tpiChoosen);

            $year = $tpiInfo['year'];
            $title = $tpiInfo['title'];
            $domain = $tpiInfo['cfcDomain'];
            $dateStart = explode(' ', $tpiInfo['sessionStart']);
            $dateEnd = explode(' ', $tpiInfo['sessionEnd']);

            $start = $dateStart[0];
            $end = $dateEnd[0];
            $hourStart = explode(':', $dateStart[1])[0] . ':' . explode(':', $dateStart[1])[1];
            $hourEnd = explode(':', $dateEnd[1])[0] . ':' . explode(':', $dateEnd[1])[1];

            $workplace = $tpiInfo['workplace'];

            $candLastName = $tpiInfo['candidateLastName'];
            $candFirstName = $tpiInfo['candidateFirstName'];
            $candPhone = $tpiInfo['candidatePhone'];
            $candMail = $tpiInfo['candidateMail'];

            $managerCompagny = $tpiInfo['managerCompagny'];
            $managerLastName = $tpiInfo['managerLastName'];
            $managerFirstName = $tpiInfo['managerFirstName'];
            $managerPhone = $tpiInfo['managerPhone'];
            $managerMail = $tpiInfo['managerMail'];

            $expert1LastName = $tpiInfo['expert1LastName'];
            $expert1FirstName = $tpiInfo['expert1FirstName'];
            $expert1Phone = $tpiInfo['expert1Phone'];
            $expert1Mail = $tpiInfo['expert1Mail'];

            $expert2LastName = $tpiInfo['expert2LastName'];
            $expert2FirstName = $tpiInfo['expert2FirstName'];
            $expert2Phone = $tpiInfo['expert2Phone'];
            $expert2Mail = $tpiInfo['expert2Mail'];

            $expert1Sign = explode(' ', $sign['expert1Signature']);
            $expert1SignDate = $expert1Sign[0];
            $expert1HourSign = explode(':', $expert1Sign[1])[0] . ':' . explode(':', $expert1Sign[1])[1];
            $expert1Valid = "$expert1LastName $expert1FirstName : Validé le $expert1SignDate à $expert1HourSign";

            $expert2Sign = explode(' ', $sign['expert2Signature']);
            $expert2SignDate = $expert1Sign[0];
            $expert2HourSign = explode(':', $expert2Sign[1])[0] . ':' . explode(':', $expert2Sign[1])[1];
            $expert2Valid = "$expert2LastName $expert2FirstName : Validé le $expert2SignDate à $expert2HourSign";

            $comment = $tabValidation['comment'];

            $format = 'Validation_TPI_' . $year . '_' . $tpiChoosen . '_' . $candLastName . '_' . $candFirstName . '.pdf';
            updPdfPath($tpiChoosen, $format);


            try {
                ob_start();

                require_once 'printValidation.php';

                $exp = ob_get_clean();

                $html2pdf = new Html2Pdf('P', 'A4', 'fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($exp);
                $html2pdf->output(__DIR__ . '/../pdf/' . $format, 'F');
            } catch (Html2PdfException $e) {
                $html2pdf->clean();

                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }

        }

        header('Location: ?action=displayValidationTPI');
        exit;
    }
}else{
    // header('Location: ?action=home');
    // exit;
}
