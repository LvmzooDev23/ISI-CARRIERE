<?php

session_start();
require_once("menu.php");
require_once("../config.php");
require_once("../Controller/entreprises_services.php");
$entreprises = getAllEntreprises();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="home.css">
    <title><?= $title ?></title>
</head>

<body style="background-color: #f5f5f5;">
     
    <div class="pt-2 lg:pt-2 min-h-screen">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 text-center px-2 mx-auto">
            <?php foreach ($entreprises as $entreprise) { ?>
                <a href="#" class="w-full inline-flex flex-col rounded-lg p-4 shadow-sm shadow-indigo-100">
                    <img
                        alt=""
                        src="https://images.unsplash.com/photo-1613545325278-f24b0cae1224?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                        class="h-56 w-full rounded-md object-cover" />

                    <div class="mt-2">
                        <dl>
                            <div>
                                <dt class="sr-only">NOM ENTREPRISE</dt>

                                <dd class="text-sm text-gray-500"><?= $entreprise["nomEntreprise"] ?></dd>
                            </div>

                            <div>
                                <dt class="sr-only">Secteur d'activité</dt>

                                <dd class="font-medium"><?= $entreprise["secteurEntreprise"] ?></dd>
                            </div>
                        </dl>

                        <div class="mt-6 flex items-center gap-8 text-xs">
                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <img src="../medias/location.png" width="20" height="20" alt="">

                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Adresse</p>

                                    <p class="font-medium"><?= $entreprise["adresseEntreprise"] ?></p>
                                </div>
                            </div>

                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <img src="../medias/enveloppe.png" width="20" height="20" alt="">

                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Adresse Mail</p>

                                    <p class="font-medium"><?= $entreprise["mailEntreprise"] ?></p>
                                </div>
                            </div>

                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                               <img src="../medias/telephone.png" width="20" height="20" alt="">
                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Téléphone</p>

                                    <p class="font-medium"><?= $entreprise["telephoneEntreprise"] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</body>

</html>