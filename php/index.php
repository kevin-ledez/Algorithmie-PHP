<?php
session_start();
$table = $_SESSION['table'];
include "./includes/head.inc.html";
include "./includes/header.inc.html";
?>

<section>
    <div class="container">
        <?php print_r($_SESSION); ?>
        <div class="row">
            <div class="col">
                <?php include "./includes/ul.inc.php" ?>
            </div>
            <div class="col">
<?php
    if (isset($_GET['add'])){
        include "./includes/form.inc.html";
    }else if (isset($_POST['register_data'])){
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $age = $_POST['age'];
        $taille = $_POST['taille'];
        $genre = $_POST['genre'];

        $table = array(
            'first_name' => $prenom,
            'last_name' => $nom,
            'age' => $age,
            'size' => $taille,
            'genre' => $genre,
        );
        $_SESSION['table'] = $table;
        echo "<h2>Données sauvegardées</h2>";
    }
    else if (isset($_GET['debugging'])){
        echo "<h2>Débogage</h2><br>";
            print "<pre>";
            print_r ($table);
            print "</pre>";
    }
    else if (isset($_GET['concatenation'])){
        echo "<h2>Concaténation</h2><br>";
    }
    else if (isset($_GET['loop'])){
        echo "<h2>Boucle</h2><br>";
    }
    else if (isset($_GET['function'])){
        echo "<h2>Fonction</h2><br>";
    }
    else if (isset($_GET['del'])){
        unset($_SESSION['table']);
        echo "<h2>Données supprimées</h2>";
    }
    else {
        echo "<a href='index.php?add'><button type='button' class='btn btn-primary'>Ajouter des données</button></a>";
        echo "<a type='button' class='btn btn-secondary'>Ajouter plus de données</a>";
    }
?>    
            </div>
        </div>
    </div>

</section>

<?php include "./includes/footer.inc.html" ?>