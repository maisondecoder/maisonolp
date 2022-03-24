<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
<div class="container p-4">
    <h3 class="mt-2 text-white">Maison Feeds</h3>
</div>
<div style="margin-bottom:95px; border-radius: 16px">
    <div class="bg-white p-2" style="margin-bottom:36px; border-radius: 16px">
        <div id="main">
            <!--
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <img src="..." class="card-img-bottom" alt="...">
            </div>
-->

        </div>

    </div>
    <footer class="d-flex justify-content-center">
        <div id="loading" class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p id="end" class=" text-light" style="display:none;">You're reached the bottom of the page.</p>
    </footer>
</div>
</div>
<script>
    var a = 1;
    const URL = ('<?= base_url('assets/feeds/'); ?>'+'infinite'+a+'.json');

    document.addEventListener("DOMContentLoaded", () => {
        //set up the IntersectionObserver to load more images if the footer is visible.
        //URL - https://gist.githubusercontent.com/prof3ssorSt3v3/1944e7ba7ffb62fe771c51764f7977a4/raw/c58a342ab149fbbb9bb19c94e278d64702833270/infinite.json
        let options = {
            root: null,
            rootMargins: "0px",
            threshold: 0.7,
        };
        const observer = new IntersectionObserver(handleIntersect, options);
        observer.observe(document.querySelector("footer"));
        //an initial load of some data

        //getData();
        //a++;
    });

    function handleIntersect(entries) {
        if (entries[0].isIntersecting) {
            if (a <= 2) {
                console.warn("something is intersecting with the viewport");
                getData();
                a++;
            } else {
                var loading = document.querySelector("#loading");
                var end = document.querySelector("#end");
                loading.style.display = 'none';
                end.style.display = 'block';
                console.warn("end of content");
            }
        }
    }

    function getData() {
        const URLnew = '<?= base_url('assets/feeds/'); ?>'+'infinite'+a+'.json'
        let main = document.querySelector("#main");
        console.log("fetch some JSON data");
        fetch(URLnew)
            .then((response) => response.json())
            .then((data) => {
                //alert(URLnew);
                // data.items[].img, data.items[].name
                data.items.forEach((item) => {
                    let card = document.createElement("div");
                    card.classList.add('card');
                    card.classList.add('mb-4');
                    let card_body = document.createElement("div");
                    card_body.classList.add('card-body');
                    let card_title = document.createElement("h5");
                    card_title.classList.add('card-title');
                    let card_text = document.createElement("p");
                    card_text.classList.add('card-text');
                    if (item.type == 'photo') {
                        let card_img = document.createElement("img");
                        card_img.classList.add('card-img-bottom');
                        card_img.style.minHeight = '200px';

                        card_img.src = item.src;
                        card_title.textContent = item.title;
                        card_text.textContent = item.desc;

                        card_body.appendChild(card_title);
                        card_body.appendChild(card_text);
                        card.appendChild(card_body);
                        card.appendChild(card_img);
                        main.appendChild(card);
                    }
                    if (item.type == 'video') {
                        let video_div = document.createElement("div");
                        let video_iframe = document.createElement("iframe");
                        video_div.style.position = 'relative';
                        video_div.style.paddingTop = item.padding;
                        video_iframe.style.border = 'none';
                        video_iframe.style.position = 'absolute';
                        video_iframe.style.top = 0;
                        video_iframe.style.minHeight = '100%';
                        video_iframe.style.width = '100%';
                        video_iframe.src = item.src;
                        card_title.textContent = item.title;
                        card_text.textContent = item.desc;

                        video_div.appendChild(video_iframe);
                        card_body.appendChild(card_title);
                        card_body.appendChild(card_text);
                        card.appendChild(card_body);
                        card.appendChild(video_div);
                        main.appendChild(card);
                    }



                    /*
                    let fig = document.createElement("figure");
                    let fc = document.createElement("figcaption");
                    let img = document.createElement("img");
                    img.src = item.img;
                    img.alt = item.name;
                    fc.textContent = item.name;
                    fig.appendChild(img);
                    fig.appendChild(fc);
                    main.appendChild(fig);
                    */
                });
            });
    }
</script>
<script src="<?= base_url('assets/js/'); ?>countdown.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>