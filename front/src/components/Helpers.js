export function isEmpty(obj = {}) {
    return Object.keys(obj).length === 0
}

export function filterRows(rows, filter) {
    if (isEmpty(filter)) return rows;

    return rows.filter((row) => {
        let result = false;
        Object.keys(row).forEach((key) => {
            if (row[key].toString().toLowerCase().includes(filter.toLowerCase()))
                result = true;
        });
        return result;
    })
}   