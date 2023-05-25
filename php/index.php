<?php
//Démmarage de la session
session_start();

include "./includes/head.inc.html";
include "./includes/header.inc.html";
?>

<section>
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-2">
                <a href="index.php" class="list-group-item list-group-item-action" aria-current="true">Home</a>
                <!-- Affichage du menu de navigation si la session n'est pas vide -->
                <?php 
                    if (!empty($_SESSION)){
                        $table = $_SESSION['table'];
                        include "./includes/ul.inc.php";
                    }
                ?>
            </div>
            <div class="col">
<?php
    //Si URL = ADD
    if (isset($_GET['add'])){
        include "./includes/form.inc.html";
    }
    //Si URL = ADDMORE
    else if (isset($_GET['addmore'])){
        include "./includes/form2.inc.php";
    }
    //Traitement du formulaire
    else if (isset($_POST['register_data']) || isset($_POST['register_data_more'])){
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $age = $_POST['age'];
        $taille = $_POST['taille'];
        $civility = $_POST['civility'];
    
    if (isset($_POST['register_data_more'])){
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

        if (!is_dir('uploaded')){
            mkdir('uploaded');
        }

        //Dossier de stockage des images
        $filepath = 'uploaded/' . $_FILES['image']['name'];

        //Vérification de la taille de l'image
        $maxFileSize = 2000000; //2Mo
        $fileSize = $_FILES['image']['size'];
        if ($fileSize > $maxFileSize){
            echo '<div class="alert alert-danger text-center" role="alert">';
            echo "La taille de l'image doit être inférieure à 2Mo";
            echo '</div>';
            exit();
        }

        //Vérification du type de fichier
        $uploadExtension = array('jpg', 'jpeg', 'png', 'gif');
        $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $uploadExtension)){
            echo '<div class="alert alert-danger text-center" role="alert">';
            echo 'Extension "'.$fileExtension.'" non prise en charge';
            echo '</div>';
            echo '<div class="alert alert-danger text-center" role="alert">';
            echo "Seules les images au format jpg, jpeg, png et gif sont autorisées";
            echo '</div>';
            exit();
        }
        
        //Enregistrement de l'image dans le dossier de stockage
        if (move_uploaded_file($_FILES['image']['tmp_name'], $filepath)) {
            echo '<div class="alert alert-success text-center" role="alert">';
            echo "Image enregistrée";
            echo '</div>';
        }else{
            echo "Image non enregistrée";
        }

        //Récupération des infos de l'image envoyée
        $extension = pathinfo($filepath, PATHINFO_EXTENSION);
        $weight = filesize($filepath);
        $name = pathinfo($filepath, PATHINFO_FILENAME);
        $tempname = $_FILES['image']['tmp_name'];
        $imgor = $_FILES['image']['error'];

    }
    
    if (isset($_POST['register_data'])) {
        //Construction du tableau des données
        $table = array(
            'first_name' => $prenom,
            'last_name' => $nom,
            'age' => $age,
            'size' => $taille,
            'civility' => $civility,
        );
    }
    if (isset($_POST['register_data_more'])){
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
    }

        //Enregistrement du tableau dans la session
        $_SESSION['table'] = $table;
            echo '<div class="alert alert-success text-center" role="alert">';
            echo 'Données sauvegardées';
            echo '</div>';
    }
    //Si URL = debugging
    else if (isset($_GET['debugging'])){
        echo "<h2>Débogage</h2>";
        echo "===> Lecture du tableau à l'aide de la fonction print_r()";
            print "<pre>";
            print_r(array_filter($table));
            print "</pre>";
    }
    //Si URL = concatenation
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
    //Si URL = loop
    else if (isset($_GET['loop'])){
        echo "<h2>Boucle</h2>";
        echo "===> Lecture du tableau à l'aide d'une boucle foreach()<br><br>";
        $x = 0;
        foreach ($table as $key => $value) {
            echo '<p>à la ligne n°'.$x++.' corresponds à clé "'.$key.'" et valeur "'.$value.'"</p>';
        }
    }
    //Si URL = function
    else if (isset($_GET['function'])){
        echo "<h2>Fonction</h2>";
        echo "===> J'utilise ma fonction readTable()<br><br>";
        readTable($table);
        if (!empty($table['img'])){
            echo "<img src='uploaded/".$table['img']['name'].".".$table['img']['type']."' alt='image'>";
        }
    }
    //Si URL = del
    else if (isset($_GET['del'])){
        unset($_SESSION['table']);
        if (!empty($table['img'])){
            unlink("uploaded/".$table['img']['name'].".".$table['img']['type']);
        }
        echo '<div class="alert alert-success text-center" role="alert">';
        echo "Les données ont été supprimées ainsi que l'image !";
        echo '</div>';
    }
    //Si on n'est sur index.php
    else {
        echo "<a href='index.php?add'><button type='button' class='btn btn-primary'>Ajouter des données</button></a>";
        echo "<a href='index.php?addmore'><button type='button' class='btn btn-secondary'>Ajouter plus de données</button></a>";
    }

    //La fonction readTable()
    function readTable($table){
        $x = 0;

        if (empty($table['img'])){
            foreach ($table as $key => $value) {
                echo '<p>à la ligne n°'.$x++.' corresponds à clé "'.$key.'" et valeur "'.$value.'"</p>';
            }
        }else{
            foreach ($table as $key => $value) {
            if ($key != 'img'){
                echo '<p>à la ligne n°'.$x++.' corresponds à clé "'.$key.'" et valeur "'.$value.'"</p>';
            }
        }
        foreach ($table['img'] as $key => $value) { 
            echo '<p>à la ligne n°'.$x++.' corresponds à clé "'.$key.'" et valeur "'.$value.'"</p>';
        }
    }
}
    //La fonction readSex() (affiche le civilité Mr ou Mme)
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