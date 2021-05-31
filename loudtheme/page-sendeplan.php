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

        <div class="inline">
            <div class="pil">
                <a href="http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/pil.png" alt="pil" class="pil"></a>
            </div>
            <h1 id="overskrift">Sendeplan</h1>
        </div>

        <!--template-->
        <template>
            <div class="container">
                <article class="article_sendeplan">
                    <div class="col5">
                        <img src="" alt="">
                    </div>
                    <div class="col6">
                        <h2></h2>
                    </div>
                </article>
            </div>
        </template>

        <section id="primary" class="content-area">
            <main id="main" class="site-main">
                <nav id="filtrering"><button data-sendeplan_dag="alle" class="valgt">Alle</button></nav>
                <section id="sendeplancontainer">
                </section>
            </main>

            <button onclick="topFunction()" id="myBtn" title="Go to top">Gå til top</button>
            <!--script-->
            <script>
                let sendeplan_dage;
                let episoder;
                let filterEpisoder = "alle";

                const dbUrl = "http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/wp-json/wp/v2/episoder?per_page=100";
                const catUrl = "http://thethirdolsentwin.dk/kea/2-semester/tema9/loud/wordpress/wp-json/wp/v2/sendeplan_dag";

                async function getJson() {
                    console.log("getJson");
                    const data = await fetch(dbUrl);
                    const catdata = await fetch(catUrl);
                    episoder = await data.json();
                    sendeplan_dage = await catdata.json();
                    console.log(sendeplan_dage)
                    visEpisoder();
                    opretKnapper();
                }

                function opretKnapper() {
                    console.log("opretKnapper");

                    sendeplan_dage.forEach(plan => {
                        document.querySelector("#filtrering").innerHTML += `<button class="filter" data-sendeplan_dag="${plan.id}">${plan.name}</button>`
                    })

                    addEventListenerToButtons();
                }

                function addEventListenerToButtons() {
                    document.querySelectorAll("#filtrering button").forEach(elm => {
                        elm.addEventListener("click", filtrering);
                    })
                };

                function filtrering() {
                    filterEpisoder = this.dataset.sendeplan_dag;
                    document.querySelector(".valgt").classList.remove("valgt");
                    this.classList.add("valgt");

                    console.log(filterEpisoder);

                    visEpisoder();
                }

                function visEpisoder() {
                    console.log("visEpisoder");
                    let temp = document.querySelector("template");
                    let container = document.querySelector("#sendeplancontainer");
                    container.innerHTML = "";
                    console.log("episoder: ", episoder)
                    episoder.forEach(episode => {
                        console.log("episode: ", episode)
                        console.log("filterEpisode: ", filterEpisoder)
                        if (filterEpisoder == "alle" || episode.sendeplan_dag.includes(parseInt(filterEpisoder))) {

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

    </main>
</div>

<?php
get_footer();
