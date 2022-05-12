$(function(){
    document.getElementById('links').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event,prevClass: 'prev',
                // The class for the "next" control:
                nextClass: 'next',hidePageScrollbars: false,
                toggleControlsOnReturn: false,
                toggleSlideshowOnSpace: false,
                enableKeyboardNavigation: false,
                closeOnEscape: false,
                closeOnSlideClick: false,
                closeOnSwipeUpOrDown: false,
                disableScroll: false,
                startSlideshow: true},
            links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    };
}
);