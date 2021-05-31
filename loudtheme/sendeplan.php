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

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <div class="pil">
            <img src="pil.png" alt="pil">
        </div>

        <h1 id="overskrift">Sendeplan</h1>

        <!--template-->
        <template>
            <article class="article_sendeplan">
                <div class="col5">
                    <img src="" alt="">
                </div>
                <div class="col6">
                    <h2></h2>
                </div>
            </article>
        </template>

        <section id="primary" class="content-area">
            <main id="main" class="site-main">
                <nav id="filtrering"></nav>
                <section id="sendeplancontainer">
                </section>
            </main>

            <!--script-->
            <script>
                let sendeplan_dag;
                let episoder;

                const dbUrl = "http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/wp-json/wp/v2/episoder?per_page=100";
                const catUrl = "http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/wp-json/wp/v2/sendeplan";

                async function getJson() {
                    console.log("getJson");
                    const data = await fetch(dbUrl);
                    const catdata = await fetch(catUrl);
                    episoder = await data.json();
                    sendeplan_dag = await catdata.json();
                    console.log(sendeplan_dag)
                    visEpisoder();
                    opretKnapper();
                }

                function opretKnapper() {
                    console.log("opretKnapper");

                    sendeplan_dag.forEach(plan => {
                        document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${plan.id}">${plan.name}</button>`
                    })

                    addEventListenerToButtons();
                }

                function addEventListenerToButtons() {
                    document.querySelectorAll("#filtrering button").forEach(elm => {
                        elm.addEventListener("click", filtrering);
                    })
                };

                function filtrering() {
                    filterPodcast = this.dataset.episoder;
                    document.querySelector(".valgt").classList.remove("valgt");
                    this.classList.add("valgt");

                    console.log(filterEpisoder);

                    visEpisoder();
                }

                function visEpisoder() {
                    console.log("visPodcasts");
                    let temp = document.querySelector("template");
                    let container = document.querySelector("#sendeplancontainer");
                    container.innerHTML = "";
                    episoder.forEach(episode => {

                        if (filterPodcast == "alle" || episode.sendeplan_dag.includes(parseInt(filterEpisode))) {

                            let klon = temp.cloneNode(true).content;
                            console.log("KLON", klon);
                            klon.querySelector("h2").innerHTML = episode.title.rendered;
                            klon.querySelector("img").src = episode.billede.guid;
                            klon.querySelector("article").addEventListener("click", () => {
                                location.href = episode.link;
                            })
                            container.appendChild(klon);
                        }
                    })
                };

                getJson();

            </script>
        </section>

    </main>
</div>

<?php
get_footer();
