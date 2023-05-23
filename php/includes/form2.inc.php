<form action="index.php" method="POST" enctype="multipart/form-data">
    <div class="d-flex justify-content-center">
        <div class="col-md-7 mx-auto my-1">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom">
                <label for="floatingInput">Prénom</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
                <label for="floatingInput">Nom</label>
            </div>
            <div class="mb-3">
                <label for="form-label">Age (18 à 70 ans)</label>
                <input min="18" max="70" type="number" class="form-control" name="age" id="age" placeholder="Renseignez votre âge">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Taille (entre 1,26 et 3m)</span>
                <input type="number" min="1.26" max="3" step="0.01" name="taille" aria-label="First name" class="form-control">
                <span class="input-group-text">m</span>
            </div>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="civility" id="homme" value="homme" checked>
                    <label class="form-check-label" for="gridRadios1">Homme</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="civility" id="femme" value="femme">
                    <label class="form-check-label" for="gridRadios2">Femme</label>
                </div>
                <div class="mb-3">
                <label for="form-label">Couleur préférée</label>
                <input type="color" class="form-control" name="color" id="color" value="#000000">
            </div>
            </div>
        </div>

        <div class="col-md-4 mx-auto my-1">
            <p>Connaissances</p>
            <div class="">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="html" id="html" value="html">
                    <label class="form-check-label" for="flexCheckChecked">HTML</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="css" id="css" value="css">
                    <label class="form-check-label" for="flexCheckChecked">CSS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="javascript" id="javascript" value="javascript">
                    <label class="form-check-label" for="flexCheckChecked">Javascript</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="php" id="php" value="php">
                    <label class="form-check-label" for="flexCheckChecked">PHP</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="mysql" id="mysql" value="mysql">
                    <label class="form-check-label" for="flexCheckChecked">MySQL</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="bootstrap" id="bootstrap" value="bootstrap">
                    <label class="form-check-label" for="flexCheckChecked">Bootstrap</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="symfony" id="symfony" value="symfony">
                    <label class="form-check-label" for="flexCheckChecked">Symfony</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="react" id="react" value="react">
                    <label class="form-check-label" for="flexCheckChecked">React</label>
                </div>
            </div>
            <label for="start">Date de naissance</label>
            <input type="date" name="dob" value="2000-01-01">
        </div>
    </div>

    <div class="col-md-11 mx-auto my-1">
        <div class="mb-3">
            <label for="formFile" class="form-label">Joindre une image (jpg ou png)</label>
            <input class="form-control" type="file" name="image" id="image">
        </div>
    </div>
    <button type="submit" class="btn btn-primary" name="register_data_more">Enregistrer les données</button>
</form>