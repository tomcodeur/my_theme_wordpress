<?php get_header() ?>

<?php $formations = get_terms(['taxonomy' => 'formation']); ?>
<ul class="nav nav-pills my-4">
    <?php foreach($formations as $formation): ?>
    <li class="nav-item">
        <a href="<?= get_term_link($formation) ?>" class="nav-link <?= is_tax('formation', $formation->term_id) ? 'active' : '' ?>"><?= $formation->name ?></a>
    </li>
    <?php endforeach; ?>
</ul>

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