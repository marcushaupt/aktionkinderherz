// slider.js

$(document).ready(function () {
    // Initialize the slider
    $('.slider').each(function () {
        var slider = $(this);
        var autoplay = slider.attr('data-autoplay') === 'true';

        slider.find('.w-slider-mask').children('.w-slide').first().addClass('w-active');

        if (autoplay) {
            setInterval(function () {
                showNextSlide(slider);
            }, parseInt(slider.attr('data-delay')));
        }
    });

    // Handle left arrow click
    $('.w-slider-arrow-left').click(function () {
        var slider = $(this).closest('.slider');
        showPrevSlide(slider);
    });

    // Handle right arrow click
    $('.w-slider-arrow-right').click(function () {
        var slider = $(this).closest('.slider');
        showNextSlide(slider);
    });

    function showNextSlide(slider) {
        var currentSlide = slider.find('.w-active');
        var nextSlide = currentSlide.next('.w-slide');

        if (nextSlide.length === 0) {
            nextSlide = slider.find('.w-slider-mask').children('.w-slide').first();
        }

        currentSlide.removeClass('w-active');
        nextSlide.addClass('w-active');
    }

    function showPrevSlide(slider) {
        var currentSlide = slider.find('.w-active');
        var prevSlide = currentSlide.prev('.w-slide');

        if (prevSlide.length === 0) {
            prevSlide = slider.find('.w-slider-mask').children('.w-slide').last();
        }

        currentSlide.removeClass('w-active');
        prevSlide.addClass('w-active');
    }
});
