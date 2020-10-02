<?php get_header() ?>

<!-- Condition qui vérifie si il y a des articles -->

<form class="mb-4">
  <div class="form-row align-items-center">
    <div class="col-sm-3 my-1">
      <input type="search" name="s" class="form-control" value="<?= get_search_query()?>" placeholder="Votre recherche">
    </div>
    <div class="col-auto my-1">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" name="sponso" id="autoSizingCheck2" <?= checked('1', get_query_var('sponso')) ?>>
        <label class="form-check-label" for="autoSizingCheck2">
         Article pour abonnés spécialement
        </label>
      </div>
    </div>
    <div class="col-auto my-1">
      <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
  </div>
</form>

<h1 class="mb-5">Résultat pour votre recherche: "<?= get_search_query()?>"</h1>

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