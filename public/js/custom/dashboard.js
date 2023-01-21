function openMenu() {
    document.querySelector('#toggle-menu-mobile').classList.contains('d-sm-none') ? document.querySelector('#toggle-menu-mobile').classList.remove('d-sm-none') : document.querySelector('#toggle-menu-mobile').classList.remove('d-sm-none')
}

function closeMenu() {
    !document.querySelector('#toggle-menu-mobile').classList.contains('d-sm-none') ? document.querySelector('#toggle-menu-mobile').classList.add('d-sm-none') : document.querySelector('#toggle-menu-mobile').classList.add('d-sm-none')
}

function newPage( route ) {
    window.location.href = route
}
