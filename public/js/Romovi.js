document.addEventListener('DOMContentLoaded', function() {
  var images = ['/img/Romovi1.png', '/img/Romovi2.png', '/img/Romovi3.png', '/img/Romovi4.png', '/img/Romovi5.png', '/img/Romovi6.png', '/img/Romovi7.png', '/img/Romovi8.png'];

  var bgImageElement = document.getElementById('randomBgImage');

  function getRandomImage() {
    return images[Math.floor(Math.random() * images.length)];
  }

  function changeImage() {
    var randomImage = getRandomImage();
    bgImageElement.style.backgroundImage = "url('" + randomImage + "')";
  }

  setInterval(changeImage, 5000); // Cambia la imagen cada 5 segundos

  // Cambiar la imagen al hacer clic
  bgImageElement.addEventListener('click', changeImage);
});

document.addEventListener('DOMContentLoaded', function() {
  var images = ['/img/Romovi1.png', '/img/Romovi2.png', '/img/Romovi3.png', '/img/Romovi4.png', '/img/Romovi5.png', '/img/Romovi6.png', '/img/Romovi7.png', '/img/Romovi8.png'];

  var bgImageElement = document.getElementById('randomBgImage2');

  function getRandomImage() {
    return images[Math.floor(Math.random() * images.length)];
  }

  function changeImage() {
    var randomImage = getRandomImage();
    bgImageElement.style.backgroundImage = "url('" + randomImage + "')";
  }

  setInterval(changeImage, 5000); // Cambia la imagen cada 5 segundos

  // Cambiar la imagen al hacer clic
  bgImageElement.addEventListener('click', changeImage);
});

