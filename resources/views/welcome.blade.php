<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Scraper of articles</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('../css/style.css') }}">
        <!-- jQuery -->
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
    </head>
    <body>
        <div class="grid justify-center min-h-screen sm:items-center">
            <div class="text-input-item">
                <label>Site url:</label>
                <span><input type="text" id="url" name="url" value="" size="30"/></span>
            </div>

            <div class="text-input-item">
                <label>Article CSS Selector:</label>
                <span><input type="text" id="selector" name="selector" value="" size="30" /></span>
            </div>

            <div class="text-input-item">
                <label>Needed count of articles:</label>
                <span><input min="1" max="200" type="number" id="count" name="count" value="" size="30" /></span>
            </div>

            <div class="filter-item">
                <label>Lazy load of articles:</label>
                <span><input checked type="checkbox" id="lazy_load" name="lazy_load" value="" size="30" /></span>
            </div>

            <button id="submitAjaxForm">Go</button>
        </div>
        <div id="loader"></div>
    </body>
    <script type="text/javascript" src="{{ asset('../js/script.js') }}"></script>
</html>
