// AOS
AOS.init();

// 視差捲動 START
// Photo by Pankaj Patel on Unsplash
$('.parallax-window').parallax({
    imageSrc: '../img/frontend/leaderboard/2019/yuu-chien/entrance-bg.jpg'
});
// Photo by Markus Spiske on Unsplash
$('.parallax-window-2').parallax({
    imageSrc: '../img/frontend/leaderboard/2019/yuu-chien/years-accumulation-bg.jpg'
});
// 視差捲動 END

// 首頁文字動畫 START
var textWrapper = document.querySelector('.entrance-title');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
var textWrapper2 = document.querySelector('.entrance-title-2');
textWrapper2.innerHTML = textWrapper2.textContent.replace(/\S/g, "<span class='letter2'>$&</span>");

anime.timeline({
        loop: false
    })
    .add({
        targets: '.entrance-title .letter',
        scale: [4, 1],
        opacity: [0, 1],
        translateZ: 0,
        easing: "easeOutExpo",
        duration: 1000,
        delay: (el, i) => 70 * i
    })

anime.timeline({
        loop: false
    })
    .add({
        targets: '.entrance-title-2 .letter2',
        scale: [4, 1],
        opacity: [0, 1],
        translateZ: 0,
        easing: "easeOutExpo",
        duration: 1000,
        delay: (el, i) => 70 * i
    })
// 首頁文字動畫 END

// 計數器 START
$(window).scroll(function () {
    // 感謝小蟹神支援幫忙解決 bug (github：wildjcrt)
    if ($('.accumulation-num').filter(function () {
            return $(this).data('animation') & true
        }).length === 0) return
    $('.accumulation-num').each(function () {
        var currentId = $(this).attr('id').split('-')[2];
        var bottom_of_object = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();

        if (bottom_of_window > bottom_of_object) {
            if ($("#year-acc-" + currentId).data('animation')) {
                new CountUp("year-acc-" + currentId, $("#year-acc-" + currentId).attr("data-val")).start();
                $("#year-acc-" + currentId).data('animation', false);
            }
        }
    })
});
// 計數器 END
