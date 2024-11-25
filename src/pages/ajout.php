<?php 
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=app_gestion_presence', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
if(isset($_POST['send'])){
    if(
        !isset($_POST['prenom']) || !isset($_POST['nom']) || !isset($_POST['email']) || !isset($_POST['telephone'])
    ){
        echo 'Remplir le formulaire.';
        return;
    }
    
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
  
    $sqlQuery = 'INSERT INTO useradd(prenom, nom, email, telephone) VALUES (:prenom, :nom, :email, :telephone)';
    
    $insertRecipe = $pdo->prepare($sqlQuery);
    
    try {
        $insertRecipe->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':email' => $email,
            ':telephone' => $telephone,
        ]);
    
        echo "L'utilisateur a été ajouté avec succès !";
    
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un apprenant</title>
    <link rel="stylesheet" href="../output.css">
</head>
<body class="bg-[#BABABA]">
     <div class="container flex md:flex-row flex-col w-3/4 bg-white gap-1 mx-auto my-20">
        <form action="ajout.php" method="post" class="bg-white md:w-1/2 w-full flex flex-col md:p-6 gap-8 py-10">
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Prenom</label>
                <input 
                    type="text" 
                    class="p-3 bg-[#BABABA]"
                    name="firstNameInput" 
                    id="firstNameInput"
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Nom</label>
                <input 
                    type="text" 
                    class="p-3 bg-[#BABABA]"
                    name="lastNameInput" 
                    id="lastNameInput"
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Telephone</label>
                <input 
                    type="tel" 
                    class="p-3 bg-[#BABABA]"
                    name="telInput" 
                    id="telInput"
                >
            </div>    
            <div class="flex gap-3 mx-auto">
                <div>
                   <select name="cohorte" id="cohorte" class="border border-black p-0.5 rounded-lg">
                        <option value="cohorte1">Cohorte 1</option>
                        <option value="cohorte2">Cohorte 2</option>
                   </select>
                </div>
            </div>
            <button class="text-white md:ml-[68%] mx-auto bg-[#342E37] p-3 w-1/5" type="submit">Ajouter</button>
        </form>
        <div class="md:w-1/2 w-full p-10 bg-[#342E37] flex justify-center items-center">
            <h2 class="text-3xl font-bold text-white md:mt-28 my-28 text-center">Ajouter un apprenant</h2>
        </div>
     </div>
</body>
</html>