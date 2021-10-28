
const container = document.querySelector(".container");
const loaderEllips = document.querySelector(".loader-ellips");

var start = 0;

window.addEventListener('scroll', () => {

    if(window.scrollY + window.innerHeight >= document.documentElement.scrollHeight) {
        start += 5;
        loadContent(start);
    }
})

function heartEvent(e) {
    e.target.classList.toggle('red');
}

function moonEvent(e) {
    e.target.classList.toggle('golden');
}

function loadContent(start) {
    var formData = new FormData();
    formData.append('start', start);
    fetch('get_videos.php', {
        method: "post",
        body: formData
    }).then(res => res.text()).then(data => {
        if(data == "") {
            loaderEllips.remove();
        } else {
            var heartIcon = document.querySelectorAll('.heart-icon');
            var halfMoonIcon = document.querySelectorAll('.half-moon-icon');
            for (let i = 0; i < heartIcon.length; i++) {
                heartIcon[i].removeEventListener('click', heartEvent);
                halfMoonIcon[i].removeEventListener('click', moonEvent);
                
            }
            container.insertAdjacentHTML('beforeend', data);
            var heartIcon = document.querySelectorAll('.heart-icon');
            var halfMoonIcon = document.querySelectorAll('.half-moon-icon');
            for (let i = 0; i < heartIcon.length; i++) {
                heartIcon[i].addEventListener('click', heartEvent);
                halfMoonIcon[i].addEventListener('click', moonEvent);
                
            }
            
        }
        
    })
}
loadContent(start);



