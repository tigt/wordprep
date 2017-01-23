# WordPrep

Scrubs notorious WordPress front-end output. Include it in your theme if you like.

## What does it do?

Adds theme support for `'title-tag'`, as required by WP.org, and enables HTML5 output for core WordPress markup.

It also redirects attachment pages to their parent posts (if any), since those tend to be comment spam magnets.

But mostly, it removes…

* `<meta name="generator">`, the RSS `<generator>`, other WP-advertising

* The `X-Pingback` header

* The Rest API `<link>` and HTTP header

* `<script src='https://example.com/wp-includes/js/wp-embed.min.js'>`

* The WP_EMOJI scripts and styles, and their corresponding `<link rel='dns-prefetch' href='//s.w.org' />"`

* `<link rel="EditURI">`, `<link rel="wlwmanifest">`, `<link rel="shortlink">` (and its HTTP header), and `<link rel="index">`

* `capital_P_dangit`

## What doesn't it do?

As much as the `type="text/javascript"` and `type="text/css"` attributes bother me too, scrubbing them isn’t simple, and a little more resource-hungry than I’m comfortable with. If you want your HTML lean, try a real minifier like [Autoptimize](https://wordpress.org/plugins-wp/autoptimize/) instead.

It also doesn't remove the extra feeds. I use those ᐛ
