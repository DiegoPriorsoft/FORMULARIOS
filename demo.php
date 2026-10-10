<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/bundle/css/demo.css">
</head>
<body>
    <main class="page-shell">
        <button
            class="theme-button"
            id="themeButton"
            type="button"
            aria-label="Cambiar entre tema claro y oscuro"
            aria-pressed="false"
        >
            <span class="theme-button__icon" aria-hidden="true">🌙</span>
            <span class="theme-button__text">Tema oscuro</span>
        </button>

        <header class="page-header">
            <span class="eyebrow">Formulario de prueba</span>
            <h1>¡Hablemos!</h1>
            <p>Completa tus datos y cuéntanos un poco sobre ti.</p>
        </header>

        <section class="form-card" aria-labelledby="form-title">
            <h2 id="form-title" class="sr-only">Formulario de contacto</h2>

            <form id="demoForm" action="controller/demo.php" method="POST" novalidate>
                <div id="carouselTravel" class="carousel slide travel-carousel" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselTravel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Destino 1"></button>
                        <button type="button" data-bs-target="#carouselTravel" data-bs-slide-to="1" aria-label="Destino 2"></button>
                        <button type="button" data-bs-target="#carouselTravel" data-bs-slide-to="2" aria-label="Destino 3"></button>
                    </div>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/images/travel_1.svg" class="d-block w-100" alt="Lago entre montañas al amanecer">
                            <div class="carousel-caption">
                                <strong>Explora nuevos destinos</strong>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/images/travel_2.svg" class="d-block w-100" alt="Costa tropical durante el atardecer">
                            <div class="carousel-caption">
                                <strong>Descubre nuevos paisajes</strong>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/images/travel_3.svg" class="d-block w-100" alt="Bosque y montañas bajo un cielo estrellado">
                            <div class="carousel-caption">
                                <strong>Crea recuerdos</strong>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTravel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselTravel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>

                <div class="form-grid">
                    <div class="field-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" autocomplete="name">
                    </div>

                    <div class="field-group">
                        <label for="correo">Correo electrónico</label>
                        <input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com" autocomplete="email">
                    </div>

                    <div class="field-group field-group--full">
                        <label for="pais">País</label>
                        <select id="pais" name="pais">
                            <option value="">Selecciona tu país</option>
                            <option value="mx">México</option>
                            <option value="us">Estados Unidos</option>
                        </select>
                    </div>

                    <fieldset class="field-group field-group--full radio-field">
                        <legend>¿Cuál es tu lenguaje de programación favorito?</legend>
                        <div class="radio-group">
                            <label class="radio-option" for="html">
                                <input type="radio" id="html" name="fav_language" value="HTML">
                                <span>HTML</span>
                            </label>

                            <label class="radio-option" for="css">
                                <input type="radio" id="css" name="fav_language" value="CSS">
                                <span>CSS</span>
                            </label>

                            <label class="radio-option" for="javascript">
                                <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                                <span>JavaScript</span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="field-group field-group--full">
                        <label>Campos de prueba <small>(opcionales)</small></label>
                        <div class="test-grid">
                            <input type="text" id="test-1" name="prueba[]" placeholder="Campo 1" aria-label="Campo de prueba 1">
                            <input type="text" id="test-2" name="prueba[]" placeholder="Campo 2" aria-label="Campo de prueba 2">
                            <input type="text" id="test-3" name="prueba[]" placeholder="Campo 3" aria-label="Campo de prueba 3">
                        </div>
                    </div>
                </div>

                <button class="submit-button" type="submit">
                    <span>Enviar formulario</span>
                    <span aria-hidden="true">→</span>
                </button>
            </form>

            <div id="responsePanel" class="response-panel" aria-hidden="true" role="status" aria-live="polite">
                <div class="response-heading">
                    <span class="response-icon" aria-hidden="true"></span>
                    <h2 id="responseTitle"></h2>
                </div>
                <p id="responseMessage"></p>
                <details class="response-details">
                    <summary>Ver respuesta JSON</summary>
                    <pre id="responseJson"></pre>
                </details>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bundle/demo.js"></script>
</body>
</html>
