<?php
require __DIR__.'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (in_array($_SESSION['id'], getTPIsById($tpiChoosen)[0]) || in_array('Administrator', $_SESSION['roles'][0]) || in_array('Manager', $_SESSION['roles'][0])) {

    $tpiInfo = getTPIInfoCandidate($tpiChoosen);

    $expert1Name = $tpiInfo['expert1LastName'] . ' ' . $tpiInfo['expert1FirstName'];
    $expert2Name = $tpiInfo['expert2LastName'] . ' ' . $tpiInfo['expert2FirstName'];

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
        $form .= '<td><select required class="form-control" name="answer' . $key . '">';
        $form .= "<option></option>";

        $form .= '<option value="oui"';
        $form .= $criterions[$key] == 'oui' ? 'selected' : '';
        $form .= ">oui</option>";

        $form .= '<option value="non"';
        $form .= $criterions[$key] == 'non' ? 'selected' : '';
        $form .= ">non</option>";

        $form .= '<option value="n/a"';
        $form .= $criterions[$key] == 'n/a' ? 'selected' : '';
        $form .= ">n/a</option>";

        $form .= '</select></td>';
    }
    $form .= <<<FORMVALID
    </tr>
    </table>
    <div class="form-group">
    <label for="comment">Commentaire</label>
    FORMVALID;
    if ($commentRequired) {
        $form .= "<textarea style=\"resize: none;\" cols=\"100\" class=\"form-control\" id=\"comment\" name=\"comment\" required>$comment</textarea>";
    }else{
        $form .= "<textarea style=\"resize: none;\" cols=\"100\" class=\"form-control\" id=\"comment\" name=\"comment\">$comment</textarea>";
    }

    $form .= <<<FORMVALID
    </div>
    <tr>
    $expert1Name : $expert1Sign <br>
    $expert2Name : $expert2Sign
    </tr>
    FORMVALID;

    if (in_array('validateTPIs', $_SESSION['rights'][0])) {
        $form .= '<a href="?action=editParam&tpiID=$tpiChoosen"><button name="valid" value="valid" class="btn btn-success float-right">Valider</button></a></form>';
    }
}else{
    header('Location: ?action=home');
    exit;
}
