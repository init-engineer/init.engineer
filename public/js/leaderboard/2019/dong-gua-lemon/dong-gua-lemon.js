var mobile = document.querySelector('.mobile')
var imgcard = document.querySelector('.cardimg')
var miximg = document.querySelector('.miximg')
var engtitle = document.querySelector('.engtitle')
var blur = document.getElementById('imagearea');
var alert = document.querySelector('.alert')
var titleblur = document.querySelectorAll('.titleinfo')
function toggle() {
    blur.classList.toggle('active')
    imgcard.classList.toggle('active')
    miximg.classList.toggle('active')
    engtitle.classList.toggle('active')
    alert.classList.toggle('active')
}
window.onload = function () {
    engtitle.addEventListener("animationend", function () {
        engtitle.style.display = "none"
    })
    blur.addEventListener("animationend", function () {
        blur.style.display = "none"
        for (let i in titleblur) {
            titleblur[i].style.display = "unset"
        }
    })
}
