function cartHover() {
    let menuBar = document.getElementById("menuBar");
    var overlay = document.getElementById("overlay")

    menuBar.classList.toggle("menuBarStyle");
    overlay.classList.toggle("overlayStyle");
}

function avatarHover() {
    let avatarBar = document.getElementById("avatarBar");
    var overlay = document.getElementById("overlay")

    avatarBar.classList.toggle("avatarBarStyle");
    overlay.classList.toggle("overlayStyle");
}