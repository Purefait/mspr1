<?php

//On se connecte à la base de données
//Ce fichier nous crée une variable $conn
include("config/config.php");
//récupérer les 10 articles publiés les plus récent

$sql = "SELECT *
			FROM posts
			ORDER BY date_created DESC
			LIMIT 10";

//envoie notre requête au serveur MySQL, sans l'éxecuter
$stmt = $conn->prepare($sql);
//exécute la requête
$stmt->execute();
//nous retourne les résultats
$posts = $stmt->fetchall();

//var_dump($posts);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chaos Blog | Le repaire des GJs</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
<header>
    <h1> Chaos Blog | Le repaire des GJs </h1>
    <nav>
        <a href="pubier-article.php">Publier un article</a>
    </nav>
</header>
<main>
    <section>
        <h2> Nos 10 derniers articles </h2>
        <?php
        // affichez les articles ici!
        foreach($posts as $post){

            $date = date("d-m-Y H:i", strtotime($post['date_created']));
            /*
            //affichage du titre, summary,
            //date_created au format français et clap_number
            echo '<article>';
            echo '<h3>' . $post['title'] . '</h3>';
            echo '<p>' . $date . '</p>';
            echo '<div>' . $post['summary'] . '</div>';
            echo '<div>' . $post['clap_number'] . 'applaudissements ! </div>';
            echo '<br>';
            echo '</article>';
            */

            ?>
            <article>
                <h3><?php echo $post['body']; ?></h3>
                <p class="date"><?php echo $date; ?></p>
                <div><?php echo $post['added_by']; ?></div>


            </article>
            <?php
        }
        ?>
    </section>
</main>

<footer>
    &copy; 2018| Gilets Jaunes inc.
</footer>
</body>
</html>