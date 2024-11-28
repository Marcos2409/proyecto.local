<?php 
use proyecto\app\entity\Receta;
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tasty Recipes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../public/css/magnific-popup.css">
    <link rel="stylesheet" href="../../public/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/themify-icons.css">
    <link rel="stylesheet" href="../../public/css/nice-select.css">
    <link rel="stylesheet" href="../../public/css/flaticon.css">
    <link rel="stylesheet" href="../../public/css/gijgo.css">
    <link rel="stylesheet" href="../../public/css/animate.min.css">
    <link rel="stylesheet" href="../../public/css/slick.css">
    <link rel="stylesheet" href="../../public/css/slicknav.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Chicken Recipes</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->
    <br><br>
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h2>Subir recetas:</h2>
            <hr>
            <!-- Sección que muestra la confirmación del formulario o bien sus errores -->
            <?php if (!empty($mensaje) || !empty($errores)) : ?>
                <div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <?php if (empty($errores)) : ?>
                        <p><?= $mensaje ?></p>
                    <?php else : ?>
                        <ul>
                            <?php foreach ($errores as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <!-- Formulario que permite subir una imagen con su descripción -->
            <!-- Hay que indicar OBLIGATORIAMENTE enctype="multipart/form-data" para enviar ficheros al servidor -->
            <form class="form-horizontal" action="recipes/nueva" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Imagen</label>
                        <input class="form-control-file" type="file" name="imagen">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Categoria</label>
                        <select class="form-control" name="categoria">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option
                                    value="<?= $categoria->getId() ?>"
                                    <?= ($categoriaSeleccionada == $categoria->getId()) ? 'selected' : '' ?>>
                                    <?= $categoria->getNombre() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Titulo</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo ?? '' ?>">
                        <label class="label-control">Descripción</label>
                        <textarea class="form-control" name="descripcion"><?= $descripcion ?? '' ?></textarea>
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- recepie_area_start  -->

    <div class="recepie_area plus_padding">
        <div class="container">
            <div class="row">
                <?php foreach ($imagenes as $imagen) : ?>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single_recepie text-center">
                            <div class="recepie_thumb">
                            <img src="<?= Receta::RUTA_IMAGENES_SUBIDAS . $imagen->getNombreArchivo(); ?>"
                            alt="<?= htmlspecialchars($imagen->getDescripcion(), ENT_QUOTES, 'UTF-8') ?>"
                                    title="<?= htmlspecialchars($imagen->getNombre(), ENT_QUOTES, 'UTF-8') ?>"
                                    width="auto">
                            </div>
                            <h3><?= htmlspecialchars(explode('.', $imagen->getNombre())[0], ENT_QUOTES, 'UTF-8') ?></h3>
                            <span><?= htmlspecialchars($imagen->getCategoria(), ENT_QUOTES, 'UTF-8') ?></span>
                            <p><?= htmlspecialchars($imagen->getDescripcion(), ENT_QUOTES, 'UTF-8') ?></p>
                            <a href="/recipes/<?= htmlspecialchars($imagen->getId(), ENT_QUOTES, 'UTF-8') ?>" class="line_btn">View Full Recipe</a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <!-- /recepie_area_start  -->



        <!-- download_app_area -->
        <div class="download_app_area plus_padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-md-6">
                        <div class="download_thumb">
                            <div class="big_img">
                                <img src="../../public/img/video/big_1.png" alt="">
                            </div>
                            <div class="small_01">
                                <img src="../../public/img/video/small_sm1.png" alt="">
                            </div>
                            <div class="small_02">
                                <img src="../../public/img/video/sm2.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="download_text">
                            <h3>Download app to
                                get recipes from
                                Everywhere</h3>
                            <div class="download_android_apple">
                                <a class="active" href="#">
                                    <div class="download_link d-flex">
                                        <i class="fa fa-apple"></i>
                                        <div class="store">
                                            <h5>Available</h5>
                                            <p>on App Store</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="download_link d-flex">
                                        <i class="fa fa-android"></i>
                                        <div class="store">
                                            <h5>Download</h5>
                                            <p>from Play Store</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ download_app_area -->

        <!-- footer  -->
        <footer class="footer">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Top Products
                                </h3>
                                <ul>
                                    <li><a href="#">Managed Website</a></li>
                                    <li><a href="#"> Manage Reputation</a></li>
                                    <li><a href="#">Power Tools</a></li>
                                    <li><a href="#">Marketing Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Quick Links
                                </h3>
                                <ul>
                                    <li><a href="#">Jobs</a></li>
                                    <li><a href="#">Brand Assets</a></li>
                                    <li><a href="#">Investor Relations</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Features
                                </h3>
                                <ul>
                                    <li><a href="#">Jobs</a></li>
                                    <li><a href="#">Brand Assets</a></li>
                                    <li><a href="#">Investor Relations</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Resources
                                </h3>
                                <ul>
                                    <li><a href="#">Guides</a></li>
                                    <li><a href="#">Research</a></li>
                                    <li><a href="#">Experts</a></li>
                                    <li><a href="#">Agencies</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Subscribe
                                </h3>
                                <p class="newsletter_text">You can trust us. we only send promo offers,</p>
                                <form action="#" class="newsletter_form">
                                    <input type="text" placeholder="Enter your mail">
                                    <button type="submit"> <i class="ti-arrow-right"></i> </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row align-items-center">

                        <div class="col-xl-4 col-md-4">
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-dribbble"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-behance"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--/ footer  -->

        <!-- JS here -->
        <script src="js/vendor/modernizr-3.5.0.min.js" defer></script>
        <script src="js/vendor/jquery-1.12.4.min.js" defer></script>
        <script src="js/popper.min.js" defer></script>
        <script src="js/bootstrap.min.js" defer></script>
        <script src="js/owl.carousel.min.js" defer></script>
        <script src="js/isotope.pkgd.min.js" defer></script>
        <script src="js/ajax-form.js" defer></script>
        <script src="js/waypoints.min.js" defer></script>
        <script src="js/jquery.counterup.min.js" defer></script>
        <script src="js/imagesloaded.pkgd.min.js" defer></script>
        <script src="js/scrollIt.js" defer></script>
        <script src="js/jquery.scrollUp.min.js" defer></script>
        <script src="js/wow.min.js" defer></script>
        <script src="js/nice-select.min.js" defer></script>
        <script src="js/jquery.slicknav.min.js" defer></script>
        <script src="js/jquery.magnific-popup.min.js" defer></script>
        <script src="js/plugins.js" defer></script>
        <script src="js/gijgo.min.js" defer></script>

        <!--contact js-->
        <script src="js/contact.js" defer></script>
        <script src="js/jquery.ajaxchimp.min.js" defer></script>
        <script src="js/jquery.form.js" defer></script>
        <script src="js/jquery.validate.min.js" defer></script>
        <script src="js/mail-script.js" defer></script>

        <script src="js/main.js" defer></script>
</body>

</html>