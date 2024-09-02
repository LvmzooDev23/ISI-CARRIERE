<?php
session_start();
require_once("menu.php");
require_once("../Controller/students_services.php");
require_once("../Controller/entreprises_services.php");
$candidatures = getAllCandidatures($_SESSION['etu']);
// var_dump($candidatures);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans content-center antialiased text-gray-900 leading-normal tracking-wider bg-cover" style="background-image:url('https://source.unsplash.com/1L71sPT5XKc');">
    <!-- component -->
    <table class="border-collapse mt-5 w-3/4" align="center">
        <thead>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Entreprise / Startup</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Titre de Stage</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidatures as $candidature) : ?>
                <?php $entreprise = getEntrepriseById($entreprise = $candidature['entrepriseStage']); ?>
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"></span>
                        <?= $entreprise[0][1] ?>
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Country</span>
                        <?= $candidature['titreStage'] ?>
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                        <span class="rounded bg-<?php echo ($candidature['statutCandidature'] == "ATT") ? "yellow" : (($candidature['statutCandidature'] == "ACC") ? "green" : "red"); ?>-400 py-1 px-3 text-xs font-bold">
                            <?php echo ($candidature['statutCandidature'] == "ATT") ? "EN ATTENTE" : (($candidature['statutCandidature'] == "ACC") ? "ACCEPTE" : "NON RETENU"); ?>
                        </span>
                    </td>
 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>