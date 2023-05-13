<?php
session_start();
$url = $_GET['page'];
include "./includes/head.inc.html";
include "./includes/header.inc.html";
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php include "./includes/ul.inc.php" ?>
            </div>
            <div class="col">
<?php
if ($url == "add")
        include "./includes/form.inc.html";
    else if ($url == "debugging"){
        echo "<h2>Débogage</h2><br>";
            print "<pre>";
            print_r ($table);
            print "</pre>";
    }
    else if ($url == "concatenation"){
        echo "<h2>Concaténation</h2><br>";
    }
    else if ($url == "loop"){
        echo "<h2>Boucle</h2><br>";
    }
    else if ($url == "function"){
        echo "<h2>Fonction</h2><br>";
    }
    else if ($url == "del"){
        echo "<h2>Données supprimées</h2>";
    }
    else {
        echo "<a href='index.php?page=add'><button type='button' class='btn btn-primary'>Ajouter des données</button></a>";
        echo "<a type='button' class='btn btn-secondary'>Ajouter plus de données</a>";
    }
?>    
            </div>
        </div>
    </div>

</section>

<?php include "./includes/footer.inc.html" ?>