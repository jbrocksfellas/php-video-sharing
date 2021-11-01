const container = document.querySelector(".container");
const loaderEllips = document.querySelector(".loader-ellips");

var start = 0;

window.addEventListener("scroll", () => {
  if (
    window.scrollY + window.innerHeight >=
    document.documentElement.scrollHeight
  ) {
    start += 5;
    loadContent(start);
  }
});

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function heartEvent(e) {
  e.target.classList.toggle("red");
  if (e.target.classList.contains("red")) {
    e.target.nextSibling.innerText = Number(e.target.nextSibling.innerText) + 1;
    let formData = new FormData();
    let nextSiblingId = e.target.nextSibling.id;
    formData.append("sno", Number(nextSiblingId));
    formData.append("likes", Number(e.target.nextSibling.innerText));
    setCookie("dhabalikes" + nextSiblingId, null, 2592000);
    fetch("likes.php", {
      method: "post",
      body: formData,
    })
      .then((res) => res.text());
      
  } else {
    e.target.nextSibling.innerText = Number(e.target.nextSibling.innerText) - 1;
    let formData = new FormData();
    let nextSiblingId = e.target.nextSibling.id;
    formData.append("sno", Number(nextSiblingId));
    formData.append("likes", Number(e.target.nextSibling.innerText));
    setCookie("dhabalikes" + nextSiblingId, null, -60);
    fetch("likes.php", {
      method: "post",
      body: formData,
    })
      .then((res) => res.text());
      
  }
}

function moonEvent(e) {
  e.target.classList.toggle("golden");
  if (e.target.classList.contains("golden")) {
    e.target.nextSibling.innerText = Number(e.target.nextSibling.innerText) + 1;
    let formData = new FormData();
    let nextSiblingId = e.target.nextSibling.id;
    formData.append("sno", Number(nextSiblingId));
    formData.append("moons", Number(e.target.nextSibling.innerText));
    setCookie("dhabamoons" + nextSiblingId, null, 2592000);
    fetch("likes.php", {
      method: "post",
      body: formData,
    })
      .then((res) => res.text());
      
  } else {
    e.target.nextSibling.innerText = Number(e.target.nextSibling.innerText) - 1;
    let formData = new FormData();
    let nextSiblingId = e.target.nextSibling.id;
    formData.append("sno", Number(nextSiblingId));
    formData.append("moons", Number(e.target.nextSibling.innerText));
    setCookie("dhabamoons" + nextSiblingId, null, -60);
    fetch("likes.php", {
      method: "post",
      body: formData,
    })
      .then((res) => res.text());
      
  }
}

function loadContent(start) {
  var formData = new FormData();
  formData.append("start", start);
  fetch("get_videos.php", {
    method: "post",
    body: formData,
  })
    .then((res) => res.text())
    .then((data) => {
      if (data == "") {
        loaderEllips.remove();
      } else {
        var heartIcon = document.querySelectorAll(".bi-heart-fill");
        var halfMoonIcon = document.querySelectorAll(".bi-moon-fill");
        for (let i = 0; i < heartIcon.length; i++) {
          heartIcon[i].removeEventListener("click", heartEvent);
          halfMoonIcon[i].removeEventListener("click", moonEvent);
        }
        container.insertAdjacentHTML("beforeend", data);
        var heartIcon = document.querySelectorAll(".bi-heart-fill");
        var halfMoonIcon = document.querySelectorAll(".bi-moon-fill");
        for (let i = 0; i < heartIcon.length; i++) {
          if (getCookie("dhabalikes" + heartIcon[i].nextSibling.id)) {
            heartIcon[i].classList.add("red");
          }
          if (getCookie("dhabamoons" + heartIcon[i].nextSibling.id)) {
            halfMoonIcon[i].classList.add("golden");
          }
          heartIcon[i].addEventListener("click", heartEvent);
          halfMoonIcon[i].addEventListener("click", moonEvent);
        }
      }
    });
}
loadContent(start);
