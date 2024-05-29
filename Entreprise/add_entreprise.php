<?php
global $title;
require_once "../config.php";
require_once "../Controller/entreprises_services.php";
$tabErrors = [
    "nom" => "Le champ 'Nom' est ",
    "prenom" => "Le champ 'Prénom' est ",
    "emailVide" => "Le champ 'Email' est obligatoire !!",
    "emailIncorrect" => "Le champ 'Email' doit contenir '@groupeisi.com' !!",
    "motdepasse" => "Le champ 'Mot de passe' est obligatoire !!",
    "telephoneVide" => "Le champ 'Telephone' est obligatoire !!",
    "telephoneIncorrect" => "Le champ 'Telephone' doit commencer par 75, 76, 77 ou 78 et contenir 9 chiffres !!",
    "niveau" => "Le champ 'Niveau' est obligatoire !!",
    "specialite" => "Le champ 'Specialité' est obligatoire !!",
];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nom'];
    $secteur = $_POST['secteur'];
    $adresse = $_POST['adresse'];
    $email = verifyEmailEntreprise($_POST['email']) ? $email = $_POST['email'] : null;
    $telephone = verifyPhoneEntreprise($_POST['telephone']) ? $phone = $_POST['telephone'] : null;
    $password = $_POST['motdepasse'];
    $informations = [$name, $secteur, $adresse, $telephone, $email, $password];
    if (!in_array(null, $informations)) {
        $entreprise = add_entreprise($name, $secteur, $adresse, $telephone, $email, $password);
        if ($entreprise) {
            include_once('success.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= $title ?></title>
</head>

<body class="bg-slate-900">
    <style>
        .-z-1 {
            z-index: -1;
        }

        .origin-0 {
            transform-origin: 0%;
        }

        input:focus~label,
        input:not(:placeholder-shown)~label,
        textarea:focus~label,
        textarea:not(:placeholder-shown)~label,
        select:focus~label,
        select:not([value='']):valid~label {
            /* @apply transform; scale-75; -translate-y-6; */
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            --tw-scale-x: 0.75;
            --tw-scale-y: 0.75;
            --tw-translate-y: -1.5rem;
        }

        input:focus~label,
        select:focus~label {
            /* @apply text-black; left-0; */
            --tw-text-opacity: 1;
            color: rgba(0, 0, 0, var(--tw-text-opacity));
            left: 0px;
        }
    </style>

    <div class="min-h-screen bg-gray-300 p-0 sm:p-12">
        <div class="mx-auto max-w-md px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
            <h1 class="text-2xl text-center font-bold mb-8 underline">Formulaire Inscription Entreprise</h1>
            <p><?php var_dump($entreprise) ?></p>
            <form id="form" novalidate method="post">
                <div class="relative z-0 w-full mb-5">
                    <input autocomplete="off" type="text" name="nom" placeholder=" " required class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Nom Entreprise</label>
                    <span class="text-sm text-red-600 hidden" id="error">Le Champ "Nom" est obligatoire</span>
                </div>
                <div class="relative z-0 w-full mb-0">
                    <select name="secteur" id="HeadlineAct" class="display:inline-block w-1/2 mt-5 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                        <option value="">Choisir ...</option>
                        <option value="IT">Technologie de l'information (IT)</option>
                        <option value="SB">Santé et biotechnologie</option>
                        <option value="ERN">Énergie et ressources naturelles</option>
                        <option value="FA">Finance et assurance</option>
                        <option value="IMMO">Construction et immobilier</option>
                        <option value="COM">Commerce de détail et e-commerce</option>
                        <option value="IM">Industrie manufacturière</option>
                        <option value="AGRO">Agroalimentaire</option>
                        <option value="TH">Tourisme et hôtellerie</option>
                        <option value="EF">Éducation et formation</option>
                    </select>
                    <input autocomplete="off" type="text" name="secteur" placeholder="Autres..." class="pt-3 pb-2 block w-fit px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200 text-xs">
                    <label for="name" class="absolute display:inline-block w-1/2 duration-300 top-3 -z-1 origin-0 text-xl text-gray-500">Secteur Entreprise: </label>
                    <br>
                    <span class="text-sm text-red-600 hidden" id="error">Veuillez sélectionner ou renseigner un secteur</span>
                </div>
                <div class="relative z-0 w-full mb-5">
                    <input autocomplete="off" type="text" name="adresse" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="email" class="absolute duration-300 top-0 -z-1 origin-0 text-gray-500">Siège Social</label>
                    <span class="text-sm text-red-600 hidden" id="error">Le Champ "Adresse" est obligatoire</span>
                </div>
                <div class="relative z-0 w-full mb-5">
                    <input autocomplete="off" type="text" name="telephone" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Téléphone</label>
                    <span class="text-sm text-red-600 hidden" id="error">Le Champ "Téléphone" est obligatoire</span>
                </div>
                <div class="relative z-0 w-full mb-5">
                    <input autocomplete="off" type="email" name="email" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Email@entreprise.com</label>
                    <span class="text-sm text-red-600 hidden" id="error">Le Champ "Email" est obligatoire</span>
                </div>
                <div class="relative z-0 w-full mb-5">
                    <input autocomplete="off" type="password" name="motdepasse" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">MOT DE PASSE</label>
                    <span class="text-sm text-red-600 hidden" id="error">Le Champ "MOT DE PASSE" est obligatoire</span>
                </div>



                <!--<div class="flex flex-row space-x-4">
          <div class="relative z-0 w-full mb-5">
            <input type="text" name="date" placeholder=" " onclick="this.setAttribute('type', 'date');" class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
            <label for="date" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Date</label>
            <span class="text-sm text-red-600 hidden" id="error">Date is required</span>
          </div>
          <div class="relative z-0 w-full">
            <input type="text" name="time" placeholder=" " onclick="this.setAttribute('type', 'time');" class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
            <label for="time" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Time</label>
            <span class="text-sm text-red-600 hidden" id="error">Time is required</span>
          </div>
        </div>

        <div class="relative z-0 w-full mb-5">
          <input type="number" name="money" placeholder=" " class="pt-3 pb-2 pl-10 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
          <div class="absolute top-0 left-0 mt-3 ml-1 text-gray-400">CFA</div>
          <label for="money" class="absolute duration-300 top-3 left-15 -z-1 origin-0 text-gray-500">Amount</label>
          <span class="text-sm text-red-600 hidden" id="error">Amount is required</span>
        </div>-->

                <!--<div class="relative z-0 w-full mb-5">
          <input type="text" name="duration" placeholder=" " class="pt-3 pb-2 pr-12 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
          <div class="absolute top-0 right-0 mt-3 mr-4 text-gray-400">min</div>
          <label for="duration" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Duration</label>
          <span class="text-sm text-red-600 hidden" id="error">Duration is required</span>
        </div>
-->
                <button id="button" name="enregistrer" type="submit" class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-950 hover:bg-blue-500 hover:shadow-lg focus:outline-none">
                    S'INSCRIRE
                </button>
                <p class="mt-5 text-center">Déjà un compte ? <a class="text-sky-500 text-center font-bold underline" href="index.php">connectez-vous ici</a></p>
            </form>
        </div>
    </div>

    <script>
        'use strict'

        document.getElementById('button').addEventListener('click', toggleError)
        const errMessages = document.querySelectorAll('#error')

        function toggleError() {
            // Show error message
            errMessages.forEach((el) => {
                el.classList.toggle('hidden')
            })

            // Highlight input and label with red
            const allBorders = document.querySelectorAll('.border-gray-200')
            const allTexts = document.querySelectorAll('.text-gray-500')
            allBorders.forEach((el) => {
                el.classList.toggle('border-red-600')
            })
            allTexts.forEach((el) => {
                el.classList.toggle('text-red-600')
            })
        }
    </script>

</body>

</html>