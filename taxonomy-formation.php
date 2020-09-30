<?php get_header() ?>

<!-- Récupérer le titre de notre taxonomy -->

<h1><?= esc_html(get_queried_object()->name) ?></h1>

<!-- Récupérer la taxonomy formation, l'afficher dans un ul>li, boucler dessus pour
pouvoir visiter les articles en lien et vérifier que nous sommes sur la taxonomy avec 'active'.-->

<?php $formations = get_terms(['taxonomy' => 'formation']); ?>
<?php if(is_array($formations)): ?>
<ul class="nav nav-pills my-4">
    <?php foreach($formations as $formation): ?>
    <li class="nav-item">
        <a href="<?= get_term_link($formation) ?>" class="nav-link <?= is_tax('formation', $formation->term_id) ? 'active' : '' ?>"><?= $formation->name ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif ?>

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