var xhr = new XMLHttpRequest();
var btn = document.getElementById('sendUpdate');

btn.addEventListener('click', function() {
  xhr.open('GET', 'index.php?update=1');
  xhr.send(null);
})
