<?php
// Ce fichier contient la mise en forme pour l'impresssion PDF de l'évaluation
// Il a fonctionné avec html2pdf pour la réalisation du jeu de données.
?>
<style>
* {
    font-family: Arial, sans-serif
}

td {
    vertical-align: top;
    padding: 2mm;
}

th {
    vertical-align: top;
    text-align: left;
    padding: 2mm;
}

.attention {
    color: red;
}

.cartouche,
.cartouche td,
.cartouche th {
    border: 1px solid black;
    border-collapse: collapse;
}

.lowerline {
    border-bottom: 1px solid black;
    border-collapse: collapse;
}


h4 {
    margin: 0;
}

p {
    margin-top: 1mm;
    margin-bottom: 1mm;
}

table.page_footer {
    width: 100%;
    border: none;
    border-top: solid 1px black;
    padding: 2mm
}

table.page_header {
    width: 100%;
    border: none;
    border-bottom: solid 1px black;
    padding: 2mm
}
</style>

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">


    <table>
        <tr>
            <td width="60"><img src="img/GE50px.png" alt="logo GE"></td>
            <td width="460">
                <p>République et canton de Genève<br>Département de l'instruction publique, <br>de la formation et de la jeunesse<br><strong>Office pour l'orientation, <br>la formation professionnelle et continue</strong>
                </p>
            </td>
            <td width="100"><img src="img/LogoExpertsDev100px.png" alt="logo Expert"></td>
        </tr>
    </table>

    <h2 style="text-align:center">Travail pratique individuel (TPI)</h2>
    <h4 style="text-align:center">Informaticien-ne CFC<br> Validation de l'énoncé (<span class="attention">sans la présence du candidat</span>)</h4>

    <table class="cartouche">
        <tr>
            <td width="310">
                <h4>Entreprise formatrice, chef de projet</h4>
                <p>
                    test<br>
                    MANAGER_LAST_NAME MANAGER_FIRST_NAME<br>
                    MANAGER_PHONE<br>
                    MANAGER_EMAIL
                </p>
            </td>
            <td width="310">
                <h4>Candidat</h4>
                <p><br>
                    CANDIDATE_LAST_NAME CANDIDATE_FIRSTNAME<br>
                    CANDIDATE_PHONE<br>
                    CANDIDATE_EMAIL
                </p>
            </td>

        </tr>
        <tr>
            <td>
                <h4>1<sup>er</sup> Expert</h4>
                <p>
                    EXPERT1_LAST_NAME EXPERT1_FIRSTNAME<br>
                    EXPERT1_PHONE<br>
                    EXPERT1_EMAIL
                </p>
            </td>
            <td>
                <h4>2<sup>ème</sup> Expert</h4>
                <p>
                    EXPERT2_LAST_NAME EXPERT2_FIRSTNAME<br>
                    EXPERT2_PHONE<br>
                    EXPERT2_EMAIL
                </p>
            </td>
        </tr>
    </table>
    <p><br></p>

    <table>
        <tr>
            <th width="100" class="lowerline">Titre du travail</th>
            <td width="510" class="lowerline">
                <h4>TPI_TITLE</h4>
            </td>
        </tr>

        <tr>
            <th width="100" class="lowerline">Domaine</th>
            <td width="510" class="lowerline">CFC_DOMAIN</td>
        </tr>
        <tr>
            <th width="100" class="lowerline">Dates</th>
            <td width="510" class="lowerline">du JJ MMMM AAAA au JJ MMMM AAAA, de HH:MM à HH:MM</td>
        </tr>
        <tr>
            <th width="100" class="lowerline">Lieu où se déroule le travail</th>
            <td width="510" class="lowerline">WORKPLACE</td>
        </tr>
    </table>

    <table class="cartouche">
        <thead>
            <tr>
                <th width="520">Critère</th>
                <th width="100">Rempli</th>
            </tr>
        </thead>
        <tbody>
            BOUCLE SUR LES CRITERES DE VALIDATION
            <tr>
                <td width="500">CRITERE</td>
                <td width="100">OUI_NON_N/A</td>
            </tr>
            FIN DE BOUCLE
            <tr>
                <td colspan="2" width="640">
                    <h4>Remarques, mesures de correction</h4>
                    <p>COMMENT</p>
                </td>
            </tr>
        </tbody>

    </table>
    <h2>Validation</h2>

    <table class="cartouche">
        <tbody>
            <tr>
                <td width="640">
                    EXPERT1_LAST_NAME EXPERT1_FIRSTNAME : Validé le JJ MMMM AAAA à HH:MM / Pas validé
                    <br>
                    EXPERT2_LAST_NAME EXPERT2_FIRSTNAME : Validé le JJ MMMM AAAA à HH:MM / Pas validé
                </td>
            </tr>
        </tbody>
    </table>
</page>
