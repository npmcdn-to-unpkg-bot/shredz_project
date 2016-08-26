$("document").ready(function(){
    apiKey = "AIzaSyDF8inzY8gSTq_kbi3CFM8WTcZflEzYay8";

    window.controller = new YTV('frame2', {
        playlist: 'PLLfsyH6I13oqTysEUD2Ida9UT4NHZ0TaF',
        accent: 'orange',
        autoplay: false,
        responsive: true,
        controls: true,
        playerTheme: 'dark',
        listTheme: 'dark'
    });

    window.controller = new YTV('frame', {
        playlist: 'PLLfsyH6I13oqRzyKLIjiryHEOBG3yB9Cs',
        accent: 'orange',
        autoplay: false,
        responsive: true,
        controls: true,
        playerTheme: 'dark',
        listTheme: 'dark'
    });
});//document ready