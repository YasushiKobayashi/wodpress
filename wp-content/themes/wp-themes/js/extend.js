(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-45655257-3', 'auto');
ga('send', 'pageview');

$("a").click(function () {
    var next_url = $(this).attr('href');
    if(next_url.indexOf('http') == -1){
    } else if (next_url.indexOf('yasushikobayashi.info') == 1){
        ga('send', 'event', '内部リンク' ,'click', next_url, 1);
    } else if (next_url.indexOf('c.af.moshimo.com') == 1){
        ga('send', 'event', 'Amazon・楽天' ,'click', next_url, 1);
    } else if (next_url.indexOf('valuecommerce') == 1){
        ga('send', 'event', 'valuecommerce' ,'click', next_url, 1);
    } else if (next_url.indexOf('a8.net/svt') == 1){
        ga('send', 'event', 'a8' ,'click', next_url, 1);
    } else {
        ga('send', 'event', '外部リンク' ,'click', next_url, 1);
    }
});
