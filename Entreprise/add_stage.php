<?php
require_once("../config.php");
require_once("../Controller/stages_services.php");
session_start();
include_once("menu.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $niveau = $_POST['niveau'];
    $annee = $_POST['annee'];
    $debutStage = $_POST['debutStage'];
    $dureeStage = $_POST['dureeStage'];
    $deadline = $_POST['deadline'];
    $datePublication = date('Y-m-d');
    $entreprise = $_SESSION['etp'];
    $informations = [$titre, $description, $niveau, $annee, $debutStage, $dureeStage, $deadline, $datePublication, $entreprise];
    if (!in_array(null, $informations)) {
        $stage = add_stage($titre, $description, $niveau, $annee, $debutStage, $dureeStage, $deadline, $datePublication, $entreprise);
    }else{
        echo "UN DES CHAMPS EST VIDE";
    }
    if (!$stage) {
        require_once "error.php";
    }
}

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
    <!-- component -->
    <div class=" w-fit flex items-center justify-center p-12 bg-gray-300 p-0 sm:p-12">
        <div class="mx-auto w-full max-w-[550px]">
            <form action="" method="POST">
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="fName" class="mb-3 block text-base font-medium text-[#07074D]">
                                Titre du Stage
                            </label>
                            <input required type="text" name="titre" id="fName" placeholder="Saisir le titre..." class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                                Description du stage
                            </label>
                            <textarea type="text" name="description" id="lName" placeholder="Description du stage..." class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                        </div>
                    </div>
                </div>
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="guest" class="mb-3 block text-base font-medium text-[#07074D]">
                            Diplome ou Niveau Requis
                        </label>
                        <select name="niveau" id="HeadlineAct" class="">
                            <option value="">--- Niveau ou Diplome ---</option>
                            <option value="BT1">BREVET DE TECHNICIEN 1</option>
                            <option value="BT2">BREVET DE TECHNICIEN 2</option>
                            <option value="BT3">BREVET DE TECHNICIEN 3</option>
                            <option value="L1">LICENCE 1</option>
                            <option value="L2">LICENCE 2</option>
                            <option value="L3">LICENCE 3</option>
                            <option value="M1">MASTER 1</option>
                            <option value="M2">MASTER 2</option>
                        </select>
                        <span class="text-sm text-red-600 hidden" id="error">Veuillez sélectionner ou renseigner un secteur</span>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="guest" class="mb-3 block text-base font-medium text-[#07074D]">
                        Nombre d'année d'expérience requis
                    </label>
                    <input required type="number" name="annee" id="guest" placeholder="0" min="0" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                Début de Stage
                            </label>
                            <input required type="date" name="debutStage" id="date" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                Durée de Stage
                            </label>
                            <input required type="number" placeholder="(nombre de mois)" name="dureeStage" id="time" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                Date Limite de soumission
                            </label>
                            <input required type="date" name="deadline" id="time" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                </div>



                <div>
                    <button class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 mx-5 text-center text-base font-semibold text-white outline-none">
                        Envoyer
                    </button>
                    <button type="reset" class="hover:shadow-form rounded-md bg-slate-900 py-3 px-8 mx-5 text-center text-base font-semibold text-white outline-none">
                        Annuler
                    </button>
                    <a type="button" href="home.php" class="hover:shadow-form rounded-md bg-red-500 py-3 px-8 mx-5 text-center text-base font-semibold text-white outline-none">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>