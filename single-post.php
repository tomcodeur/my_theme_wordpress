<?php get_header() ?>

<!-- Condition qui vérifie si il y a des articles -->
<!-- Boucle qui affiche le contenu de nos articles -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <h1><?php the_title() ?></h1>

        <?php if(get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) === '1'): ?>
            <div class="alert alert-danger">
                Article réservé aux abonnés !
            </div>
        <?php endif ?>

        <!-- Afficher l'image de preview en tête de l'article -->
        
        <p>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height: auto;">
        </p>

        <?php the_content() ?>

        <!-- Récupération des articles en lien avec l'article en cours (avec tri) -->

            <h2>Articles relatifs</h2>

            <div class="row">

            <?php

                $formation = array_map(function ($term) {
                    
                    return $term->term_id;

                }, get_the_terms(get_post(), 'formation'));

                $query = new WP_Query([

                    'post__not_in' => [get_the_ID()],
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'rand',
                    'tax_query' => [

                        [
                            'taxonomy' => 'formation',
                            'terms' => $formation,
                        ]

                    ],

                    // Selectionner uniquemen les articles sponsorisé

                    // 'meta_query' => [

                    //     [
                    //         'key' => SponsoMetaBox::META_KEY,
                    //         'compare' => 'EXISTS',
                    //     ]

                    // ]
                    
                ]);

                while($query->have_posts()): $query->the_post();

                ?>

                    <div class="col-sm-4">

                        <?php get_template_part('parts/card', 'post'); ?>

                    </div>

                <?php endwhile; wp_reset_postdata(); ?>

            </div>

<?php endwhile;
endif; ?>

<!-- Fin de la boucle qui liste nos articles -->

<?php get_footer() ?>