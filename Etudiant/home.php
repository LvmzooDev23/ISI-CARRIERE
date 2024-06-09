<?php
require_once("../config.php");
require_once("../Controller/students_services.php");
session_start();
require_once("menu.php");
$stages = getAllStage();
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
    <h1>DASHBOARD ETUDIANTS</h1>
    <?php
    var_dump($_SESSION['etu']);
    // var_dump($stages);

    ?>

    <div class="relative pt-2 lg:pt-2 min-h-screen">

        <div class="bg-cover w-full flex justify-center items-center" style="background-image: url('/images/mybackground.jpeg');">
            <div class="w-full bg-white p-5  bg-opacity-40 backdrop-filter backdrop-blur-lg">
                <div class="w-12/12 mx-auto rounded-2xl bg-white p-5 bg-opacity-40 backdrop-filter backdrop-blur-lg">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 text-center px-2 mx-auto">
                        <?php foreach ($stages as $stage) { ?>
                            <article class="bg-white  p-6 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border">
                                <a target="_self" href="../Stage/stage.php?id=<?= $stage[0] ?>" class="absolute opacity-0 top-0 right-0 left-0 bottom-0"></a>
                                <div class="relative mb-4 rounded-2xl">
                                    <img class="max-h-80 rounded-2xl w-full object-cover transition-transform duration-300 transform group-hover:scale-105" src="https://images.pexels.com/photos/163097/twitter-social-media-communication-internet-network-163097.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                                    <div class="absolute bottom-3 left-3 inline-flex items-center rounded-lg bg-white p-2 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-red-700">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                        <span class="ml-1 text-sm text-slate-400">2</span>
                                    </div>

                                    <a class="flex justify-center items-center bg-red-700 bg-opacity-80 z-10 absolute top-0 left-0 w-full h-full text-white rounded-2xl opacity-0 transition-all duration-300 transform group-hover:scale-105 text-xl group-hover:opacity-100" href="../Stage/stage.php?id=<?= $stage[0] ?>" target="_self" rel="noopener noreferrer">
                                        Voir offre
                                        <svg class="ml-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex justify-between items-center w-full pb-4 mb-auto">
                                    <div class="flex items-center">
                                        <div class="pr-3">
                                            <img class="h-12 w-12 rounded-full object-cover" src="https://images.pexels.com/photos/163097/twitter-social-media-communication-internet-network-163097.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                                        </div>
                                        <div class="flex flex-1">
                                            <div class="">
                                                <p class="text-sm font-semibold "><?= $stage[11] ?></p>
                                                <p class="text-sm text-gray-500">Deadline: <b><?= $stage[7] ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <div class="text-sm flex items-center text-gray-500 ">
                                            <?php $date = new DateTime();
                                            $duree = $date->diff(new DateTime($stage[8]));
                                            echo ($duree->format('%a') > 0 ? $duree->format('%a jours') : "Aujourd'hui");
                                            ?>
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="font-medium text-xl leading-8">
                                    <a href="../Stage/stage.php?id=<?= $stage[0] ?>" class="block relative group-hover:text-red-700 transition-colors duration-200 ">
                                        Poste Recherché: <?= $stage[1] ?>
                                    </a>
                                </h3>
                                <div>
                                </div>
                            </article>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>