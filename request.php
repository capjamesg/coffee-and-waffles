<?php

$data = [
    "secret" => "1234abcd",
    "source" => "http://rhiaro.co.uk/2015/11/1446953889",
    "target" => "http://aaronparecki.com/notes/2015/11/07/4/indiewebcamp",
    "post" => [
        "type" => "entry",
        "author" => [
            "name" => "Amy Guy",
            "photo" => "http://webmention.io/avatar/rhiaro.co.uk/829d3f6e7083d7ee8bd7b20363da84d88ce5b4ce094f78fd1b27d8d3dc42560e.png",
            "url" => "http://rhiaro.co.uk/about#me"
        ],
        "url" => "http://rhiaro.co.uk/2015/11/1446953889",
        "published" => "2015-11-08T03:38:09+00:00",
        "name" => "repost of http://aaronparecki.com/notes/2015/11/07/4/indiewebcamp",
        "bookmark-of" => "http://aaronparecki.com/notes/2015/11/07/4/indiewebcamp",
        "wm-property" => "bookmark-of"
    ]
];

$ch = curl_init('http://localhost:8000/api/webmention');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($data))
));

$result = curl_exec($ch);
curl_close($ch);

echo $result;
