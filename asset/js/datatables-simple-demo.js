window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    document.querySelectorAll('table[data-table]').forEach((element) => {
        new simpleDatatables.DataTable(element);
    })
});