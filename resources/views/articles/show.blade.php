<html>
<head>
    <title>Scraper of articles - Result</title>
</head>
<body>
<div>
    <h2> {{ $articleData->title }} </h2>
    <br>
    <span> {{ $articleData->text_overview }} </span>
    <br>
    @if(!empty($articleData->image_url))
        <img width="700" src={{ $articleData->image_url }} >
    @endif
    <br>
    <p> {{ $articleData->article_text_body }} </p>
    <br>
</div>
</body>
</html>
