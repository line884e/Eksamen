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

<div class="inline">
    <div class="pil">
        <a href="http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/pil.png" alt="pil" class="pil"></a>
    </div>
    <h1 id="overskrift">Podcast</h1>
</div>

<p class="podcast_tekst">Radio LOUD har omkring 108 podcasts og der kommer hele tiden flere til. Om du er til krimi, kærlighed eller kultur og samfund, så er der lidt til enhver smag. Få rengøringen klaret hurtigere eller læn dig tilbage og nyd den ellers kedelige togtur med en spændende/hyggelig/sjov/lærerig podcast i ørerne. Du kan nemlig høre vores podcast hvor og hvornår du vil på de mest populære tjenester.</p>

<!--template-->
<template>
    <article class="podcast_article">
        <img src="" alt="">
        <div>
            <h2></h2>
        </div>
    </article>
</template>

<section id="primary" class="content-area">
    <main id="main" class="site-main">
        <nav id="filtrering"><button data-podcast="alle" class="valgt">Alle</button></nav>
        <section id="podcastcontainer">
        </section>
    </main>

    <button onclick="topFunction()" id="myBtn" title="Go to top">Gå til top</button>

    <!--script-->
    <script>
        let podcasts;
        let categories;
        let filterPodcast = "alle";
        const dbUrl = "http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/wp-json/wp/v2/podcasts?per_page=100";
        const catUrl = "http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/wp-json/wp/v2/categories";

        async function getJson() {
            console.log("getJson");
            const data = await fetch(dbUrl);
            const catdata = await fetch(catUrl);
            podcasts = await data.json();
            categories = await catdata.json();
            console.log(categories)
            visPodcasts();
            opretKnapper();
        }

        function opretKnapper() {
            console.log("opretKnapper");

            categories.forEach(cat => {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`
            })

            addEventListenerToButtons();
        }

        function addEventListenerToButtons() {
            document.querySelectorAll("#filtrering button").forEach(elm => {
                elm.addEventListener("click", filtrering);
            })
        };

        function filtrering() {
            filterPodcast = this.dataset.podcast;
            document.querySelector(".valgt").classList.remove("valgt");
            this.classList.add("valgt");

            console.log(filterPodcast);

            visPodcasts();
        }

        function visPodcasts() {
            console.log("visPodcasts");
            let temp = document.querySelector("template");
            let container = document.querySelector("#podcastcontainer");
            container.innerHTML = "";
            podcasts.forEach(podcast => {

                if (filterPodcast == "alle" || podcast.categories.includes(parseInt(filterPodcast))) {

                    let klon = temp.cloneNode(true).content;
                    console.log("KLON", klon);
                    klon.querySelector("h2").innerHTML = podcast.title.rendered;
                    klon.querySelector("img").src = podcast.billede.guid;
                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = podcast.link;
                    })
                    container.appendChild(klon);
                }
            })
        };

        getJson();

        //GO TO TOP
        //Get the button:
        mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }

    </script>
</section>

<?php
get_footer();
?>
