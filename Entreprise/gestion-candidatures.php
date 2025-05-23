<?php
session_start();
require_once("../config.php");
require_once("../Controller/entreprises_services.php");
if (isset($_SESSION['etp'])) {
    $candidatures = getAllCandidaturesFromEntreprise($_SESSION['etp']);
}
// var_dump($candidatures);
require_once("menu.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <style>
        .voirDetails{
            color: white;
            background-color: lightblue;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid green;
            cursor: pointer;
        }
        .voirDetails:hover{
            color: black;
            background-color: blue;
            
        }
    </style>
    <!-- component -->
    <section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
        <div class="flex flex-col justify-center h-full">
            <!-- Table -->
            <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">Candidats</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Name</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Email</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Poste</div>
                                    </th>
                                    
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Statut</div>
                                    </th>
                                    
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Réponse</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                <?php foreach ($candidatures as $candidature) : ?>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <!-- <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                                    <img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov">
                                                </div> -->
                                                <div class="font-medium text-gray-800"><?= $candidature['prenomEtudiant'] . " " . $candidature['nomEtudiant'] ?></div>
                                            </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left"><?= $candidature['mailEtudiant'] ?></div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left font-medium text-dark-500"><?= $candidature['titreStage'] ?></div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left font-medium text-<?php echo ($candidature['statutCandidature'] == "ATT") ? "yellow" : (($candidature['statutCandidature'] == "ACC") ? "green" : "red"); ?>-500">
                                            <?php echo ($candidature['statutCandidature'] == "ATT") ? "EN ATTENTE" : (($candidature['statutCandidature'] == "ACC") ? "ACCEPTE" : "NON RETENU"); ?>
                                        </div>
                                        </td>
                                        <td class="p-2">
                                            <div class="reponse-icone">
                                                <a class="voirDetails" href="detail_candidature.php?id=<?= $candidature['idCandidature'] ?>">VOIR DETAILS</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>