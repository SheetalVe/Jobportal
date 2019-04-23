@extends('layouts.app')

@section('content')
<div class="container">
    <div class="innerContent">
        <div class="whiteBg innerPages">
            <div class="row"> 
                <div class="col-md-5">
                    <h2>PORTEUR DE PROJET</h2>
                    
                </div>

                <div class="col-md-7">
                	<img src="images/Bannière-investisseurs.png" alt="">
                </div>
            </div>

            <div class="whiteBg1">

                <div class="row mr50">

                	<div class="col-md-6">
                    	<div class="leftIcon">
                    		<img src="images/LOGO-OG-JAUNE-e1541029989809.png" alt="">
                    	</div>

                    	<div class="leftImg">
                    		<img src="images/Hexa-Noogah-Products-3.png" alt="">
                    	</div>
                    </div>

                    <div class="col-md-6">

                    	<div class="rightIcon text-right">
                    		<img src="images/Ampoule-jaune-e1541030094768.png" alt="">
                    	</div>

                    	<div class="rightContent">
                    		<p><strong><span>Accélérez votre développement !</span></strong></p><p><span>Échangez avec nos experts certifiés et identifiez les sources de financement adaptées à vos objectifs.</span></p><p><span class="wixGuard">&#8203;</span><span>Trouvez les experts et investisseurs les plus adaptés à vos besoins et gagnez du temps dans vos levées de fonds.</span></p><p><span>Notre offre de base est gratuite pour les entrepreneurs, ce sont vos informations qui parlent pour vous !</span></p>
                    	</div>

                    	<div id="accordion" class="accordion">
                            <div class="card mb-0">
                                <div class="card-header yellow" data-toggle="collapse" href="#collapseOne">
                                    <a class="card-title">
                                        Offre de lancement
                                    </a>
                                </div>
                                <div id="collapseOne" class="card-body collapse show" data-parent="#accordion" >
                                    <div class="card-body"><p>NOOGAH vous aide à compléter votre profil à partir de sources publiques… c’est gratuit pour les premiers membres !</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="circleImg text-center">
                            <img src="img/bouton-créer-mon-compte-300x284.png" alt="">
                        </div>
                    </div>
                </div>

            </div>

            <div id="demo" class="carousel slide" data-ride="carousel">

                  <!-- Indicators -->
                  <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                  </ul>
                  
                  <!-- The slideshow -->
                  <div class="carousel-inner yelloBg">
                    <div class="carousel-item active">
                       <img src="images/LOGO-BONANZA-300x83.png">
                       <p>regroupe l'ensemble des solutions de financement, prix et subventions accessibles aux Entrepreneurs via la plateforme NOOGAH, en remplissant simplement vos profils. </p>
                    </div>
                    <div class="carousel-item">
                       <img src="images/LOGO-CONNECT-300x83.png">
                       <p>est l’outil de mise en relation de la plateforme. Remplissez votre questionnaire et votre profil pour vous connecter aux experts adaptés.</p>
                    </div>
                    <div class="carousel-item">
                       <img src="images/LOGO-CERTIFY-300x83.png">
                       <p>permet de mettre en valeur votre projet auprès de la communauté en temps voulu, de manière simplifiée, dès que vous êtes "prêt à rencontrer l'investisseur" !</p>
                    </div>
                  </div>
                  
                  <!-- Left and right controls -->
                  <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </a>
                  <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
              </a>
            </div>

            <div class="whiteBg1 mar30 yellow">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Plus d'informations ?</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <a href="#"><i class="fa fa-search" aria-hidden="true"></i> Connect</a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="box">
                            <a href="#"><i class="fa fa-check" aria-hidden="true"></i> Certify</a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="box">
                           <a href="#"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Bonanza</a>
                        </div>
                    </div>

                </div>
            </div>


        </div>


    </div>
</div>






    <!--header class="fullwidthselfier fd">

        <div class="slideshow-container">

            <div class="mySlides mainbox25" style=" background-color: rgba(45, 91, 229, 1);">

                <div class="container">

                    <div><img src="{{ asset('img/whitelogo.png') }}"></div>
                    <q>Les investisseurs nous font confiance pour gérer la collecte et le traitement des informations sur leurs objectifs d'investissement, sous toute forme que ce soit Ces ressources sont l'objectif final de la communauté et nous les appelons "Bonanzas"

Seeders, financez au mieux votre projet en participant à ces bonanzas!

Harvesters, optimisez votre temps et organisez votre propre bonanza!</q>
                    <p class="author">En savoir plus</p>

                </div>

            </div>

            <div class="mySlides mainbox25" style="  background-color: rgba(79, 193, 128, 1);">

                <div class="container">

                    <div><img src="{{ asset('img/whitelogo.png') }}"></div>
                    <q>Noogah construit sa communauté autour de certificats qui garantissent que nos membres sont ceux qu’ils prétendent être. Cette certification de l’information est le fil rouge qui conduit à un gain de temps et d’argent tout au long de votre expérience Noogah.

Chaque profil est validé, chaque seed, chaque grower, harvester, est certifié pour une optimisation totale du process de financement

Des entrepreneurs sérieux, des conseillers compétents et des investisseurs dignes de confiance pour une communauté forte et innovante</q>
                    <p class="author">Foire aux Questions</p>

                </div>

            </div>

            <div class="mySlides mainbox25" style="    background-color: rgba(244, 170, 46, 1); ">

                <div class="container">

                    <div><img src="{{ asset('img/whitelogo.png') }}"></div>
                    <q>Selon votre profil, Noogah Connect vous permet une mise en relation simple avec les entrepreneurs, les seeds, les experts ou financeurs de la plateforme. Retrouvez facilement les secteurs d’activité présents, les stades d’avancement des seeds ou tout autre critères de recherche que vous auriez décidé</q>
                    <p class="author">En savoir plus</p>

                </div>

            </div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

        </div>

        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                if (n > slides.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
            }
        </script>

    </header-->
 
    <!--div class="container">

        <div class="row">

            <div class="boxtext">

                <marquee style="color: #fff;">

                    There are 122 Seeds awaiting investment on the noogah platform Harvest quality information to help you make better decisions faster!

                </marquee>

            </div>

        </div>

    </div-->
 
    <!--div class="container">
        <div class="row">

            <div class="container mb-5 mt-5">
                <div class="pricing card-deck flex-column flex-md-row mb-3">
                    <div class="card card-pricing text-center px-3 mb-4">
                        <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">SEEDEREntrepreneur</span>

                        <h1>Accélérez votre développement</h1>

                        <p>Échangez avec nos experts certifiés pour accélérer votre développement et boostez votre croissance grâce à des conseils de professionnels expérimentés
                            <br>
                            <br> Identifiez les sources de financement adaptées à vos objectifs parmi une communauté de professionnels de l'investissement certifiés, acteurs traditionnels comme plateformes de financement participatif qualifiées Échangez, gagnez des prix, challengez-vous, et renseignez un maximum d’informations sur votre Seed pour que Noogah vous accompagne dans ce développement</p>

                        <div class="clearfix"></div>

                        <button type="submit" class="btn-change10 loginpass" style="    background-color: rgba(244, 170, 46, 1);">Envoyer un pitchbook</button>

                    </div>

                    <div class="card card-pricing text-center px-3 mb-4">
                        <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Envoyer un CV</span>

                        <h2>Optimisez votre potentiel</h2>

                        <p>Identifiez les entrepreneurs et les investisseurs appropriés avec qui échangez grâce à nos outils de mise en relation avancés
                            <br>
                            <br> Renseignez vos compétences et la portée de votre réseau, vos succès précédents et faites la promotion de votre entreprise en tant que conseiller, incubateur ou accélérateur de start-up en obtenant des certificats délivrés par la communauté de noogah Impulsez votre activité directement auprès des clients potentiels, entrepreneurs et/ou investisseurs, à l'échelle nationale ou internationale selon vos besoins</p>

                        <div class="clearfix"></div>

                        <button type="submit" class="btn-change10 loginpass" style="background-color: rgba(79, 193, 128, 1);">Envoyer un CV</button>

                    </div>
                    <div class="card card-pricing text-center px-3 mb-4">
                        <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">HARVESTER Investisseur</span>

                        <h3>Trouvez rapidement les prochains succès startups</h3>

                        <p>

                            Ne perdez plus de temps à lire des dossiers incomplets et à recevoir des candidats qui ne sont pas préparés
                            <br>
                            <br> Noogah vous permet d’utiliser nos outils de de mise en relation et de certification afin de vous assurer que les entrepreneurs et les experts conseillers que vous aurez choisis sont dûment certifiés par vous, la communauté et d’autres harvesters qualifiés ​ Pour nous rejoindre, il vous suffit de commencer à certifier des experts, vous pouvez également organiser un bonanza: laissez vous guider par Noogah!

                        </p>

                        <div class="clearfix"></div>

                        <button type="submit" class="btn-change10 loginpass" style="    background-color: rgba(45, 91, 229, 1);">Rejoindre la communauté</button>

                    </div>
                </div>
            </div>

        </div>
    </div--> 


    <footer>
        <div class="footer" id="footer">
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        <div class="address">
                            <h2>Contactez-nous</h2>
                            <p>
                                <strong>Adresse</strong> <br>
                                126 rue Legendre<br>
                                75017 Paris
                            </p>
                            <p>
                                <strong>E-mail</strong> <br>
                                <a href="mailto:contact@noogah.com">contact@noogah.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="links">
                            <h2>Liens utiles</h2>
                            <ul>
                            <li><a href="https://twitter.com/NoogahFr" target="_blank">Twitter</a></li>
                                <li><a href="https://www.linkedin.com/company/noogah/" target="_blank">Linkedin</a></li>
                                <li><a href="https://www.facebook.com/NoogahFR/" target="_blank">Facebook</a></li>
                                <li><a href="#">Email</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="copyRight">
                            <h2>Mentions Légales</h2>
                            <p>© Tous droits réservés – NOOGAH SAS – 2018</p>
                            <p>NOOGAH SAS – 842 272 213 R.C.S. Paris</p>
                        </div>
                    </div>





                    <!--ul>
                        <li> <a href="#">About Us </a> </li>

                        <li> <a href="#"> Information </a> </li>

                        <li> <a href="#"> Contact Us</a> </li>

                        <li> <a href="#">FAQ</a> </li>

                    </ul-->


                </div> 

                <div class="row footerBottom">
                  <div class="col-md-12">
                    © Tous droits réservés – NOOGAH SAS – 2018- All Right Reserved.
                  </div>  
                </div>

            </div> 
        </div>
        </footer> 
    @endsection
