<!-- Création du footer avec récupération de la fin du code de base HTML -->
</div>

<footer>

        <?php wp_nav_menu([
                'theme_location' => 'footer', 
                'container' => false,
                'menu_class' => 'text-center',
        ]) ?>

</footer>

<div>

      <?= get_option('ecole_horaire'); ?>

</div>

        <!-- Récupération de la barre admin sombre de Wordpress, il faut wp_head et wp_footer. -->
        <?php wp_footer() ?> 

</body>
</html>