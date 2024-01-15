<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora rotulado</title>
    <link rel="stylesheet" href="./fonts/Open Sans/opensans.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://kit.fontawesome.com/34c8c46ca5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts.js"></script>
</head> 
<body>
    <div class="container">
        <header class="container__header">
            <div class="header__content">
                <div class="header__logo-header">
                    <a href="#" class="logo-header__link">
                        <img src="./img/logo.png" alt="Logo de empresa" class="logo-header__img">
                    </a>
                </div>
                <nav class="header__menu">
                    <ul class="menu__options">
                        <li class="menu__option">
                            <a href="#" class="menu__link">
                                <span class="menu__item--text">
                                    <span class="menu__text">Calculadora</span>
                                </span>
                            </a>
                        </li>
                        <li class="menu__option">
                            <a href="#" class="menu__link">
                                <span class="menu__item--text">
                                    <span class="menu__text">Inicio</span>
                                </span>
                            </a>
                        </li>
                        <li class="menu__option">
                            <a href="#" class="menu__link">
                                <a href="#" class="menu__link">
                                    <span class="menu__item--text">
                                        <span class="menu__text">Cursos</span>
                                    </span>
                                </a>    
                            </a>
                        </li>
                        <li class="menu__option">
                            <a href="#" class="menu__link">
                                <span class="menu__item--text">
                                    <span class="menu__text">Investigación</span>
                                </span>
                            </a>
                        </li>
                        <li class="menu__option">
                            <a href="#" class="menu__link">
                                <span class="menu__item--text">
                                    <span class="menu__text">Sobre CESCAL</span>
                                </span>
                            </a>
                        </li>
                        <li class="menu__option">
                            <a href="#" class="menu__link">
                                <span class="menu__item--text">
                                    <span class="menu__text">Contenidos</span>
                                </span>
                            </a>
                        </li>
                        <li class="menu__option">
                            <a href="#" class="menu__link">
                                <span class="menu__item--text">
                                    <span class="menu__text">Contacto</span>
                                </span>
                            </a>
                        </li>
                        <li class="menu__option">
                            <a href="#" class="menu__link">
                                <span class="menu__item--text">
                                    <span class="menu__text">E-Learning</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <?php 
        include('config.php'); 
        include('request.php');
        
        error_reporting(0);
        ini_set('display_errors', 0);

        ?>
    
        <main class="container__principal">
            <div class="principal__parallax">
                <h1 class="parallax__title">Calculadora de Rótulo Nutricional</h1>
                <p class="parallax__description">Con esta calculadora podras obtener tu Tabla de información Nutricional completa y toda la informacion correspondiente al rotulo de tu producto, acorde al Código Alimentario Argentino vigente.<br>Te servira para la declaración de alimento libre de gluten y de alérgenos alimentarios. <br>Posibilidad de incorporar el atributo vegano, o la declaración de vegetariano o de origen animal.</p>
            </div>
            <div class="container__content">
                <section class="content__section">
                    <h2 class="section__title">Calcula tu producto</h2>
                    <div class="separator"></div>
                    <article class="section__steps">
                        <h3 class="steps__title">1-Define tu producto</h3>
                        <p class="steps__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, aliquam?</p>
                        <form action="" method="" class="steps__input-1">
                            <textarea id="description" cols="40" rows="4" placeholder="Denominación de tu producto..." class="input__description"></textarea>
                            <div class="input__box">
                            <div class="typeproduct__bar">
                            <form action='' method='POST' id='tablaForm'>
                                <select name='product' id='typeProductSelect' class='typeproduct__search'>
                                    <option value='TABLA I'>Productos de panificación, cereales, leguminosas, raíces, tubérculos, y sus derivados</option>
                                    <option value='TABLA II'>HORTALIZAS Y CONSERVAS VEGETALES</option>
                                    <option value='TABLA III'>Frutas, jugos, nectares y refrescos de frutas</option>
                                    <option value='TABLA IV'>Leche y derivados</option>
                                    <option value='TABLA V'>Carnes y Huevos</option>
                                    <option value='TABLA VI'>Aceites, grasas y semillas oleaginosas</option>
                                    <option value='TABLA VII'>Azúcares y productos con energía proveniente de carbohidratos y grasas</option>
                                    <option value='TABLA VIII'>Salsas, aderezos, caldos, sopas y platos preparados</option>
                                </select>
                            </form>
                            </div>
                                
                            
                                    
                            <div class="product__bar">
                                <div id="productResultado"></div>
                                <i class="fa-solid fa-chevron-right icon__search"></i>
                            </div>
                        </form>
                    </article>
                    <article class="section__steps">
                        <h3 class="steps__title">2-Completa la fórmula / receta de tu producto</h3>
                        <p class="steps__description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas possimus recusandae alias dicta ut, ad vitae eos deleniti vel! Obcaecati?</p>
                        <form action="" method="" class="steps__input-2">
                        <div class="input-2__search-bar">

                        <?php
                            $query = "SHOW TABLES";
                            $result = $conn0->query($query);

                            if($result){
                                echo "<form action='' method='POST' id='tablaForm'>";
                                echo "<select name='tabla' id='tablaSelect' class='search-bar__bar'>";
                                while ($row = $result->fetch_row()) {
                                    echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
                                }
                                echo "</select>";
                                echo "</form>";

                                $result -> close();
                            }else{
                                echo "Error al ejecutra la consulta: " . $conn0 -> error; 
                            }
                        ?>
                        
                        </div>

                                
                        <form>
                            <div id='tablaResultado'></div>

                            <div id="listaElementos"></div>

                        </form>

                        <!--<form class="steps__input-2">
                            <div class="input-2__info-btn">
                                <div class="info-btn__clean-btn">
                                    <i class="fa-solid fa-arrow-right fa-rotate-180 arrow__left"></i>
                                    <input type="reset" id="clean" class="btn__reset" value="Limpiar inventario">
                                </div>
                                !--<div class="info-btn__rectangle">
                                    <span class="rectangle__title">Total</span>
                                    <div class="rectangle__total-info"> g</div>
                                    <div class="rectangle__percent">100%</div>
                                </div>--
                                <div class="info-btn__calc-btn">
                                    <input type="submit" id="calculate" class="btn__calc" value="Calcular el producto">
                                    <i class="fa-solid fa-arrow-right arrow__right"></i>
                                </div>
                            </div>
                        </form>-->


                    </article>

                    <!------------------------------------------------------------------------------------------------------------------->


                    <article class="section__steps">
                        <h3 class="steps__title">3-Revisa los resultados de tu tabla</h3>
                        <p class="steps__description">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt illum quam sint fugit cupiditate fugiat, nisi reprehenderit distinctio, laboriosam, doloribus numquam assumenda in consequuntur dolorum!</p>
                        <div class="steps__table-results">
                            <header class="table__header">
                                <span class="header__text"></span>
                                <span class="header__text header__text--porcion">Cantidad por 100g.</span>
                                <?php echo "<span class='header__text'>Cantidad por porción $totalGramos g</span>" ?>
                                <span class="header__text">%VD</span>
                            </header>
                            <div class="steps__table">
                                <div class="table__rectangle">
                                    <h3 id="table__title">Valor energético</h3>
                                    <div class="table__info">
                                        <?php echo "<div class='table__total-product'>$totalEnergiaKJ100g KJ</div>" ?>
                                        <?php echo "<div class='table__porcion'>$totalEnergiaKJ KJ</div>" ?>
                                        <div class="table__MUC">0%</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Carbohidratos, de los cuales</h3>
                                    <div class="table__info">
                                        <?php echo "<div class='table__total-product'>$totalCarbohidratosTotales100g g</div>" ?>
                                        <?php echo "<div class='table__porcion'>$totalCarbohidratosTotales g</div>" ?>
                                        <div class="table__MUC">0%</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Azúcares totales</h3>
                                    <div class="table__info">
                                        <div class="table__total-product">X</div>
                                        <div class="table__porcion">X</div>
                                        <div class="table__MUC">X</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Azúcares añadidos</h3>
                                    <div class="table__info">
                                        <div class="table__total-product">X</div>
                                        <div class="table__porcion">X</div>
                                        <div class="table__MUC">X</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Proteínas</h3>
                                    <div class="table__info">
                                        <?php echo "<div class='table__total-product'>$totalProteinas100g g</div>" ?>
                                        <?php echo "<div class='table__porcion'>$totalProteinas g</div>" ?>
                                        <div class="table__MUC">0%</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Grasas totales</h3>
                                    <div class="table__info">
                                        <?php echo "<div class='table__total-product'>$totalGrasaTotal100g g</div>" ?>
                                        <?php echo "<div class='table__porcion'>$totalGrasaTotal g</div>" ?>
                                        <div class="table__MUC">0%</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Grasas saturadas</h3>
                                    <div class="table__info">
                                        <div class="table__total-product">g</div>
                                        <div class="table__porcion">g</div>
                                        <div class="table__MUC">0%</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Grasas trans</h3>
                                    <div class="table__info">
                                        <div class="table__total-product">g</div>
                                        <div class="table__porcion">g</div>
                                        <div class="table__MUC">---</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Fibra alimentaria</h3>
                                    <div class="table__info">
                                        <div class="table__total-product">g</div>
                                        <div class="table__porcion">g</div>
                                        <div class="table__MUC">0%</div>
                                    </div>
                                </div>
                                <div class="table__rectangle">
                                    <h3 id="table__title">Sodio</h3>
                                    <div class="table__info">
                                        <?php echo "<div class='table__total-product'>$totalSodio100g mg</div>" ?>
                                        <?php echo "<div class='table__porcion'>$totalSodio mg</div>" ?>
                                        <div class="table__MUC">0%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <div class="separator"></div>
                    <article class="section__steps">
                        <h3 class="steps__title">4-Añade información</h3>
                        <div class="steps__information">
                            <div class="information__toggle">
                                <p class="toggle__description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut aliquam dicta quis voluptatum. Voluptatum, rem sequi? Magni incidunt distinctio voluptate.</p>
                                <div class="wrap__toggle">
                                    <input type="checkbox" id="toggle-1" class="offscreen">
                                    <label for="toggle-1" class="switch"></label>
                                    <span class="toggle__text">Atributos opcionales</span>
                                </div>
                                <div class="wrap__toggle">
                                    <input type="checkbox" id="toggle-2" class="offscreen">
                                    <label for="toggle-2" class="switch"></label>
                                    <span class="toggle__text">Información nutricional complementaria</span>
                                </div>
                            </div>
                            <div class="information__rectangle">
                                <div class="rectangle__category rectangle__black">
                                    <span class="category__title">SELLOS</span>
                                </div>
                                <div class="rectangle__category rectangle__red">
                                    <span class="category__title">OBLIGATORIOS</span>
                                </div>
                                <div class="rectangle__category rectangle__green">
                                    <span class="category__title">OPCIONALES SELECCIONADOS</span>
                                </div>
                                <div class="rectangle__category rectangle__gray">
                                    <span class="category__title">OPCIONALES NO SELECCIONADOS</span>
                                </div>
                            </div>
                        </div>
                    </article>
                    <div class="separator"></div>
                    <article class="section__step-final">
                        <h3 class="step-final__title">Descarga todo para tu rótulo final</h3>
                        <p class="step-final__description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus, minima quae beatae est numquam nihil exercitationem aut magni quas consequuntur!. Lorem ipsum dolor sit amet consectetur, adipisicing elit. A eos eum, accusamus harum obcaecati cupiditate ipsa suscipit possimus alias reprehenderit!</p>
                        <form action="" method="" class="step-final__download">
                            <input type="button" name="descargar" id="download" value="Descargar" class="download__btn">
                        </form>
                    </article>
                </section>
            </div>
        </main>
    
        <footer class="container__footer">
            <a href="#" class="footer__logo-footer">
                <img src="./img/logo-footer.png" alt="Logo de la empresa" class="logo-footer__img">
                <p class="logo-footer__description">&copy;Cescal - Todos los Derechos Reservados</p>
            </a>
            <div class="footer__links">
                <ul class="footer__options">
                    <li class="footer__option">
                        <a href="#" class="footer__link">Inicio</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Organizaciones Reconocidas</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Políticas de privacidad</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Equipo de Profesionales</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Investigaciones</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Cursos online</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Cursos autogestionados</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Diplomaturas</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Noticias</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">Contacto</a>
                    </li>
                    <li class="footer__option">
                        <a href="#" class="footer__link">E-Learning</a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>

</body>
</html>
