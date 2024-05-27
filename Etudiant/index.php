<?php
global $title;
require_once "../config.php";
require_once "../Controller/students_services.php";
if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $password = $_POST['motdepasse'];
    login_student($email, $password);
    if (!empty($_SESSION['etu'])) {
        header("Location: home.php");
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

<body class="bg-midnight">

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

    <div class="bg-gray-300 p-0 sm:p-20">
        <div class="mx-auto max-w-md px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl mt-20">
            <h1 class="text-2xl text-center font-bold mb-8 underline">Formulaire Connexion</h1>
            <form id="form" novalidate method="post">
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

                <button id="button" name="connexion" type="submit" class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-950 hover:bg-blue-500 hover:shadow-lg focus:outline-none">
                    SE CONNECTER
                </button>
                <p class="mt-5 text-center">Pas encore inscrit ? <a class="text-sky-500 text-center font-bold underline" href="add_student.php">inscrivez-vous ici</a></p>
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