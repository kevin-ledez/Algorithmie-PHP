<?php
$url = $_GET['page'];
include "./includes/head.inc.html";
include "./includes/header.inc.html";
?>

<section>
    <?php
    if ($url == "home")
        include "";
    else if ($url == "debugging")
        include "";
    else if ($url == "concatenation")
        include "";
    else if ($url == "loop")
        include "";
    else if ($url == "fonction")
        include "";
    else if ($url == "del")
        include "";
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">Home</a>
                    <a href="#" class="list-group-item list-group-item-action">Débogage</a>
                    <a href="#" class="list-group-item list-group-item-action">Concaténation</a>
                    <a href="#" class="list-group-item list-group-item-action">Boucle</a>
                    <a href="#" class="list-group-item list-group-item-action">Fonction</a>
                    <a href="#" class="list-group-item list-group-item-action">Supprimer</a>
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary">Ajouter des données</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-secondary">Ajouter plus de données</button>
            </div>
        </div>
    </div>

</section>

<?php include "./includes/footer.inc.html" ?>