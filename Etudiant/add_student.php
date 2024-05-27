<?php
global $title;
require_once "../config.php";
require_once "../Controller/students_services.php";
$tabErrors = [
  "nom" => "Le chaamp 'Nom' est ",
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
  $firstname = $_POST['prenom'];
  $email = verifyEmailStudents($_POST['email']) ? $email = $_POST['email'] : null;
  $password = $_POST['motdepasse'];
  $phone = verifyPhoneStudents($_POST['telephone']) ? $phone = $_POST['telephone'] : null;
  $level = $_POST['niveau'];
  $speciality = $_POST['specialite'];
  $informations = [$name, $firstname, $email, $password, $phone, $level, $speciality];
  if (!in_array(null, $informations)) {
    $student = add_student($name, $firstname, $email, $password, $phone, $level, $speciality);
    if ($student) {
      require_once "../success.php";
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
      <h1 class="text-2xl text-center font-bold mb-8 underline">Formulaire Ajout Etudiant</h1>
      <form id="form" novalidate method="post">
        <div class="relative z-0 w-full mb-5">
          <input type="text" name="nom" placeholder=" " required class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
          <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Nom Etudiant</label>
          <span class="text-sm text-red-600 hidden" id="error">Le Champ "Nom" est obligatoire</span>
        </div>
        <div class="relative z-0 w-full mb-5">
          <input type="text" name="prenom" placeholder=" " required class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
          <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Prénom Etudiant</label>
          <span class="text-sm text-red-600 hidden" id="error">Le Champ "Prénom" est obligatoire</span>
        </div>
        <div class="relative z-0 w-full mb-5">
          <input autocomplete="off" type="email" name="email" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
          <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Email@groupeisi.com</label>
          <span class="text-sm text-red-600 hidden" id="error">Le Champ "Email" est obligatoire</span>
        </div>
        <div class="relative z-0 w-full mb-5">
          <input type="password" name="motdepasse" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
          <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Mot de passe</label>
          <span class="text-sm text-red-600 hidden" id="error">Le Champ "Mot de passe" est obligatoire</span>
        </div>
        <div class="relative z-0 w-full mb-5">
          <input type="email" name="telephone" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
          <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Téléphone Etudiant</label>
          <span class="text-sm text-red-600 hidden" id="error">Le Champ "Téléphone" est obligatoire</span>
        </div>


        <div class="relative z-0 w-full mb-5">
          <select name="niveau" value="" onclick="this.setAttribute('value', this.value);" class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
            <option value="" selected disabled hidden></option>
            <option value="L1">Licence 1</option>
            <option value="L2">Licence 2</option>
            <option value="L3">Licence 3</option>
            <option value="M1">Master 1</option>
            <option value="M2">Master 2</option>
          </select>
          <label for="select" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Choisir le niveau</label>
          <span class="text-sm text-red-600 hidden" id="error">Veuillez sélectionner un niveau</span>
        </div>
        <div class="relative z-0 w-full mb-5">
          <select name="specialite" value="" onclick="this.setAttribute('value', this.value);" class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
            <option value="" selected disabled hidden></option>
            <option value="GL">Génie Logiciel</option>
            <option value="RI">Réseaux Informatiques</option>
            <option value="RT">Réseaux Telecoms</option>
            <option value="IAGE">Informatique Appliquée à la Gestion des Entreprises</option>
            <option value="CS">Cybersécurité</option>
          </select>
          <label for="select" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Choisir la filière</label>
          <span class="text-sm text-red-600 hidden" id="error">Veuillez sélectionner une filière</span>
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