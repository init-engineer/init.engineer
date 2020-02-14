// AOS
AOS.init();

// 視差捲動 START
// Photo by Pankaj Patel on Unsplash
$('.parallax-window').parallax({imageSrc: '../img/frontend/leaderboard/2019/yuu-chien/entrance-bg.jpg'});
// Photo by Markus Spiske on Unsplash
$('.parallax-window-2').parallax({imageSrc: '../img/frontend/leaderboard/2019/yuu-chien/years-accumulation-bg.jpg'});
// 視差捲動 END

// 首頁文字動畫 START
var textWrapper = document.querySelector('.entrance-title');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
var textWrapper2 = document.querySelector('.entrance-title-2');
textWrapper2.innerHTML = textWrapper2.textContent.replace(/\S/g, "<span class='letter2'>$&</span>");

anime.timeline({loop: false})
.add({
    targets: '.entrance-title .letter',
    scale: [4,1],
    opacity: [0,1],
    translateZ: 0,
    easing: "easeOutExpo",
    duration: 1000,
    delay: (el, i) => 70*i
})

anime.timeline({loop: false})
.add({
    targets: '.entrance-title-2 .letter2',
    scale: [4,1],
    opacity: [0,1],
    translateZ: 0,
    easing: "easeOutExpo",
    duration: 1000,
    delay: (el, i) => 70*i
})
// 首頁文字動畫 END

// CountUp
$(window).scroll(function(){
    $('.accumulation-num').each(function(i){
        var bottom_of_object = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        if( bottom_of_window > bottom_of_object ){
            new CountUp ("year-acc-1",$("#year-acc-1").attr("data-val")).start()
            new CountUp ("year-acc-2",$("#year-acc-2").attr("data-val")).start()
            new CountUp ("year-acc-3",$("#year-acc-3").attr("data-val")).start()
            new CountUp ("year-acc-4",$("#year-acc-4").attr("data-val")).start()
            new CountUp ("year-acc-5",$("#year-acc-5").attr("data-val")).start()
            new CountUp ("year-acc-6",$("#year-acc-6").attr("data-val")).start()
        }
    })
});
