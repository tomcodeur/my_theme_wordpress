<!-- Création d'un widget YouTube -->

<?php
class YoutubeWidget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('youtube_widget', 'Youtube Widget');
    }

    public function widget($args, $instance)
    {

        echo $args['before_widget'];

        if (isset($instance['title'])) {

            $title = apply_filters('widget_title', $instance['title']);
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $youtube = isset($instance['youtube']) ? $instance['youtube'] : '';

        echo '<iframe width="300" height="200" src="https://www.youtube.com/embed/' . esc_attr($youtube) . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

        echo $args['after_widget'];
    }

    public function form($instance)
    {

        $title = isset($instance['title']) ? $instance['title'] : '';

        $youtube = isset($instance['youtube']) ? $instance['youtube'] : '';

?>

        <p>

            <!--Ici on récupère l'id, le nom du Widget -->

            <label for="<?= $this->get_field_id('title') ?>">Titre</label>

            <input class="widefat" type="text" name="<?= $this->get_field_name('title') ?>" value="<?= esc_attr($title) ?>" id="<?= $this->get_field_name('title') ?>">
        </p>

        <p>

            <label for="<?= $this->get_field_id('youtube') ?>">Id Youtube</label>

            <input class="widefat" type="text" name="<?= $this->get_field_name('youtube') ?>" value="<?= esc_attr($youtube) ?>" id="<?= $this->get_field_name('youtube') ?>">
        </p>

<?php
    }

    // Ici on traite les informations qui on été rentrées dans le champ du dessus

    public function update($newInstance, $oldInstance)
    {

        return ['title' => $newInstance['title'], 'youtube' => $newInstance['youtube']];
    }
}
