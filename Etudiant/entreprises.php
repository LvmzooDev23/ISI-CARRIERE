<?php
session_start();
require_once("menu.php");
require_once("../config.php");
require_once("../Controller/entreprises_services.php");
$entreprises = getAllEntreprises();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="home.css">
    <title><?= $title ?></title>
</head>

<body style="background-color: #f5f5f5;">
    <div class="top_page">
        <!-- <h1 class="title_top_page" align="center">DASHBOARD ETUDIANTS</h1> -->
        <div align="center" class="search">
            <input list="list-jobs" autocomplete="off" required placeholder="Ex.:Job..." type="text" class="searchJob" />
            <input list="list-localisation" autocomplete="off" required placeholder="Ex.:Localisation..." type="text" class="searchLocalisation" />
            <span>Rechercher un stage</span>
        </div>
        <datalist id="list-jobs">
            <!-- Faire un liste des jobs dans la BD -->
            <option value="DEVELOPPEUR FRONT-END"></option>
            <option value="DEVELOPPEUR BACK-END"></option>
            <option value="DEVELOPPEUR FULLSTACK"></option>
            <option value="ADMINISTRATEUR RESEAUX"> </option>
            <option value="ADMINISTRATEUR BASE DE DONNEES"></option>
            <option value="COMMUNITY MANAGER"></option>
            <option value="COMPTABLE"></option>
            <option value="ANALYSTE FINANCIER"></option>
            <option value="INFOGRAPHE"></option>
            <option value="MONTEUR VIDEO"></option>
        </datalist>
        <datalist id="list-localisation">
            <option value="DAKAR">DAKAR</option>
            <option value="THIES">DEVELOPPEUR BACK-END</option>
            <option value="FATICK">DEVELOPPEUR FULLSTACK</option>
            <option value="DIOURBEL"> </option>
            <option value="MATAM"></option>
            <option value="KAOLACK"></option>
            <option value="KOLDA"></option>
            <option value="ZIGUINCHOR"></option>
            <option value="SAINT-LOUIS"></option>
            <option value="CASAMANCE"></option>
        </datalist>
    </div>
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
                                <img src="../medias/location.png" width="30" height="30" alt="">

                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Adresse</p>

                                    <p class="font-medium"><?= $entreprise["adresseEntreprise"] ?></p>
                                </div>
                            </div>

                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg
                                    class="size-4 text-indigo-700"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>

                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Bathroom</p>

                                    <p class="font-medium">2 rooms</p>
                                </div>
                            </div>

                            <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                <svg
                                    class="size-4 text-indigo-700"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>

                                <div class="mt-1.5 sm:mt-0">
                                    <p class="text-gray-500">Bedroom</p>

                                    <p class="font-medium">4 rooms</p>
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