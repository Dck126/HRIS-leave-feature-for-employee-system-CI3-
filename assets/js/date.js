document.getElementById('year').addEventListener('input', function(e) {
    var value = e.target.value;
    var currentYear = new Date().getFullYear();
    
    // Hanya menerima input 4 digit angka
    if (value.length !== 4 || isNaN(value)) {
        e.target.setCustomValidity('Masukkan tahun dengan format empat digit (misal: 2024)');
    } else if (value <= 2023 || value > currentYear) {
        e.target.setCustomValidity('Masukkan Tahun Sekarang ' + currentYear);
    } else {
        e.target.setCustomValidity('');
    }
});
