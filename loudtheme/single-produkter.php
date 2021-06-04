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
 <?php the_content(); ?>
<div class="pil">
    <a href="http://up2create.dk/kea/2-semester/eksamen/wordpress/produkt/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/pil.png" alt="pil" class="pil"></a>
</div>

<!--template-->
<section id="primary" class="content-area">
    <main id="main" class="site-main">
        <h1></h1>
        <article class="martin">
            <div class="wrapper">
                <div class="col1">
                    <h1></h1>
                    <p class="beskrivelse_produkt"></p>
                    <p class="pris"></p>
                </div>
                <div class="col2">
                    <img src="" alt="">
                </div>
            </div>
        </article>


    </main>
    </section>

    <!--script-->
    <script>
        let produkt;
        let aktuelprodukt = <?php echo get_the_ID() ?>;
        var elmnt = document.getElementById("content");

        const dbUrl = "http://up2create.dk/kea/2-semester/eksamen/wordpress/wp-json/wp/v2/produkter/" + aktuelprodukt;


        async function getJson() {
            const data = await fetch(dbUrl);
            produkt = await data.json();
            visProdukter();
        }

        function visProdukter() {
            console.log("visProdukter");
            document.querySelector("h1").innerHTML = produkt.title.rendered;
            document.querySelector(".martin img").src = produkt.billede.guid;
            document.querySelector(".beskrivelse_produkt").innerHTML = produkt.beskrivelse_produkt;
            document.querySelector(".pris").innerHTML = "<b>Pris: </b>" + produkt.pris;
        }

        getJson();

        //Get the button:
        mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
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



<?php

get_footer();
