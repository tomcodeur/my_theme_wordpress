<?php

// Ajout d'une option dans la partie Réglage du panel admin de Wordpress

class EcoleMenuPage {

    const GROUP = 'ecole_options';

    public static function register () {

        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);

    }

    public static function registerSettings() {

        register_setting(self::GROUP, 'ecole_horaire');

        add_settings_section('ecole_options_section', 'Paramètres', function () {

            echo "Ici vous allez pouvoir gérer les options liées à votre école.";

        }, self::GROUP);

        add_settings_field('ecole_options_horaire', "Horaire d'ouverture", function () {

            ?>

            <textarea name="ecole_horaire" cols="10" rows="10" style="width: 500px">
            
                <?= get_option('ecole_horaire') ?>
            
            </textarea>

            <?php

        }, self::GROUP, 'ecole_options_section');

    }

    public static function addMenu ()
    {
        add_options_page("Gestion de l'école", "École", "manage_options", self::GROUP, [self::class, 'render']);
    }

    public static function render() {

        ?>

        <h1>Gestion de l'école</h1>



        <form action="options.php" method="post">

            <?php   
                    settings_fields(self::GROUP);
                    do_settings_sections(self::GROUP);
                    submit_button('Sauvegarder'); 
            ?>

        </form>

        <?php

    }
}