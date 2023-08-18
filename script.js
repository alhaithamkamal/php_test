// script.js

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('user-image');
    const thumbnailContainer = document.getElementById('thumbnail');
  
    fileInput.addEventListener('change', function() {
      const file = fileInput.files[0];
      const imageTypeRegExp = /^image\//;
  
      if (file && file.type.match(imageTypeRegExp)) {
        const reader = new FileReader();
  
        reader.onload = function(e) {
          const thumbnail = document.createElement('img');
          thumbnail.src = e.target.result;
          thumbnailContainer.innerHTML = '';
          thumbnailContainer.appendChild(thumbnail);
        };
  
        reader.readAsDataURL(file);
      } else {
        thumbnailContainer.innerHTML = '';
      }
    });
  });