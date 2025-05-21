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
    try {
        $name = $_POST['nom'] ?? null;
        $secteur = $_POST['secteur'] ?? null;
        $adresse = $_POST['adresse'] ?? null;
        $email = verifyEmailEntreprise($_POST['email']) ? $_POST['email'] : null;
        $telephone = verifyPhoneEntreprise($_POST['telephone']) ? $_POST['telephone'] : null;
        $password = $_POST['motdepasse'] ?? null;

        if (is_null($name) || is_null($secteur) || is_null($adresse) || is_null($email) || is_null($telephone) || is_null($password)) {
            array_walk($GLOBALS, function ($value, $key) {
                if (is_null($value)) {
                    throw new LogicException("Le champ '$key' est obligatoire");
                }
            }, NULL, TRUE);
            throw new LogicException("Tous les champs sont obligatoires");
        }
        /* ======== AJOUT IMAGE ==========*/
        // Connexion à la base de données

        if (isset($_FILES['logo'])) {
            $image = $_FILES['logo'];

            // Vérification et sécurisation
            if ($image['error'] === 0 && $image['size'] < 5 * 1024 * 1024) { // max 5MB
                $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($ext, $allowed)) {
                    $filename = uniqid() . '.' . $ext;
                    $destination = 'uploads/' . $filename;

                    // Créer le dossier s’il n’existe pas
                    if (!is_dir('uploads')) {
                        mkdir('uploads', 0777, true);
                    }

                    if (move_uploaded_file($image['tmp_name'], $destination)) {
                        // Enregistrement dans la base de données
                        // $stmt = $pdo->prepare("INSERT INTO images (path) VALUES (:path)");
                        // $stmt->execute(['path' => $destination]);
                        $informations = [$name, $secteur, $adresse, $telephone, $email, $password];
                        $entreprise = add_entreprise($name, $secteur, $adresse, $telephone, $email, $password,$destination);
                        if ($entreprise) {
                            include_once('success.php');
                        }
                        // echo "Image uploadée avec succès !<br>";
                        // echo '<img src="' . $destination . '" width="200">';
                    } else {
                        echo "Erreur lors du déplacement du fichier.";
                    }
                } else {
                    echo "Format de fichier non autorisé.";
                }
            } else {
                echo "Fichier trop volumineux ou erreur de transfert.";
            }
        }

        /* ======== FIN AJOUT IMAGE ==========*/
    } catch (Throwable $e) {
        // Handle exception
        error_log("Exception caught in add_entreprise.php\n" . $e->getMessage() . "\n" . $e->getFile() . ':' . $e->getLine() . "\n" . $e->getTraceAsString());
        require_once('error.php');
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
            <form id="form" novalidate method="post" enctype="multipart/form-data">
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
                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Cover photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="file-upload" name="logo" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
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