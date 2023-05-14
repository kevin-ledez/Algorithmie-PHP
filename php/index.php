<?php
session_start();
include "./includes/head.inc.html";
include "./includes/header.inc.html";
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="index.php" class="list-group-item list-group-item-action active" aria-current="true">Home</a>
                <?php 
                    if (!empty($_SESSION)){
                        $table = $_SESSION['table'];
                        include "./includes/ul.inc.php";
                    }
                ?>
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
        $gender = $_POST['gender'];

        $table = array(
            'first_name' => $prenom,
            'last_name' => $nom,
            'age' => $age,
            'size' => $taille,
            'gender' => $gender,
        );
        $_SESSION['table'] = $table;
            echo '<div class="alert alert-success text-center" role="alert">';
            echo 'Données sauvegardées';
            echo '</div>';
    }
    else if (isset($_GET['debugging'])){
        echo "<h2>Débogage</h2>";
        echo "===> Lecture du tableau à l'aide de la fonction print_r()";
            print "<pre>";
            print_r ($table);
            print "</pre>";
    }
    else if (isset($_GET['concatenation'])){
        echo "<h2>Concaténation</h2>";
        echo "===> Construction d'une phrase avec le contenu du tableau";
        echo "<p>Mr ".$table['first_name']." ".$table['last_name']."<br>";
        echo "J'ai ".$table['age']." ans et je mesure ".$table['size']." m.</p>";
        echo "===> Construction d'une phrase après MAJ du tableau";
        $table['first_name'] = ucfirst($table['first_name']);
        $table['last_name'] = strtoupper($table['last_name']);
        echo "<p>Mr ".$table['first_name']." ".$table['last_name']."<br>";
        echo "J'ai ".$table['age']." ans et je mesure ".$table['size']." m.</p>";
        echo "===> Affichage d'une virgule à la place du point pour la taille";
        $table['size'] = str_replace('.',',',$table['size']);
        echo "<p>Mr ".$table['first_name']." ".$table['last_name']."<br>";
        echo "J'ai ".$table['age']." ans et je mesure ".$table['size']." m.</p>";
    }
    else if (isset($_GET['loop'])){
        echo "<h2>Boucle</h2>";
    }
    else if (isset($_GET['function'])){
        echo "<h2>Fonction</h2>";
    }
    else if (isset($_GET['del'])){
        unset($_SESSION['table']);
        echo '<div class="alert alert-success text-center" role="alert">';
        echo "Données supprimées";
        echo '</div>';
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