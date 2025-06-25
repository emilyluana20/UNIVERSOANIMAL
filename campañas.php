<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buscador en Tiempo Real</title>
    <link rel="stylesheet" href="estilos/campañas.css">
</head>
<body>
    <section class="search-section" aria-label="Buscador de lugares, fechas y horas">
        <h2>Buscar Lugares, Fechas y Horas</h2>
        <input
            type="text"
            id="searchInput"
            placeholder="Escribe para buscar..."
            aria-describedby="searchHelp"
            autocomplete="off"
        />
        <ul id="resultsList" class="list" aria-live="polite" aria-relevant="additions"></ul>
    </section>
    <script src="script.js"></script>
</body>
</html>