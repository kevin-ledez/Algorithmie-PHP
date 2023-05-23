<?php
session_start();
include "./includes/head.inc.html";
include "./includes/header.inc.html";
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="index.php" class="list-group-item list-group-item-action" aria-current="true">Home</a>
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
    }
    else if (isset($_GET['addmore'])){
        include "./includes/form2.inc.php";
    }
    else if (isset($_POST['register_data']) || isset($_POST['register_data_more'])){
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $age = $_POST['age'];
        $taille = $_POST['taille'];
        $civility = $_POST['civility'];
        $color = isset($_POST['color']) ? $_POST['color'] : '';
        $html = isset($_POST['html']) ? $_POST['html'] : '';
        $css =  isset($_POST['css']) ? $_POST['css'] : '';
        $javascript = isset($_POST['javascript']) ? $_POST['javascript'] : '';
        $php = isset($_POST['php']) ? $_POST['php'] : '';
        $mysql = isset($_POST['mysql']) ? $_POST['mysql'] : '';
        $bootstrap = isset($_POST['bootstrap']) ? $_POST['bootstrap'] : '';
        $symfony = isset($_POST['symfony']) ? $_POST['symfony'] : '';
        $react = isset($_POST['react']) ? $_POST['react'] : '';
        $dob = isset($_POST['dob']) ? $_POST['dob'] : '';

        $filepath = 'uploaded/' . $_FILES['image']['name'];
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $filepath)) {
            echo '<div class="alert alert-success text-center" role="alert">';
            echo "Image enregistrée";
            echo '</div>';
        }else{
            echo "Image non enregistrée";
        }

        $extension = pathinfo($filepath, PATHINFO_EXTENSION);
        $weight = filesize($filepath);
        $name = pathinfo($filepath, PATHINFO_FILENAME);
        $tempname = $_FILES['image']['tmp_name'];
        $imgor = $_FILES['image']['error'];

        $table = array(
            'first_name' => $prenom,
            'last_name' => $nom,
            'age' => $age,
            'size' => $taille,
            'civility' => $civility,
            'color' => $color,
            'html' => $html,
            'css' => $css,
            'javascript' => $javascript,
            'php' => $php,
            'mysql' => $mysql,
            'bootstrap' => $bootstrap,
            'symfony' => $symfony,
            'react' => $react,
            'dob' => $dob,
            'img' => array(
                'name' => $name,
                'type' => $extension,
                'tmpname' => $tempname,
                'error' => $imgor,
                'weight' => $weight,
            )
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
            print_r(array_filter($table));
            print "</pre>";
    }
    else if (isset($_GET['concatenation'])){
        echo "<h2>Concaténation</h2>";
        echo "===> Construction d'une phrase avec le contenu du tableau<br>";
        echo readSex($table)." ".$table['first_name']." ".$table['last_name']."<br>";
        echo "J'ai ".$table['age']." ans et je mesure ".$table['size']." m.<br><br>";

        echo "===> Construction d'une phrase après MAJ du tableau<br>";
        $table['first_name'] = ucfirst($table['first_name']);
        $table['last_name'] = strtoupper($table['last_name']);
        echo readSex($table)." ".$table['first_name']." ".$table['last_name']."<br>";
        echo "J'ai ".$table['age']." ans et je mesure ".$table['size']." m.<br><br>";
        
        echo "===> Affichage d'une virgule à la place du point pour la taille<br>";
        $table['size'] = str_replace('.',',',$table['size']);
        echo readSex($table)." ".$table['first_name']." ".$table['last_name']."<br>";
        echo "J'ai ".$table['age']." ans et je mesure ".$table['size']." m.<br><br>";
    }
    else if (isset($_GET['loop'])){
        echo "<h2>Boucle</h2>";
        echo "===> Lecture du tableau à l'aide d'une boucle foreach()<br><br>";
        $x = 0;
        foreach ($table as $key => $value) {
            echo '<p>à la ligne n°'.$x++.' corresponds à clé "'.$key.'" et valeur "'.$value.'"</p>';
        }
    }
    else if (isset($_GET['function'])){
        echo "<h2>Fonction</h2>";
        echo "===> J'utilise ma fonction readTable()<br><br>";
        readTable($table);
        echo "<img src='uploaded/".$table['img']['name'].".".$table['img']['type']."' alt='image'>";
    }
    else if (isset($_GET['del'])){
        unset($_SESSION['table']);
        echo '<div class="alert alert-success text-center" role="alert">';
        echo "Données supprimées";
        echo '</div>';
    }
    else {
        echo "<a href='index.php?add'><button type='button' class='btn btn-primary'>Ajouter des données</button></a>";
        echo "<a href='index.php?addmore'><button type='button' class='btn btn-secondary'>Ajouter plus de données</button></a>";
    }

    function readTable($table){
        $x = 0;
        foreach ($table as $key => $value) {
            echo '<p>à la ligne n°'.$x++.' corresponds à clé "'.$key.'" et valeur "'.$value.'"</p>';
        }
    }

    function readSex($table){
        if ($table['civility'] == 'homme') {
            echo "Mr";
        }else{
            echo "Mme";
        }
    }
?>
            </div>
        </div>
    </div>
</section>

<?php include "./includes/footer.inc.html" ?>