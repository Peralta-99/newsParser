<html>
<head>
    <title>Scraper of articles - Result</title>
</head>
<body>
<div>
    <h2> {{ $articleData->title }} </h2>
    <br>
    <span> {{ $articleData->textOverview }} </span>
    <br>
    @if(!empty($articleData->image_url))
        <img width="700" src={{ $articleData->imageUrl }} >
    @endif
    <br>
    <p> {{ $articleData->articleTextBody }} </p>
    <br>
</div>
</body>
</html>
