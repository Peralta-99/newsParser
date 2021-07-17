<html>
<head>
    <title>Scraper of articles - Result</title>
</head>
<body>
<div class="container">
    @foreach($articles as $article)
        <h2> {{ $article->title }} </h2>
        <br>
        {{ $article->text_overview }}
        <br>
        <p> {{ substr($article->article_text_body, 0, 200) }} ... </p>
        <form action='/getFullArticle/{{ $article->id }}' target="_blank">
            <input type="submit" value="Подробнее" />
        </form>
    @endforeach
</div>
</body>
</html>
