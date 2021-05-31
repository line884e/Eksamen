<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

<div class="pil">
    <a href="http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/podcast/"><img src=" <?php echo get_stylesheet_directory_uri(); ?>/pil.png" alt="pil" class="pil"></a>
</div>

<section id="episode">
    <br>
    <article class="peter">
        <div class="col3">
            <img src="" alt="">
        </div>
        <div class="col4">
            <p class="udgivelsesdato"></p>
            <a href="https://www.apple.com/itunes/"><img src="" alt="" class="itunes"></a>
            <a href="https://open.spotify.com/"><img src="" alt="" class="spotify"></a>
            <a href="https://podcasts.google.com/"><img src="" alt="" class="google"></a>
            <a href="https://podimo.com/dk"><img src="" alt="" class="podimo"></a>
            <h2></h2>
            <p class="beskrivelse_episode"></p>
            <p class="afsnit"></p>
            <p class="vearter"></p>
            <p class="varighed"></p>
        </div>
    </article>
</section>

<script>
    let episode;
    let aktuelepisode = <?php echo get_the_ID()?>;

    const episodeUrl = "http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/wp-json/wp/v2/episoder/" + aktuelepisode;

    const container = document.querySelector("#episode");

    async function getJson() {
        const data = await fetch(episodeUrl);
        episode = await data.json();
        console.log("episode: ", episode);

        visEpisode();
    }

    function visEpisode() {
        console.log("visEpisode");
        document.querySelector("h2").innerHTML = episode.title.rendered;
        document.querySelector(".peter img").src = episode.billede.guid;
        document.querySelector(".beskrivelse_episode").innerHTML = episode.beskrivelse_episode;
        document.querySelector(".vearter").innerHTML = "<b>Værter: </b>" + episode.vearter;
        document.querySelector(".afsnit").innerHTML = "<b>Afsnit: </b>" + episode.afsnit;
        document.querySelector(".varighed").innerHTML = "<b>Varighed: </b>" + episode.varighed + "min";
        document.querySelector(".udgivelsesdato").innerHTML = "<b>Dato: </b>" + episode.udgivelsesdato;
        document.querySelector(".col3 img").src = episode.billede.guid;
        document.querySelector(".itunes").src = episode.itunes.guid;
        document.querySelector(".spotify").src = episode.spotify.guid;
        document.querySelector(".google").src = episode.google.guid;
        document.querySelector(".podimo").src = episode.podimo.guid;

    }

    getJson();

</script>
<?php
get_footer();
