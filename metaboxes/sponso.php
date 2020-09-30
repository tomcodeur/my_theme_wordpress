<?php

// LES METADONNEES

class SponsoMetaBox
{

    const META_KEY = 'montheme_sponso';

    const NONCE = '_montheme_sponso_nonce';

    public static function register()
    {

        // Créer une metabox

        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add($postType, $post)
    {

        //Si le type de poste est post ET que l'utilsateur à le droit de publier

        if ($postType === 'post' && current_user_can('publish_posts', $post)) {
            add_meta_box(self::META_KEY, 'Contenu abonnés', [self::class, 'render'], 'post', 'side');
        }
    }

    public static function render($post)
    {
        $value = get_post_meta($post->ID, self::META_KEY, true);

        wp_nonce_field(self::NONCE, self::NONCE);

        // Ajout d'une cache à cocher (le visuel dans le pannel admin)

        ?>
            <input type="hidden" value="0" name="<?= self::META_KEY ?>">
            <input type="checkbox" value="1" name="<?= self::META_KEY ?>" <?= $value === '1' ? 'checked' : ''?>>
            <label for="monthemesponso">Article spécial abonné</label>
        <?php

    }

    public static function save($post)
    {



        // Vérifie si la clé existe ET si la personne à le droit d'éditer/modifier la valeur

        if (

            array_key_exists(self::META_KEY, $_POST) && 
            current_user_can('publish_posts', $post) &&

            // Grâce à ça on est sur que c'est bien nous qui avons publier et non pas une personne
            // qui essai de nous faire remplir un formulaire via Wordpress (origine des donnèes et du formulaire)

            wp_verify_nonce($_POST[self::NONCE], self::NONCE)

            ) {
            if ($_POST[self::META_KEY] === '0') {
                delete_post_meta($post, self::META_KEY);
            } else {
                update_post_meta($post, self::META_KEY, 1);
            }
            
        }
    }
}
