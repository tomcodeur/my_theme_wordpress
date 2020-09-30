<div class="card">

    <!-- Affiche l'image avec la class de Bootstrap -->

    <?php the_post_thumbnail('card-header', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;']) ?>

    <!-- Fin image -->

    <div class="card-body">
        <h5 class="card-title"><?php the_title() ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>

        <?php
        the_terms(get_the_ID(), 'formation', '<li>', '</li><li>', '</li>');
        ?>

        <p class="card-text"><?php the_excerpt() ?></p>
        <a href="<?php the_permalink() ?>" class="card-link">Voir cet article</a>
    </div>
</div>