const heartIcon = document.querySelectorAll('.heart-icon');
const container = document.querySelector(".container");
const loaderEllips = document.querySelector(".loader-ellips");

for (let i = 0; i < heartIcon.length; i++) {
    heartIcon[i].addEventListener('click', (e) => {
        heartIcon[i].classList.toggle('red')
    })
    
}


var start = 0;

window.addEventListener('scroll', () => {

    if(window.scrollY + window.innerHeight >= document.documentElement.scrollHeight) {
        start += 5;
        loadContent(start);
    }
})

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
            container.insertAdjacentHTML('beforeend', data);
        }
        
    
    })
}
loadContent(start);