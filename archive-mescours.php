<?php get_header() ?>

<h1 class="my-4">Voici la liste de mes cours</h1>

<!-- Condition qui vérifie si il y a des articles -->

<?php if (have_posts()) : ?>

    <div class="row">

        <!-- Boucle qui charge la liste de nos articles -->

        <?php while (have_posts()) : the_post(); ?>

            <div class="col-sm-4">

              <?php get_template_part('parts/card', 'post'); ?>

            </div>

        <?php endwhile ?>

    </div>

    <!-- Fonction de pagination créer dans functions.php -->

    <?php montheme_pagination() ?>

<?php else : ?>

    <h1>Pas d'articles</h1>

<?php endif; ?>

<!-- Fin de la boucle qui liste nos articles -->

<?php get_footer() ?>