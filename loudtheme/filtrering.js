        function opretKnapper() {

            console.log("opretKnapper");


            categories.forEach(cat => {

                document.querySelector("#filtrering").innerHTML += < button class = "filter"

                data - produkt = "${cat.id}" > $ {

                    cat.name

                } < /button>

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
