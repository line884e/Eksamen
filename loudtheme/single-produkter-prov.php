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
    <a href="http://up2create.dk/kea/2-semester/eksamen/wordpress/produkt/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/pil.png" alt="pil" class="pil"></a>
</div>

<!--template-->



<div class="single_container">
<section id="sektion_singleview">
<article>
    <div class="singleview_row">
        <div class="singleview_column" div id="slideshow">
            <div class="billede_slideshow">
                <img class="img1" src="">
            </div>
            <div class="skift_billede">
            <button class="tilbage" onclick="plusSlides(-1)"></button>
            <div>
                <span class="dot valgt_dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
            <button class="frem" onclick="plusSlides(1)"></button>
            </div>

        </div>

        <div class="singleview_column">
            <h1 class="navn"></h1>
            <p class="prisen">HER</p>
            <p class="beskrivelse">HER</p>
            <button class="tilfoej">TILFØJ TIL KURV</button>
        </div>

    </div>
</article>
</section>
</div>


-->


    <style>

    .single_container {
        margin-left: auto;
margin-right: auto;
padding-left: 20px;
padding-right: 20px;
    }


         .single_container {
            display: flex;
justify-content: center;
         }



    #sektion_singleview {
        margin: 7% 80px 7% 80px;

    }


         #sektion_singeview {
        margin: 10% 0 7% 0;
    }


    .singleview_row {
        display: grid;
        grid-template-columns: 3fr 2fr;
        column-gap: 50px;
    }

    #slideshow {
        background-color: #F2F0EA;
        padding: 30px 30px 10px 30px;
    }

    img {
        vertical-align: middle;
    }

    img {
        height: auto;
        max-width: 100%;
    }

    img {
        border: 0;
    }

    .skift_billede {
    display: flex;
    justify-content: center;
}

    #skift_billede{display: flex;
justify-content: center;
    }

    .tilbage{
        font-size: 1.2rem;
padding: 5px;
margin: 10px;
    }

.dot {
    height: 10px;
    width: 10px;
    margin: 0 2px;
    background-color: #939393;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
    margin-top: 17px;
}

.valgt_dot {
    background-color: #555454;
}


.skift_billede .frem,
.skift_billede .tilbage {
    background: none;
    color: black;
}

.skift_billede .frem:hover,
.skift_billede .tilbage:hover {
    color: #939393;
}

    article{
            justify-content: center;
    justify-items: center;
    display: flex;
        width: 1000px;
    }

</style>

    <!--script-->
    <script>
        let produkt;
        //        let episoder;
        let aktuelprodukt = <?php echo get_the_ID() ?>;
        var elmnt = document.getElementById("content");

        const dbUrl = "http://up2create.dk/kea/2-semester/eksamen/wordpress/wp-json/wp/v2/produkter/" + aktuelprodukt;
        //        const episodeUrl = "http://up2create.dk/kea/2-semester/eksamen/wordpress/wp-json/wp/v2/episoder?per_page=100";
        //
        //        const container = document.querySelector("#episoder");


        async function getJson() {
            const data = await fetch(dbUrl);
            produkt = await data.json();

            //            const data2 = await fetch(episodeUrl);
            //            episoder = await data2.json();
            //            console.log("episoder: ", episoder);

            visProdukter();
            //            visEpisoder();
        }

        function visProdukter() {
            console.log("visProdukter");
//            document.querySelector("navn").innerHTML = produkt.title.rendered;
//            document.querySelector(".img1").src = produkt.billede.guid;
//            document.querySelector(".beskrivelse").innerHTML = produkt.beskrivelse_produkt;
//            document.querySelector(".prisen").innerHTML = "<b>Pris: </b>" + produkt.pris;
        }



        getJson();



    </script>

</section>

<?php

get_footer();
