<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>{{ $title }}</title>
    <style>

        body {
            color: {{ $fontColor }};
            background: {{ $bg }};

        }

        .banner a {
            color: {{ $fontColor }}
        }

    </style>

</head>
<body>

    <div class="profileImage">
        <img src="{{ $image }}" alt="">
    </div>

    <div class="profileTitle">
        {{ $title }}
    </div>

    <div class="profileDescription">
        {{ $description }}
    </div>

    <div class="linkArea">

    </div>
      
    <div class="banner">
        Produzido por <a href="">Giuliano Criscuoli</a> | {{ date('Y') }}
    </div>

    @if(!empty($fbPixel))
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $fbPixel }}');
            fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" 
    src="https://www.facebook.com/tr?=id={{$fbPixel}}&ev=PageView&noscript=1"/></noscript>
        <!-- End Facebook Pixel Code -->
    @endif
</body>
</html>