// Fungsi untuk mengaktifkan dark mode
function enableDarkMode() {
  document.body.classList.add('dark-mode');
}

// Fungsi untuk mematikan dark mode
function disableDarkMode() {
  document.body.classList.remove('dark-mode');
}

// Mendapatkan tombol dark mode
var darkModeButton = document.getElementById('darkModeButton');

// Menambahkan event listener untuk mengaktifkan/mematikan dark mode
darkModeButton.addEventListener('click', function () {
  if (document.body.classList.contains('dark-mode')) {
    disableDarkMode();
  } else {
    enableDarkMode();
  }
});
