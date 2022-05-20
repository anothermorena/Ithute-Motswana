//enables the side navigation menu
$('.button-collapse').sideNav();

//activates the model
$('.modal').modal();

//activates the carousel
$('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true,
    padding: 200
});
autoplay();

function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 10000);
}

//activates the select input
$('select').material_select();

//activates the tool tip
$('.tooltipped').tooltip();