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
        <a href="http://up2create.dk/kea/2-semester/eksamen/wordpress/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/pil.png" alt="pil" class="pil"></a>
    </div>
    <h1 id="overskrift">Produkt</h1>
</div>


<!--template-->
<template>
    <article class="produkt_article">
        <img src="" alt="">
        <div>
            <h2></h2>
            <h3></h3>
        </div>
        <p></p>
    </article>
</template>

<section id="primary" class="content-area">
    <main id="main" class="site-main">
        <nav id="filtrering"><button data-produkt="alle" class="valgt">Alle</button></nav>
        <section id="produktcontainer">
        </section>
    </main>

    <button onclick="topFunction()" id="myBtn" title="Go to top">Gå til top</button>

    <!--script-->
    <script>
        let produkter;
        let categories;
        let filterProdukt = "alle";
        const dbUrl = "http://up2create.dk/kea/2-semester/eksamen/wordpress/wp-json/wp/v2/produkter?per_page=100";
        const catUrl = "http://up2create.dk/kea/2-semester/eksamen/wordpress/wp-json/wp/v2/categories";

        async function getJson() {
            console.log("getJson");
            const data = await fetch(dbUrl);
            const catdata = await fetch(catUrl);
            produkter = await data.json();
            categories = await catdata.json();
            console.log(categories)
            visProdukter();
            opretKnapper();
        }

        function opretKnapper() {
            console.log("opretKnapper");

            categories.forEach(cat => {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-produkt="${cat.id}">${cat.name}</button>`
            })

            addEventListenerToButtons();
        }

        function addEventListenerToButtons() {
            document.querySelectorAll("#filtrering button").forEach(elm => {
                elm.addEventListener("click", filtrering);
            })
        };

        function filtrering() {
            filterProdukt = this.dataset.produkt;
            document.querySelector(".valgt").classList.remove("valgt");
            this.classList.add("valgt");

            console.log(filterProdukt);

            visProdukter();
        }



        function visProdukter() {
            console.log("visProdukter");
            let temp = document.querySelector("template");
            let container = document.querySelector("#produktcontainer");
            container.innerHTML = "";
            produkter.forEach(produkt => {

                if (filterProdukt == "alle" || produkt.categories.includes(parseInt(filterProdukt))) {

                    let klon = temp.cloneNode(true).content;
                    console.log("KLON", klon);
                    klon.querySelector("h2").innerHTML = produkt.title.rendered;
                    klon.querySelector("img").src = produkt.billede.guid;
                    klon.querySelector("h3").innerHTML = produkt.beskrivelse_produkt;
                    klon.querySelector("p").innerHTML = produkt.pris + "kr";
                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = produkt.link;
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
