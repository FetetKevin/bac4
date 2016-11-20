<?php
if($_SESSION['logged'] && $_SESSION['nom_role'] == "admin") {
    ?>
    <div class="container">
        <div class="Navbar">
            <nav role="navigation" class="navbar navbar-default">
                <!-- Pour un affichage sur les mobiles -->
                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse2"
                            data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="admin.php" class="navbar-brand">Admin</a>
                </div>
                <!-- Collection de liens de navigatioon -->
                <div id="navbarCollapse2" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="formuAjoutRole.php">Roles</a></li>
                        <li><a href="formuAjoutAdmin.php">Users</a></li>
                        <li><a href="formuAjoutCategorie.php">Categories</a></li>
                        <li><a href="formuAjoutVideo.php">Videos</a></li>
                        <li><a href="listCommentairesAdmin.php">Liste des Commentaires</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <?php
}
else {
    header('Location: index.php?notadmin');
}
?>
