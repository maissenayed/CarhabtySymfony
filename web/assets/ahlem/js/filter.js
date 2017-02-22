function switchIcon() {
    var descIcon = document.getElementById('sortDescIcon');
    var ascIcon = document.getElementById('sortAscIcon');

    if(descIcon && descIcon.style.display == 'none') {
        descIcon.style.display = 'inline-block';
    } else {
        descIcon.style.display = 'none';
    }
    
    if(ascIcon && ascIcon.style.display == 'none') {
        ascIcon.style.display = 'inline-block';
    } else {
        ascIcon.style.display = 'none';
    }
}