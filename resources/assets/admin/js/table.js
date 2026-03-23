import DataTable from "datatables.net-dt";
import "datatables.net-dt/css/dataTables.dataTables.css";

document.addEventListener("DOMContentLoaded", () => {
    const tables = document.querySelectorAll('table[data-datatable="true"]');

    tables.forEach((tableElement) => {
        initDataTable(tableElement);
    });
});

function initDataTable(tableElement) {
    const ajaxUrl = tableElement.dataset.ajaxUrl;

    if (!ajaxUrl) {
        return;
    }

    const columns = parseJsonAttribute(tableElement.dataset.columns, []);
    const order = parseJsonAttribute(tableElement.dataset.order, [[0, "desc"]]);
    const searchInput = getOptionalElement(tableElement.dataset.searchInput);
    const lengthSelect = getOptionalElement(tableElement.dataset.lengthSelect);

    const pageLength = lengthSelect ? parseInt(lengthSelect.value, 10) || 10 : 10;

    const dataTable = new DataTable(tableElement, {
        ajax: {
            url: ajaxUrl,
            type: "GET",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        },
        columns,
        dom: 'rt<"datatable-footer d-flex justify-content-between align-items-center flex-wrap gap-3 mt-3"ip>',
        info: true,
        lengthChange: false,
        order,
        pageLength,
        paging: true,
        pagingType: "simple_numbers",
        processing: true,
        searching: true,
        serverSide: true,
        language: {
            paginate: {
                previous: '<span class="icon"><i class="bi bi-chevron-left"></i></span>',
                next: '<span class="icon"><i class="bi bi-chevron-right"></i></span>',
            },
        },
    });

    bindSearchInput(dataTable, searchInput);
    bindLengthSelect(dataTable, lengthSelect);
}

function bindSearchInput(dataTable, searchInput) {
    if (!searchInput) {
        return;
    }

    let debounceTimer;

    searchInput.addEventListener("input", (event) => {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            dataTable.search(event.target.value).draw();
        }, 300);
    });
}

function bindLengthSelect(dataTable, lengthSelect) {
    if (!lengthSelect) {
        return;
    }

    lengthSelect.addEventListener("change", (event) => {
        const nextLength = parseInt(event.target.value, 10);

        if (Number.isNaN(nextLength)) {
            return;
        }

        dataTable.page.len(nextLength).draw();
    });
}

function parseJsonAttribute(value, fallback) {
    if (!value) {
        return fallback;
    }

    try {
        return JSON.parse(value);
    } catch {
        return fallback;
    }
}

function getOptionalElement(selector) {
    if (!selector) {
        return null;
    }

    return document.querySelector(selector);
}