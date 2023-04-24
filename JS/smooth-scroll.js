var links = document.querySelectorAll('.smooth-scroll');

links.forEach(function(link) {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    var targetId = link.hash;
    var targetElement = document.querySelector(targetId);
    var targetPosition = targetElement.offsetTop;
    window.scrollTo({
      top: targetPosition,
      behavior: 'smooth'
    });
  });
});