<?php get_header() ?>

<!-- Condition qui vérifie si il y a des articles -->
<!-- Boucle qui affiche le contenu de nos articles -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <h1><?php the_title() ?></h1>

        <!-- Afficher l'image de preview en tête de l'article -->
        
        <p>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height: auto;">
        </p>

        <?php the_content() ?>

<?php endwhile;
endif; ?>

<!-- Fin de la boucle qui liste nos articles -->

<?php get_footer() ?>